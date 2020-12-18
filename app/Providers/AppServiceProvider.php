<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Category;
use App\Regions;
use App\Vendor;
use App\Ticket;
use App\TicketReplies;
use App\SocialSetting;
use App\CompanySetting;
use App\WeddingideasCategory;
use App\CommunityGroup;
use App\WeddingdressDesigner;
use App\BlogCategory;
use App\BlogPost;
use App\BlogPostComment;
use App\Menu;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ////////////  Social Media data passing /////////////////////////
        $socials = SocialSetting::orderBy('created_at', 'asc')->where('status',1)->get();
        View::share('socials', $socials);
        ////////////  Category Data passing /////////////////////////
        $blogCategory = BlogCategory::all();
        View::share('blogCategory', $blogCategory);
        $category = Category::getCategory();
        View::share('category', $category);
        $sub_category = Category::get_random_sub_cats();
        View::share('sub_category', $sub_category);
        $category_with_total = Category::get_all_cateogires_with_count();
        View::share('category_with_total', $category_with_total);
        // $spokenLanguages = ['English','Spanish','French','Hindi','Urudu','Punjabi'];
        $spokenLanguages = ["Abenaki",
        "Acadian French",
        "Afrikaans",
        "Akan",
        "Albanian",
        "Algonquin",
        "Amharic (Ethiopia)",
        "Anii",
        "Arabic",
        "Armenian",
        "Assamese",
        "Aymara",
        "Babine-Witsuwit\'en",
        "Bengali",
        "Beothuk",
        "Berber",
        "Blackfoot",
        "Bosnian",
        "Broken Slavey",
        "Bulgarian",
        "Bungee",
        "Cantonese",
        "Carrier",
        "Catalan",
        "Cayuga",
        "Chichewa",
        "Chilcotin",
        "Chinook Jargon",
        "Chipewyan",
        "Coast Tsimshian",
        "Comox",
        "Cree",
        "Croatian",
        "Czech",
        "Danish",
        "Ditidaht",
        "Dogrib",
        "Dutch",
        "English",
        "Estonian",
        "Ewe-Gbe",
        "Finnish",
        "Formosan",
        "French",
        "Fula (Peul)",
        "German",
        "Greek",
        "Gujarati",
        "Gwich’in",
        "Haida",
        "Haisla",
        "Haitian Creole",
        "Halkomelem",
        "Hän",
        "Hausa",
        "Hebrew",
        "Heiltsuk-Oowekyala",
        "Hindustani",
        "Hungarian",
        "Icelandic",
        "Igbo",
        "Indonesian",
        "Innu",
        "Inuinnaqtun",
        "Inuktitut",
        "Inupiaq",
        "Inuvialuktun",
        "Italian",
        "Japanese",
        "Javanese",
        "Jola (Diola)",
        "Kabye",
        "Kaska",
        "Korean",
        "Ktunaxa",
        "Kwak\'wala",
        "Lillooet",
        "Lithuanian",
        "Malay",
        "Malay",
        "Malecite-Passamaquoddy",
        "Mamara",
        "Mandarin",
        "Manding (Mandingues)",
        "Mankanya",
        "Marathi",
        "Mi\'kmaq",
        "Michif",
        "Mohawk",
        "Munsee",
        "Naskapi",
        "Nicola",
        "Norwegian",
        "Nuu-chah-nulth",
        "Nuxalk",
        "Ojibwe",
        "Okanagan",
        "Oneida",
        "Onondaga",
        "Oromo",
        "Ottawa",
        "Persian",
        "Polish",
        "Portuguese",
        "Potawatomi",
        "Punjabi",
        "Romanian",
        "Russian",
        "Saanich",
        "Safen",
        "Sarcee",
        "Sechelt",
        "Sekani",
        "Seneca",
        "Serbian",
        "Serer (Sérère)",
        "Shona",
        "Shuswap",
        "Slavey",
        "Slovak",
        "Somali",
        "Soninke",
        "Sotho",
        "Southern Quechua",
        "Spanish",
        "Squamish",
        "Swahili",
        "Swati",
        "Swedish",
        "Tagalog (Filipino)",
        "Tagish",
        "Tahltan",
        "Tamil",
        "Telegu",
        "Thai",
        "Thompson",
        "Tlingit",
        "Tonga",
        "Tsonga",
        "Turkish",
        "Tuscarora",
        "Tutchone",
        "Ukrainian",
        "Urdu",
        "Vietnamese",
        "Welsh",
        "Wolof",
        "Wyandot",
        "Yobe",
        "Yoruba",
        "Zulu",
        "Farsi",
        "Hindi",
        "Flemish",
        "Galician",
        "Basque (euskara)",
        "Occitan (aranés)"
    ];
        View::share('spokenLanguages', $spokenLanguages);
        // print_r($category_with_total);
        ////////////  Category Data passing /////////////////////////
        $companySetting = CompanySetting::where('id',1)->first();
        View::share('companySetting', $companySetting);

        $communityGroup = CommunityGroup::where('status', 1)->get();
        View::share('communityGroup', $communityGroup);

        // $weddingideasCategory = WeddingideasCategory::where('is_parent','1')->where('status','1')->get();
        // View::share('weddingideasCategory', $weddingideasCategory);

        // $WeddingdressDesigner = WeddingdressDesigner::where('is_top', '1')->where('status', '1')->get()->random(5);
        // View::share('weddingdressDesigner', $WeddingdressDesigner);

        ////////////  Vendor Section Data For Admin Panel passing /////////////////////////
        $inactiveVendors = Vendor::where('parent_vendor_id',0)->where('freelisting','No')->where('verified',0)->orWhere('status',0)->count();
        $pendingVendors  = Vendor::rightJoin('payment_methods','payment_methods.vendor_id','=','vendors.vendor_id')->where('vendors.parent_vendor_id', 0)->where('vendors.freelisting','Yes')->count();
        View::share('inactiveVendors', $inactiveVendors);
        View::share('pendingVendors', $pendingVendors);
        $pblogs=BlogPost::where('published',0)->where('user_id','!=',NULL)->count();
        View::share('pendblogs',$pblogs);
        $catblogs=BlogCategory::where('status',0)->count();
        View::share('catblogs',$catblogs);
        $cblogs=BlogPost::where('approved',0)->where('vendor_id','!=',NULL)->count();
        View::share('comblogs',$cblogs);
        $comentblogs=BlogPostComment::where('approved',0)->count();
        View::share('comentblogs',$comentblogs);
        ////////////  Ticket Section Data For Admin Panel passing /////////////////////////
        $ticketSectionNew     = Ticket::where('status',0)->count();
        $ticketSectionPending = TicketReplies::where('is_read',0)->where('message_type','self')->count();
        $ticketSectionTotal   = ($ticketSectionNew + $ticketSectionPending);
        View::share('ticketSectionNew', $ticketSectionNew);
        View::share('ticketSectionPending', $ticketSectionPending);
        View::share('ticketSectionTotal', $ticketSectionTotal);

        ////// For location in search sectio on Wedding-Venues pages & Home Page also....... 
        $locations = DB::table('regions')->groupBy('state')->where('status','=','1')->pluck('state');
        $stateRegions = Regions::get()->toArray();
        $stateSearchRegions = array();
        foreach ($locations as $locationValue) {
            $i = 0;
            foreach($stateRegions as $element) {
                if($locationValue == $element['state']) {
                   $stateSearchRegions[$locationValue][$i] = $element;
                   $i++;
                }
            }
        }
        $menus=Menu::with('children')->orderBy('display_order', 'ASC')->get();
        View::share('locations', $locations);
        View::share('stateRegions', $stateRegions);
        View::share('stateSearchRegions', $stateSearchRegions);
        View::share('menus', $menus);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
