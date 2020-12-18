<div tabindex="-1" role="dialog" aria-hidden="false" class="modal fade in" id="moveGroups-modal" style="z-index:1040;display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-headerTools">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="svgIcon svgIcon__close "><svg viewBox="0 0 26 26"><path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path></svg></i>
                </button>
                <p class="modal-headerTools-title">Move to Group</p>
            </div>
            <div class="tools-header-bar">Select a Group :</div>
            <form class="app-guest-multi-form" onsubmit="return moveToGroups();" action="{{url('tools/moveToGroups')}}" method="post">
                @csrf
                <div class="modal-body  p25 pt10 pb10 ">
                    <div class="alert alert-error dnone moveGroupsErr" role="alert" aria-hidden="true">
                        <p>It was not possible to save your changes. Please try again later.</p>
                    </div>
                    <ul class="list-items list-items-content">
                        @foreach($data['guestsCat'] as $gcat)
                            <li class="selectAll_li groups_li" data-value="{{$gcat->id}}" data-groupname="{{$gcat->title}}">
                                <div class="iradio_minimal" style="position:relative;">
                                    <input type="radio" name="groups" style="opacity:0;">
                                </div>
                                <label>{{$gcat->title}}</label>
                            </li>
                        @endforeach
                        <li class="selectAll_li groups_li" data-value="0" data-groupname="Unassigned">
                            <div class="iradio_minimal" style="position:relative;">
                                <input type="radio" name="groups" style="opacity:0;">
                            </div>
                            <label>Unassigned</label>
                        </li>
                    </ul>
                </div>
                <div class="border-top p20 pl25 pr25 pure-g">
                    <input type="hidden" name="groupId" id="groupId">
                    <input type="hidden" name="groupGuestsId" id="groupGuestsId">
                    <div class="pure-u-2-3">
                        <div class="app-guest-multi-detail" style="display:none;">You are moving <strong><span class="modal-guest-num"></span> guest</strong> to <strong><span class="modal-change-name"></span></strong></div>
                    </div>
                    <div class="pure-u-1-3 text-right">
                        <input type="submit" class="btn-flat red" value="Move">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>