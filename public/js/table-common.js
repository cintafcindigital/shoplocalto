globals = {
    subdomain: "www.weddingwire.ca",
    subdomainMobile: "m.weddingwire.ca",
    subdomain_secure: "https://www.weddingwire.ca",
    subdomain_cdn_img: "https://cdn1.weddingwire.ca",
    subdomain_cdn_css: "https://cdn1.weddingwire.ca",
    prevGrupoUrl: "",
    Request_Cookie_domain: "weddingwire.CA",
    SUBDOMAIN_MAIL: "www.weddingwire.ca",
    REQUEST_COUNTRY: "Canada",
    REQUEST_CURRENCY: "C$ ",
    REQUEST_CURRENCY_PRECISION: "2",
    USER_TOOLS_CURRENCY_PRECISION: "0",
    Request_FB_AppID: "913923858728658",
    Request_Map_Zoom_Max: "16",
    Request_Language: "en",
    Request_Country: "CA",
    Request_AnalyticsReduced_code: "UA-65181856-2",
    Request_Analytics_code: "UA-65181856-1",
    Request_UniversalAnalytics_code: "UA-692627-108",
    Request_URL_keygen: "weddings",
    Request_prevurl_model: "",
    Request_id_project: "50",
    Request_mis_empresas: "1",
    Request_AnalyticsEcommerceEnabled: "1",
    Request_AnalyticsMigrationEnabled: 0,
    Request_AnalyticsMigrationTracker: "",
    Request_Wedding_Awards_Edition: "2015",
    Request_TageoEmpresas: "",
    Request_Url_IB: "",
    Request_Show_Opiniones_Negativas: "1",
    timezone: '-4',
    currency_before: 'C$ ',
    currency_after: '',
    reduced: '',
    link_sections: ["https://www.weddingwire.ca/my-wedding-planner", "https://www.weddingwire.ca/wedding-venues", "https://www.weddingwire.ca/wedding-vendors", "https://www.weddingwire.ca/brides", "https://www.weddingwire.ca/grooms", "https://www.weddingwire.ca/wedding-ideas", "https://www.weddingwire.ca/community"],
    Request_Pusher_Key: "c497cda384fc27c36c44",
    Request_Pusher_Cluster: "mt1",
    Request_Url_Condiciones_Legales: "/legal-terms.php",
    Request_Remove_Image_Sizes_Comunidad: false,
    isMobile: false,
    environment: "PROD",
    isDynamicServing: false,
    minChars: "30",
    isUSProject: false,
    googleLoginClientId: '999874796511-muticnlovj6r5jjd24fb445mf466jd9p.apps.googleusercontent.com',
    Request_SiteVersion: "nossl-akamai-sf-usa-20190708-01CA1067140-1_www_m_",
    showLayerCookies: false,
    fbGraphApiVersion: "v2.10",
    isWWProject: true
};
globals.separators = {
    decimal: ".",
    thousand: ","
};
globals.listas = {
    filter_max: 1000,
    filter_step: 50,
    lemonWayNoDocLimitByTransaction: 250,
    lemonWayNoDocWalletMax: 2500
};
globals.promos = {
    Type_Black_Friday: 8,
    Type_Black_Friday_Regalos: 9,
    Black_Friday_EndPromos: '26/11/2018',
    Black_Friday_TitlePlaceholder: 'Examples: \u002250% off your Wedding Package\u0022 or \u0022Our gift to you\u0022'
};
globals.catalogTraces = {
    sources: {
        DESKTOP: 0,
        MOBILE: 1,
        APP: 2,
    },
    isMobile: false,
    isApp: typeof isUsersAppVersion !== 'undefined' && isUsersAppVersion
};
globals.urls = {
    tools: {
        tables: 'https://www.weddingwire.ca/tools/Tables',
        reviews: 'https://www.weddingwire.ca/shared/rate'
    },
    vendors_menu: {
        dashboard: 'https://www.weddingwire.ca/emp-Menu.php',
        call_tracking: 'https://www.weddingwire.ca/emp-ModifPhone.php',
        employees: 'https://www.weddingwire.ca/emp-Empleados.php',
        message_item: 'https://www.weddingwire.ca/emp-AdminSolicitudesShow.php',
        revocer_password_submit: '/emp-RecuperaPasswordRun.php'
    }
};
globals.tenor = {
    apikey: ''
};
! function(a, b) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function(a) {
        if (!a.document) throw new Error("jQuery requires a window with a document");
        return b(a)
    } : b(a)
}("undefined" != typeof window ? window : this, function(a, b) {
    var c = [],
        d = c.slice,
        e = c.concat,
        f = c.push,
        g = c.indexOf,
        h = {},
        i = h.toString,
        j = h.hasOwnProperty,
        k = "".trim,
        l = {},
        m = "1.11.0",
        n = function(a, b) {
            return new n.fn.init(a, b)
        },
        o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        p = /^-ms-/,
        q = /-([\da-z])/gi,
        r = function(a, b) {
            return b.toUpperCase()
        };
    n.fn = n.prototype = {
        jquery: m,
        constructor: n,
        selector: "",
        length: 0,
        toArray: function() {
            return d.call(this)
        },
        get: function(a) {
            return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this)
        },
        pushStack: function(a) {
            var b = n.merge(this.constructor(), a);
            return b.prevObject = this, b.context = this.context, b
        },
        each: function(a, b) {
            return n.each(this, a, b)
        },
        map: function(a) {
            return this.pushStack(n.map(this, function(b, c) {
                return a.call(b, c, b)
            }))
        },
        slice: function() {
            return this.pushStack(d.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(a) {
            var b = this.length,
                c = +a + (0 > a ? b : 0);
            return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor(null)
        },
        push: f,
        sort: c.sort,
        splice: c.splice
    }, n.extend = n.fn.extend = function() {
        var a, b, c, d, e, f, g = arguments[0] || {},
            h = 1,
            i = arguments.length,
            j = !1;
        for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || n.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)
            if (null != (e = arguments[h]))
                for (d in e) a = g[d], c = e[d], g !== c && (j && c && (n.isPlainObject(c) || (b = n.isArray(c))) ? (b ? (b = !1, f = a && n.isArray(a) ? a : []) : f = a && n.isPlainObject(a) ? a : {}, g[d] = n.extend(j, f, c)) : void 0 !== c && (g[d] = c));
        return g
    }, n.extend({
        expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(a) {
            throw new Error(a)
        },
        noop: function() {},
        isFunction: function(a) {
            return "function" === n.type(a)
        },
        isArray: Array.isArray || function(a) {
            return "array" === n.type(a)
        },
        isWindow: function(a) {
            return null != a && a == a.window
        },
        isNumeric: function(a) {
            return a - parseFloat(a) >= 0
        },
        isEmptyObject: function(a) {
            var b;
            for (b in a) return !1;
            return !0
        },
        isPlainObject: function(a) {
            var b;
            if (!a || "object" !== n.type(a) || a.nodeType || n.isWindow(a)) return !1;
            try {
                if (a.constructor && !j.call(a, "constructor") && !j.call(a.constructor.prototype, "isPrototypeOf")) return !1
            } catch (c) {
                return !1
            }
            if (l.ownLast)
                for (b in a) return j.call(a, b);
            for (b in a);
            return void 0 === b || j.call(a, b)
        },
        type: function(a) {
            return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object" : typeof a
        },
        globalEval: function(b) {
            b && n.trim(b) && (a.execScript || function(b) {
                a.eval.call(a, b)
            })(b)
        },
        camelCase: function(a) {
            return a.replace(p, "ms-").replace(q, r)
        },
        nodeName: function(a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
        },
        each: function(a, b, c) {
            var d, e = 0,
                f = a.length,
                g = s(a);
            if (c) {
                if (g) {
                    for (; f > e; e++)
                        if (d = b.apply(a[e], c), d === !1) break
                } else
                    for (e in a)
                        if (d = b.apply(a[e], c), d === !1) break
            } else if (g) {
                for (; f > e; e++)
                    if (d = b.call(a[e], e, a[e]), d === !1) break
            } else
                for (e in a)
                    if (d = b.call(a[e], e, a[e]), d === !1) break; return a
        },
        trim: k && !k.call("\ufeff\xa0") ? function(a) {
            return null == a ? "" : k.call(a)
        } : function(a) {
            return null == a ? "" : (a + "").replace(o, "")
        },
        makeArray: function(a, b) {
            var c = b || [];
            return null != a && (s(Object(a)) ? n.merge(c, "string" == typeof a ? [a] : a) : f.call(c, a)), c
        },
        inArray: function(a, b, c) {
            var d;
            if (b) {
                if (g) return g.call(b, a, c);
                for (d = b.length, c = c ? 0 > c ? Math.max(0, d + c) : c : 0; d > c; c++)
                    if (c in b && b[c] === a) return c
            }
            return -1
        },
        merge: function(a, b) {
            var c = +b.length,
                d = 0,
                e = a.length;
            while (c > d) a[e++] = b[d++];
            if (c !== c)
                while (void 0 !== b[d]) a[e++] = b[d++];
            return a.length = e, a
        },
        grep: function(a, b, c) {
            for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++) d = !b(a[f], f), d !== h && e.push(a[f]);
            return e
        },
        map: function(a, b, c) {
            var d, f = 0,
                g = a.length,
                h = s(a),
                i = [];
            if (h)
                for (; g > f; f++) d = b(a[f], f, c), null != d && i.push(d);
            else
                for (f in a) d = b(a[f], f, c), null != d && i.push(d);
            return e.apply([], i)
        },
        guid: 1,
        proxy: function(a, b) {
            var c, e, f;
            return "string" == typeof b && (f = a[b], b = a, a = f), n.isFunction(a) ? (c = d.call(arguments, 2), e = function() {
                return a.apply(b || this, c.concat(d.call(arguments)))
            }, e.guid = a.guid = a.guid || n.guid++, e) : void 0
        },
        now: function() {
            return +new Date
        },
        support: l
    }), n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(a, b) {
        h["[object " + b + "]"] = b.toLowerCase()
    });

    function s(a) {
        var b = a.length,
            c = n.type(a);
        return "function" === c || n.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
    }
    var t = function(a) {
        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s = "sizzle" + -new Date,
            t = a.document,
            u = 0,
            v = 0,
            w = eb(),
            x = eb(),
            y = eb(),
            z = function(a, b) {
                return a === b && (j = !0), 0
            },
            A = "undefined",
            B = 1 << 31,
            C = {}.hasOwnProperty,
            D = [],
            E = D.pop,
            F = D.push,
            G = D.push,
            H = D.slice,
            I = D.indexOf || function(a) {
                for (var b = 0, c = this.length; c > b; b++)
                    if (this[b] === a) return b;
                return -1
            },
            J = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            K = "[\\x20\\t\\r\\n\\f]",
            L = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            M = L.replace("w", "w#"),
            N = "\\[" + K + "*(" + L + ")" + K + "*(?:([*^$|!~]?=)" + K + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + M + ")|)|)" + K + "*\\]",
            O = ":(" + L + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + N.replace(3, 8) + ")*)|.*)\\)|)",
            P = new RegExp("^" + K + "+|((?:^|[^\\\\])(?:\\\\.)*)" + K + "+$", "g"),
            Q = new RegExp("^" + K + "*," + K + "*"),
            R = new RegExp("^" + K + "*([>+~]|" + K + ")" + K + "*"),
            S = new RegExp("=" + K + "*([^\\]'\"]*?)" + K + "*\\]", "g"),
            T = new RegExp(O),
            U = new RegExp("^" + M + "$"),
            V = {
                ID: new RegExp("^#(" + L + ")"),
                CLASS: new RegExp("^\\.(" + L + ")"),
                TAG: new RegExp("^(" + L.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + N),
                PSEUDO: new RegExp("^" + O),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + K + "*(even|odd|(([+-]|)(\\d*)n|)" + K + "*(?:([+-]|)" + K + "*(\\d+)|))" + K + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + J + ")$", "i"),
                needsContext: new RegExp("^" + K + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + K + "*((?:-\\d)?\\d*)" + K + "*\\)|)(?=[^-]|$)", "i")
            },
            W = /^(?:input|select|textarea|button)$/i,
            X = /^h\d$/i,
            Y = /^[^{]+\{\s*\[native \w/,
            Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            $ = /[+~]/,
            _ = /'|\\/g,
            ab = new RegExp("\\\\([\\da-f]{1,6}" + K + "?|(" + K + ")|.)", "ig"),
            bb = function(a, b, c) {
                var d = "0x" + b - 65536;
                return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
            };
        try {
            G.apply(D = H.call(t.childNodes), t.childNodes), D[t.childNodes.length].nodeType
        } catch (cb) {
            G = {
                apply: D.length ? function(a, b) {
                    F.apply(a, H.call(b))
                } : function(a, b) {
                    var c = a.length,
                        d = 0;
                    while (a[c++] = b[d++]);
                    a.length = c - 1
                }
            }
        }

        function db(a, b, d, e) {
            var f, g, h, i, j, m, p, q, u, v;
            if ((b ? b.ownerDocument || b : t) !== l && k(b), b = b || l, d = d || [], !a || "string" != typeof a) return d;
            if (1 !== (i = b.nodeType) && 9 !== i) return [];
            if (n && !e) {
                if (f = Z.exec(a))
                    if (h = f[1]) {
                        if (9 === i) {
                            if (g = b.getElementById(h), !g || !g.parentNode) return d;
                            if (g.id === h) return d.push(g), d
                        } else if (b.ownerDocument && (g = b.ownerDocument.getElementById(h)) && r(b, g) && g.id === h) return d.push(g), d
                    } else {
                        if (f[2]) return G.apply(d, b.getElementsByTagName(a)), d;
                        if ((h = f[3]) && c.getElementsByClassName && b.getElementsByClassName) return G.apply(d, b.getElementsByClassName(h)), d
                    }
                if (c.qsa && (!o || !o.test(a))) {
                    if (q = p = s, u = b, v = 9 === i && a, 1 === i && "object" !== b.nodeName.toLowerCase()) {
                        m = ob(a), (p = b.getAttribute("id")) ? q = p.replace(_, "\\$&") : b.setAttribute("id", q), q = "[id='" + q + "'] ", j = m.length;
                        while (j--) m[j] = q + pb(m[j]);
                        u = $.test(a) && mb(b.parentNode) || b, v = m.join(",")
                    }
                    if (v) try {
                        return G.apply(d, u.querySelectorAll(v)), d
                    } catch (w) {} finally {
                        p || b.removeAttribute("id")
                    }
                }
            }
            return xb(a.replace(P, "$1"), b, d, e)
        }

        function eb() {
            var a = [];

            function b(c, e) {
                return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e
            }
            return b
        }

        function fb(a) {
            return a[s] = !0, a
        }

        function gb(a) {
            var b = l.createElement("div");
            try {
                return !!a(b)
            } catch (c) {
                return !1
            } finally {
                b.parentNode && b.parentNode.removeChild(b), b = null
            }
        }

        function hb(a, b) {
            var c = a.split("|"),
                e = a.length;
            while (e--) d.attrHandle[c[e]] = b
        }

        function ib(a, b) {
            var c = b && a,
                d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || B) - (~a.sourceIndex || B);
            if (d) return d;
            if (c)
                while (c = c.nextSibling)
                    if (c === b) return -1;
            return a ? 1 : -1
        }

        function jb(a) {
            return function(b) {
                var c = b.nodeName.toLowerCase();
                return "input" === c && b.type === a
            }
        }

        function kb(a) {
            return function(b) {
                var c = b.nodeName.toLowerCase();
                return ("input" === c || "button" === c) && b.type === a
            }
        }

        function lb(a) {
            return fb(function(b) {
                return b = +b, fb(function(c, d) {
                    var e, f = a([], c.length, b),
                        g = f.length;
                    while (g--) c[e = f[g]] && (c[e] = !(d[e] = c[e]))
                })
            })
        }

        function mb(a) {
            return a && typeof a.getElementsByTagName !== A && a
        }
        c = db.support = {}, f = db.isXML = function(a) {
            var b = a && (a.ownerDocument || a).documentElement;
            return b ? "HTML" !== b.nodeName : !1
        }, k = db.setDocument = function(a) {
            var b, e = a ? a.ownerDocument || a : t,
                g = e.defaultView;
            return e !== l && 9 === e.nodeType && e.documentElement ? (l = e, m = e.documentElement, n = !f(e), g && g !== g.top && (g.addEventListener ? g.addEventListener("unload", function() {
                k()
            }, !1) : g.attachEvent && g.attachEvent("onunload", function() {
                k()
            })), c.attributes = gb(function(a) {
                return a.className = "i", !a.getAttribute("className")
            }), c.getElementsByTagName = gb(function(a) {
                return a.appendChild(e.createComment("")), !a.getElementsByTagName("*").length
            }), c.getElementsByClassName = Y.test(e.getElementsByClassName) && gb(function(a) {
                return a.innerHTML = "<div class='a'></div><div class='a i'></div>", a.firstChild.className = "i", 2 === a.getElementsByClassName("i").length
            }), c.getById = gb(function(a) {
                return m.appendChild(a).id = s, !e.getElementsByName || !e.getElementsByName(s).length
            }), c.getById ? (d.find.ID = function(a, b) {
                if (typeof b.getElementById !== A && n) {
                    var c = b.getElementById(a);
                    return c && c.parentNode ? [c] : []
                }
            }, d.filter.ID = function(a) {
                var b = a.replace(ab, bb);
                return function(a) {
                    return a.getAttribute("id") === b
                }
            }) : (delete d.find.ID, d.filter.ID = function(a) {
                var b = a.replace(ab, bb);
                return function(a) {
                    var c = typeof a.getAttributeNode !== A && a.getAttributeNode("id");
                    return c && c.value === b
                }
            }), d.find.TAG = c.getElementsByTagName ? function(a, b) {
                return typeof b.getElementsByTagName !== A ? b.getElementsByTagName(a) : void 0
            } : function(a, b) {
                var c, d = [],
                    e = 0,
                    f = b.getElementsByTagName(a);
                if ("*" === a) {
                    while (c = f[e++]) 1 === c.nodeType && d.push(c);
                    return d
                }
                return f
            }, d.find.CLASS = c.getElementsByClassName && function(a, b) {
                return typeof b.getElementsByClassName !== A && n ? b.getElementsByClassName(a) : void 0
            }, p = [], o = [], (c.qsa = Y.test(e.querySelectorAll)) && (gb(function(a) {
                a.innerHTML = "<select t=''><option selected=''></option></select>", a.querySelectorAll("[t^='']").length && o.push("[*^$]=" + K + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || o.push("\\[" + K + "*(?:value|" + J + ")"), a.querySelectorAll(":checked").length || o.push(":checked")
            }), gb(function(a) {
                var b = e.createElement("input");
                b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && o.push("name" + K + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || o.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), o.push(",.*:")
            })), (c.matchesSelector = Y.test(q = m.webkitMatchesSelector || m.mozMatchesSelector || m.oMatchesSelector || m.msMatchesSelector)) && gb(function(a) {
                c.disconnectedMatch = q.call(a, "div"), q.call(a, "[s!='']:x"), p.push("!=", O)
            }), o = o.length && new RegExp(o.join("|")), p = p.length && new RegExp(p.join("|")), b = Y.test(m.compareDocumentPosition), r = b || Y.test(m.contains) ? function(a, b) {
                var c = 9 === a.nodeType ? a.documentElement : a,
                    d = b && b.parentNode;
                return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
            } : function(a, b) {
                if (b)
                    while (b = b.parentNode)
                        if (b === a) return !0;
                return !1
            }, z = b ? function(a, b) {
                if (a === b) return j = !0, 0;
                var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
                return d ? d : (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === e || a.ownerDocument === t && r(t, a) ? -1 : b === e || b.ownerDocument === t && r(t, b) ? 1 : i ? I.call(i, a) - I.call(i, b) : 0 : 4 & d ? -1 : 1)
            } : function(a, b) {
                if (a === b) return j = !0, 0;
                var c, d = 0,
                    f = a.parentNode,
                    g = b.parentNode,
                    h = [a],
                    k = [b];
                if (!f || !g) return a === e ? -1 : b === e ? 1 : f ? -1 : g ? 1 : i ? I.call(i, a) - I.call(i, b) : 0;
                if (f === g) return ib(a, b);
                c = a;
                while (c = c.parentNode) h.unshift(c);
                c = b;
                while (c = c.parentNode) k.unshift(c);
                while (h[d] === k[d]) d++;
                return d ? ib(h[d], k[d]) : h[d] === t ? -1 : k[d] === t ? 1 : 0
            }, e) : l
        }, db.matches = function(a, b) {
            return db(a, null, null, b)
        }, db.matchesSelector = function(a, b) {
            if ((a.ownerDocument || a) !== l && k(a), b = b.replace(S, "='$1']"), !(!c.matchesSelector || !n || p && p.test(b) || o && o.test(b))) try {
                var d = q.call(a, b);
                if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType) return d
            } catch (e) {}
            return db(b, l, null, [a]).length > 0
        }, db.contains = function(a, b) {
            return (a.ownerDocument || a) !== l && k(a), r(a, b)
        }, db.attr = function(a, b) {
            (a.ownerDocument || a) !== l && k(a);
            var e = d.attrHandle[b.toLowerCase()],
                f = e && C.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !n) : void 0;
            return void 0 !== f ? f : c.attributes || !n ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null
        }, db.error = function(a) {
            throw new Error("Syntax error, unrecognized expression: " + a)
        }, db.uniqueSort = function(a) {
            var b, d = [],
                e = 0,
                f = 0;
            if (j = !c.detectDuplicates, i = !c.sortStable && a.slice(0), a.sort(z), j) {
                while (b = a[f++]) b === a[f] && (e = d.push(f));
                while (e--) a.splice(d[e], 1)
            }
            return i = null, a
        }, e = db.getText = function(a) {
            var b, c = "",
                d = 0,
                f = a.nodeType;
            if (f) {
                if (1 === f || 9 === f || 11 === f) {
                    if ("string" == typeof a.textContent) return a.textContent;
                    for (a = a.firstChild; a; a = a.nextSibling) c += e(a)
                } else if (3 === f || 4 === f) return a.nodeValue
            } else
                while (b = a[d++]) c += e(b);
            return c
        }, d = db.selectors = {
            cacheLength: 50,
            createPseudo: fb,
            match: V,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function(a) {
                    return a[1] = a[1].replace(ab, bb), a[3] = (a[4] || a[5] || "").replace(ab, bb), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
                },
                CHILD: function(a) {
                    return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || db.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && db.error(a[0]), a
                },
                PSEUDO: function(a) {
                    var b, c = !a[5] && a[2];
                    return V.CHILD.test(a[0]) ? null : (a[3] && void 0 !== a[4] ? a[2] = a[4] : c && T.test(c) && (b = ob(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
                }
            },
            filter: {
                TAG: function(a) {
                    var b = a.replace(ab, bb).toLowerCase();
                    return "*" === a ? function() {
                        return !0
                    } : function(a) {
                        return a.nodeName && a.nodeName.toLowerCase() === b
                    }
                },
                CLASS: function(a) {
                    var b = w[a + " "];
                    return b || (b = new RegExp("(^|" + K + ")" + a + "(" + K + "|$)")) && w(a, function(a) {
                        return b.test("string" == typeof a.className && a.className || typeof a.getAttribute !== A && a.getAttribute("class") || "")
                    })
                },
                ATTR: function(a, b, c) {
                    return function(d) {
                        var e = db.attr(d, a);
                        return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0
                    }
                },
                CHILD: function(a, b, c, d, e) {
                    var f = "nth" !== a.slice(0, 3),
                        g = "last" !== a.slice(-4),
                        h = "of-type" === b;
                    return 1 === d && 0 === e ? function(a) {
                        return !!a.parentNode
                    } : function(b, c, i) {
                        var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling",
                            q = b.parentNode,
                            r = h && b.nodeName.toLowerCase(),
                            t = !i && !h;
                        if (q) {
                            if (f) {
                                while (p) {
                                    l = b;
                                    while (l = l[p])
                                        if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) return !1;
                                    o = p = "only" === a && !o && "nextSibling"
                                }
                                return !0
                            }
                            if (o = [g ? q.firstChild : q.lastChild], g && t) {
                                k = q[s] || (q[s] = {}), j = k[a] || [], n = j[0] === u && j[1], m = j[0] === u && j[2], l = n && q.childNodes[n];
                                while (l = ++n && l && l[p] || (m = n = 0) || o.pop())
                                    if (1 === l.nodeType && ++m && l === b) {
                                        k[a] = [u, n, m];
                                        break
                                    }
                            } else if (t && (j = (b[s] || (b[s] = {}))[a]) && j[0] === u) m = j[1];
                            else
                                while (l = ++n && l && l[p] || (m = n = 0) || o.pop())
                                    if ((h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) && ++m && (t && ((l[s] || (l[s] = {}))[a] = [u, m]), l === b)) break; return m -= e, m === d || m % d === 0 && m / d >= 0
                        }
                    }
                },
                PSEUDO: function(a, b) {
                    var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || db.error("unsupported pseudo: " + a);
                    return e[s] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? fb(function(a, c) {
                        var d, f = e(a, b),
                            g = f.length;
                        while (g--) d = I.call(a, f[g]), a[d] = !(c[d] = f[g])
                    }) : function(a) {
                        return e(a, 0, c)
                    }) : e
                }
            },
            pseudos: {
                not: fb(function(a) {
                    var b = [],
                        c = [],
                        d = g(a.replace(P, "$1"));
                    return d[s] ? fb(function(a, b, c, e) {
                        var f, g = d(a, null, e, []),
                            h = a.length;
                        while (h--)(f = g[h]) && (a[h] = !(b[h] = f))
                    }) : function(a, e, f) {
                        return b[0] = a, d(b, null, f, c), !c.pop()
                    }
                }),
                has: fb(function(a) {
                    return function(b) {
                        return db(a, b).length > 0
                    }
                }),
                contains: fb(function(a) {
                    return function(b) {
                        return (b.textContent || b.innerText || e(b)).indexOf(a) > -1
                    }
                }),
                lang: fb(function(a) {
                    return U.test(a || "") || db.error("unsupported lang: " + a), a = a.replace(ab, bb).toLowerCase(),
                        function(b) {
                            var c;
                            do
                                if (c = n ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang")) return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-");
                            while ((b = b.parentNode) && 1 === b.nodeType);
                            return !1
                        }
                }),
                target: function(b) {
                    var c = a.location && a.location.hash;
                    return c && c.slice(1) === b.id
                },
                root: function(a) {
                    return a === m
                },
                focus: function(a) {
                    return a === l.activeElement && (!l.hasFocus || l.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
                },
                enabled: function(a) {
                    return a.disabled === !1
                },
                disabled: function(a) {
                    return a.disabled === !0
                },
                checked: function(a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && !!a.checked || "option" === b && !!a.selected
                },
                selected: function(a) {
                    return a.parentNode && a.parentNode.selectedIndex, a.selected === !0
                },
                empty: function(a) {
                    for (a = a.firstChild; a; a = a.nextSibling)
                        if (a.nodeType < 6) return !1;
                    return !0
                },
                parent: function(a) {
                    return !d.pseudos.empty(a)
                },
                header: function(a) {
                    return X.test(a.nodeName)
                },
                input: function(a) {
                    return W.test(a.nodeName)
                },
                button: function(a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && "button" === a.type || "button" === b
                },
                text: function(a) {
                    var b;
                    return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase())
                },
                first: lb(function() {
                    return [0]
                }),
                last: lb(function(a, b) {
                    return [b - 1]
                }),
                eq: lb(function(a, b, c) {
                    return [0 > c ? c + b : c]
                }),
                even: lb(function(a, b) {
                    for (var c = 0; b > c; c += 2) a.push(c);
                    return a
                }),
                odd: lb(function(a, b) {
                    for (var c = 1; b > c; c += 2) a.push(c);
                    return a
                }),
                lt: lb(function(a, b, c) {
                    for (var d = 0 > c ? c + b : c; --d >= 0;) a.push(d);
                    return a
                }),
                gt: lb(function(a, b, c) {
                    for (var d = 0 > c ? c + b : c; ++d < b;) a.push(d);
                    return a
                })
            }
        }, d.pseudos.nth = d.pseudos.eq;
        for (b in {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) d.pseudos[b] = jb(b);
        for (b in {
                submit: !0,
                reset: !0
            }) d.pseudos[b] = kb(b);

        function nb() {}
        nb.prototype = d.filters = d.pseudos, d.setFilters = new nb;

        function ob(a, b) {
            var c, e, f, g, h, i, j, k = x[a + " "];
            if (k) return b ? 0 : k.slice(0);
            h = a, i = [], j = d.preFilter;
            while (h) {
                (!c || (e = Q.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = R.exec(h)) && (c = e.shift(), f.push({
                    value: c,
                    type: e[0].replace(P, " ")
                }), h = h.slice(c.length));
                for (g in d.filter) !(e = V[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({
                    value: c,
                    type: g,
                    matches: e
                }), h = h.slice(c.length));
                if (!c) break
            }
            return b ? h.length : h ? db.error(a) : x(a, i).slice(0)
        }

        function pb(a) {
            for (var b = 0, c = a.length, d = ""; c > b; b++) d += a[b].value;
            return d
        }

        function qb(a, b, c) {
            var d = b.dir,
                e = c && "parentNode" === d,
                f = v++;
            return b.first ? function(b, c, f) {
                while (b = b[d])
                    if (1 === b.nodeType || e) return a(b, c, f)
            } : function(b, c, g) {
                var h, i, j = [u, f];
                if (g) {
                    while (b = b[d])
                        if ((1 === b.nodeType || e) && a(b, c, g)) return !0
                } else
                    while (b = b[d])
                        if (1 === b.nodeType || e) {
                            if (i = b[s] || (b[s] = {}), (h = i[d]) && h[0] === u && h[1] === f) return j[2] = h[2];
                            if (i[d] = j, j[2] = a(b, c, g)) return !0
                        }
            }
        }

        function rb(a) {
            return a.length > 1 ? function(b, c, d) {
                var e = a.length;
                while (e--)
                    if (!a[e](b, c, d)) return !1;
                return !0
            } : a[0]
        }

        function sb(a, b, c, d, e) {
            for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
            return g
        }

        function tb(a, b, c, d, e, f) {
            return d && !d[s] && (d = tb(d)), e && !e[s] && (e = tb(e, f)), fb(function(f, g, h, i) {
                var j, k, l, m = [],
                    n = [],
                    o = g.length,
                    p = f || wb(b || "*", h.nodeType ? [h] : h, []),
                    q = !a || !f && b ? p : sb(p, m, a, h, i),
                    r = c ? e || (f ? a : o || d) ? [] : g : q;
                if (c && c(q, r, h, i), d) {
                    j = sb(r, n), d(j, [], h, i), k = j.length;
                    while (k--)(l = j[k]) && (r[n[k]] = !(q[n[k]] = l))
                }
                if (f) {
                    if (e || a) {
                        if (e) {
                            j = [], k = r.length;
                            while (k--)(l = r[k]) && j.push(q[k] = l);
                            e(null, r = [], j, i)
                        }
                        k = r.length;
                        while (k--)(l = r[k]) && (j = e ? I.call(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l))
                    }
                } else r = sb(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : G.apply(g, r)
            })
        }

        function ub(a) {
            for (var b, c, e, f = a.length, g = d.relative[a[0].type], i = g || d.relative[" "], j = g ? 1 : 0, k = qb(function(a) {
                    return a === b
                }, i, !0), l = qb(function(a) {
                    return I.call(b, a) > -1
                }, i, !0), m = [function(a, c, d) {
                    return !g && (d || c !== h) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d))
                }]; f > j; j++)
                if (c = d.relative[a[j].type]) m = [qb(rb(m), c)];
                else {
                    if (c = d.filter[a[j].type].apply(null, a[j].matches), c[s]) {
                        for (e = ++j; f > e; e++)
                            if (d.relative[a[e].type]) break;
                        return tb(j > 1 && rb(m), j > 1 && pb(a.slice(0, j - 1).concat({
                            value: " " === a[j - 2].type ? "*" : ""
                        })).replace(P, "$1"), c, e > j && ub(a.slice(j, e)), f > e && ub(a = a.slice(e)), f > e && pb(a))
                    }
                    m.push(c)
                }
            return rb(m)
        }

        function vb(a, b) {
            var c = b.length > 0,
                e = a.length > 0,
                f = function(f, g, i, j, k) {
                    var m, n, o, p = 0,
                        q = "0",
                        r = f && [],
                        s = [],
                        t = h,
                        v = f || e && d.find.TAG("*", k),
                        w = u += null == t ? 1 : Math.random() || .1,
                        x = v.length;
                    for (k && (h = g !== l && g); q !== x && null != (m = v[q]); q++) {
                        if (e && m) {
                            n = 0;
                            while (o = a[n++])
                                if (o(m, g, i)) {
                                    j.push(m);
                                    break
                                }
                            k && (u = w)
                        }
                        c && ((m = !o && m) && p--, f && r.push(m))
                    }
                    if (p += q, c && q !== p) {
                        n = 0;
                        while (o = b[n++]) o(r, s, g, i);
                        if (f) {
                            if (p > 0)
                                while (q--) r[q] || s[q] || (s[q] = E.call(j));
                            s = sb(s)
                        }
                        G.apply(j, s), k && !f && s.length > 0 && p + b.length > 1 && db.uniqueSort(j)
                    }
                    return k && (u = w, h = t), r
                };
            return c ? fb(f) : f
        }
        g = db.compile = function(a, b) {
            var c, d = [],
                e = [],
                f = y[a + " "];
            if (!f) {
                b || (b = ob(a)), c = b.length;
                while (c--) f = ub(b[c]), f[s] ? d.push(f) : e.push(f);
                f = y(a, vb(e, d))
            }
            return f
        };

        function wb(a, b, c) {
            for (var d = 0, e = b.length; e > d; d++) db(a, b[d], c);
            return c
        }

        function xb(a, b, e, f) {
            var h, i, j, k, l, m = ob(a);
            if (!f && 1 === m.length) {
                if (i = m[0] = m[0].slice(0), i.length > 2 && "ID" === (j = i[0]).type && c.getById && 9 === b.nodeType && n && d.relative[i[1].type]) {
                    if (b = (d.find.ID(j.matches[0].replace(ab, bb), b) || [])[0], !b) return e;
                    a = a.slice(i.shift().value.length)
                }
                h = V.needsContext.test(a) ? 0 : i.length;
                while (h--) {
                    if (j = i[h], d.relative[k = j.type]) break;
                    if ((l = d.find[k]) && (f = l(j.matches[0].replace(ab, bb), $.test(i[0].type) && mb(b.parentNode) || b))) {
                        if (i.splice(h, 1), a = f.length && pb(i), !a) return G.apply(e, f), e;
                        break
                    }
                }
            }
            return g(a, m)(f, b, !n, e, $.test(a) && mb(b.parentNode) || b), e
        }
        return c.sortStable = s.split("").sort(z).join("") === s, c.detectDuplicates = !!j, k(), c.sortDetached = gb(function(a) {
            return 1 & a.compareDocumentPosition(l.createElement("div"))
        }), gb(function(a) {
            return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href")
        }) || hb("type|href|height|width", function(a, b, c) {
            return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2)
        }), c.attributes && gb(function(a) {
            return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value")
        }) || hb("value", function(a, b, c) {
            return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue
        }), gb(function(a) {
            return null == a.getAttribute("disabled")
        }) || hb(J, function(a, b, c) {
            var d;
            return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
        }), db
    }(a);
    n.find = t, n.expr = t.selectors, n.expr[":"] = n.expr.pseudos, n.unique = t.uniqueSort, n.text = t.getText, n.isXMLDoc = t.isXML, n.contains = t.contains;
    var u = n.expr.match.needsContext,
        v = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        w = /^.[^:#\[\.,]*$/;

    function x(a, b, c) {
        if (n.isFunction(b)) return n.grep(a, function(a, d) {
            return !!b.call(a, d, a) !== c
        });
        if (b.nodeType) return n.grep(a, function(a) {
            return a === b !== c
        });
        if ("string" == typeof b) {
            if (w.test(b)) return n.filter(b, a, c);
            b = n.filter(b, a)
        }
        return n.grep(a, function(a) {
            return n.inArray(a, b) >= 0 !== c
        })
    }
    n.filter = function(a, b, c) {
        var d = b[0];
        return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? n.find.matchesSelector(d, a) ? [d] : [] : n.find.matches(a, n.grep(b, function(a) {
            return 1 === a.nodeType
        }))
    }, n.fn.extend({
        find: function(a) {
            var b, c = [],
                d = this,
                e = d.length;
            if ("string" != typeof a) return this.pushStack(n(a).filter(function() {
                for (b = 0; e > b; b++)
                    if (n.contains(d[b], this)) return !0
            }));
            for (b = 0; e > b; b++) n.find(a, d[b], c);
            return c = this.pushStack(e > 1 ? n.unique(c) : c), c.selector = this.selector ? this.selector + " " + a : a, c
        },
        filter: function(a) {
            return this.pushStack(x(this, a || [], !1))
        },
        not: function(a) {
            return this.pushStack(x(this, a || [], !0))
        },
        is: function(a) {
            return !!x(this, "string" == typeof a && u.test(a) ? n(a) : a || [], !1).length
        }
    });
    var y, z = a.document,
        A = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        B = n.fn.init = function(a, b) {
            var c, d;
            if (!a) return this;
            if ("string" == typeof a) {
                if (c = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [null, a, null] : A.exec(a), !c || !c[1] && b) return !b || b.jquery ? (b || y).find(a) : this.constructor(b).find(a);
                if (c[1]) {
                    if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : z, !0)), v.test(c[1]) && n.isPlainObject(b))
                        for (c in b) n.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
                    return this
                }
                if (d = z.getElementById(c[2]), d && d.parentNode) {
                    if (d.id !== c[2]) return y.find(a);
                    this.length = 1, this[0] = d
                }
                return this.context = z, this.selector = a, this
            }
            return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : n.isFunction(a) ? "undefined" != typeof y.ready ? y.ready(a) : a(n) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), n.makeArray(a, this))
        };
    B.prototype = n.fn, y = n(z);
    var C = /^(?:parents|prev(?:Until|All))/,
        D = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
    n.extend({
        dir: function(a, b, c) {
            var d = [],
                e = a[b];
            while (e && 9 !== e.nodeType && (void 0 === c || 1 !== e.nodeType || !n(e).is(c))) 1 === e.nodeType && d.push(e), e = e[b];
            return d
        },
        sibling: function(a, b) {
            for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
            return c
        }
    }), n.fn.extend({
        has: function(a) {
            var b, c = n(a, this),
                d = c.length;
            return this.filter(function() {
                for (b = 0; d > b; b++)
                    if (n.contains(this, c[b])) return !0
            })
        },
        closest: function(a, b) {
            for (var c, d = 0, e = this.length, f = [], g = u.test(a) || "string" != typeof a ? n(a, b || this.context) : 0; e > d; d++)
                for (c = this[d]; c && c !== b; c = c.parentNode)
                    if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && n.find.matchesSelector(c, a))) {
                        f.push(c);
                        break
                    }
            return this.pushStack(f.length > 1 ? n.unique(f) : f)
        },
        index: function(a) {
            return a ? "string" == typeof a ? n.inArray(this[0], n(a)) : n.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(a, b) {
            return this.pushStack(n.unique(n.merge(this.get(), n(a, b))))
        },
        addBack: function(a) {
            return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
        }
    });

    function E(a, b) {
        do a = a[b]; while (a && 1 !== a.nodeType);
        return a
    }
    n.each({
        parent: function(a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b : null
        },
        parents: function(a) {
            return n.dir(a, "parentNode")
        },
        parentsUntil: function(a, b, c) {
            return n.dir(a, "parentNode", c)
        },
        next: function(a) {
            return E(a, "nextSibling")
        },
        prev: function(a) {
            return E(a, "previousSibling")
        },
        nextAll: function(a) {
            return n.dir(a, "nextSibling")
        },
        prevAll: function(a) {
            return n.dir(a, "previousSibling")
        },
        nextUntil: function(a, b, c) {
            return n.dir(a, "nextSibling", c)
        },
        prevUntil: function(a, b, c) {
            return n.dir(a, "previousSibling", c)
        },
        siblings: function(a) {
            return n.sibling((a.parentNode || {}).firstChild, a)
        },
        children: function(a) {
            return n.sibling(a.firstChild)
        },
        contents: function(a) {
            return n.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : n.merge([], a.childNodes)
        }
    }, function(a, b) {
        n.fn[a] = function(c, d) {
            var e = n.map(this, b, c);
            return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = n.filter(d, e)), this.length > 1 && (D[a] || (e = n.unique(e)), C.test(a) && (e = e.reverse())), this.pushStack(e)
        }
    });
    var F = /\S+/g,
        G = {};

    function H(a) {
        var b = G[a] = {};
        return n.each(a.match(F) || [], function(a, c) {
            b[c] = !0
        }), b
    }
    n.Callbacks = function(a) {
        a = "string" == typeof a ? G[a] || H(a) : n.extend({}, a);
        var b, c, d, e, f, g, h = [],
            i = !a.once && [],
            j = function(l) {
                for (c = a.memory && l, d = !0, f = g || 0, g = 0, e = h.length, b = !0; h && e > f; f++)
                    if (h[f].apply(l[0], l[1]) === !1 && a.stopOnFalse) {
                        c = !1;
                        break
                    }
                b = !1, h && (i ? i.length && j(i.shift()) : c ? h = [] : k.disable())
            },
            k = {
                add: function() {
                    if (h) {
                        var d = h.length;
                        ! function f(b) {
                            n.each(b, function(b, c) {
                                var d = n.type(c);
                                "function" === d ? a.unique && k.has(c) || h.push(c) : c && c.length && "string" !== d && f(c)
                            })
                        }(arguments), b ? e = h.length : c && (g = d, j(c))
                    }
                    return this
                },
                remove: function() {
                    return h && n.each(arguments, function(a, c) {
                        var d;
                        while ((d = n.inArray(c, h, d)) > -1) h.splice(d, 1), b && (e >= d && e--, f >= d && f--)
                    }), this
                },
                has: function(a) {
                    return a ? n.inArray(a, h) > -1 : !(!h || !h.length)
                },
                empty: function() {
                    return h = [], e = 0, this
                },
                disable: function() {
                    return h = i = c = void 0, this
                },
                disabled: function() {
                    return !h
                },
                lock: function() {
                    return i = void 0, c || k.disable(), this
                },
                locked: function() {
                    return !i
                },
                fireWith: function(a, c) {
                    return !h || d && !i || (c = c || [], c = [a, c.slice ? c.slice() : c], b ? i.push(c) : j(c)), this
                },
                fire: function() {
                    return k.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!d
                }
            };
        return k
    }, n.extend({
        Deferred: function(a) {
            var b = [
                    ["resolve", "done", n.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", n.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", n.Callbacks("memory")]
                ],
                c = "pending",
                d = {
                    state: function() {
                        return c
                    },
                    always: function() {
                        return e.done(arguments).fail(arguments), this
                    },
                    then: function() {
                        var a = arguments;
                        return n.Deferred(function(c) {
                            n.each(b, function(b, f) {
                                var g = n.isFunction(a[b]) && a[b];
                                e[f[1]](function() {
                                    var a = g && g.apply(this, arguments);
                                    a && n.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments)
                                })
                            }), a = null
                        }).promise()
                    },
                    promise: function(a) {
                        return null != a ? n.extend(a, d) : d
                    }
                },
                e = {};
            return d.pipe = d.then, n.each(b, function(a, f) {
                var g = f[2],
                    h = f[3];
                d[f[1]] = g.add, h && g.add(function() {
                    c = h
                }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function() {
                    return e[f[0] + "With"](this === e ? d : this, arguments), this
                }, e[f[0] + "With"] = g.fireWith
            }), d.promise(e), a && a.call(e, e), e
        },
        when: function(a) {
            var b = 0,
                c = d.call(arguments),
                e = c.length,
                f = 1 !== e || a && n.isFunction(a.promise) ? e : 0,
                g = 1 === f ? a : n.Deferred(),
                h = function(a, b, c) {
                    return function(e) {
                        b[a] = this, c[a] = arguments.length > 1 ? d.call(arguments) : e, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c)
                    }
                },
                i, j, k;
            if (e > 1)
                for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++) c[b] && n.isFunction(c[b].promise) ? c[b].promise().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
            return f || g.resolveWith(k, c), g.promise()
        }
    });
    var I;
    n.fn.ready = function(a) {
        return n.ready.promise().done(a), this
    }, n.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function(a) {
            a ? n.readyWait++ : n.ready(!0)
        },
        ready: function(a) {
            if (a === !0 ? !--n.readyWait : !n.isReady) {
                if (!z.body) return setTimeout(n.ready);
                n.isReady = !0, a !== !0 && --n.readyWait > 0 || (I.resolveWith(z, [n]), n.fn.trigger && n(z).trigger("ready").off("ready"))
            }
        }
    });

    function J() {
        z.addEventListener ? (z.removeEventListener("DOMContentLoaded", K, !1), a.removeEventListener("load", K, !1)) : (z.detachEvent("onreadystatechange", K), a.detachEvent("onload", K))
    }

    function K() {
        (z.addEventListener || "load" === event.type || "complete" === z.readyState) && (J(), n.ready())
    }
    n.ready.promise = function(b) {
        if (!I)
            if (I = n.Deferred(), "complete" === z.readyState) setTimeout(n.ready);
            else if (z.addEventListener) z.addEventListener("DOMContentLoaded", K, !1), a.addEventListener("load", K, !1);
        else {
            z.attachEvent("onreadystatechange", K), a.attachEvent("onload", K);
            var c = !1;
            try {
                c = null == a.frameElement && z.documentElement
            } catch (d) {}
            c && c.doScroll && ! function e() {
                if (!n.isReady) {
                    try {
                        c.doScroll("left")
                    } catch (a) {
                        return setTimeout(e, 50)
                    }
                    J(), n.ready()
                }
            }()
        }
        return I.promise(b)
    };
    var L = "undefined",
        M;
    for (M in n(l)) break;
    l.ownLast = "0" !== M, l.inlineBlockNeedsLayout = !1, n(function() {
            var a, b, c = z.getElementsByTagName("body")[0];
            c && (a = z.createElement("div"), a.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", b = z.createElement("div"), c.appendChild(a).appendChild(b), typeof b.style.zoom !== L && (b.style.cssText = "border:0;margin:0;width:1px;padding:1px;display:inline;zoom:1", (l.inlineBlockNeedsLayout = 3 === b.offsetWidth) && (c.style.zoom = 1)), c.removeChild(a), a = b = null)
        }),
        function() {
            var a = z.createElement("div");
            if (null == l.deleteExpando) {
                l.deleteExpando = !0;
                try {
                    delete a.test
                } catch (b) {
                    l.deleteExpando = !1
                }
            }
            a = null
        }(), n.acceptData = function(a) {
            var b = n.noData[(a.nodeName + " ").toLowerCase()],
                c = +a.nodeType || 1;
            return 1 !== c && 9 !== c ? !1 : !b || b !== !0 && a.getAttribute("classid") === b
        };
    var N = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        O = /([A-Z])/g;

    function P(a, b, c) {
        if (void 0 === c && 1 === a.nodeType) {
            var d = "data-" + b.replace(O, "-$1").toLowerCase();
            if (c = a.getAttribute(d), "string" == typeof c) {
                try {
                    c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : N.test(c) ? n.parseJSON(c) : c
                } catch (e) {}
                n.data(a, b, c)
            } else c = void 0
        }
        return c
    }

    function Q(a) {
        var b;
        for (b in a)
            if (("data" !== b || !n.isEmptyObject(a[b])) && "toJSON" !== b) return !1;
        return !0
    }

    function R(a, b, d, e) {
        if (n.acceptData(a)) {
            var f, g, h = n.expando,
                i = a.nodeType,
                j = i ? n.cache : a,
                k = i ? a[h] : a[h] && h;
            if (k && j[k] && (e || j[k].data) || void 0 !== d || "string" != typeof b) return k || (k = i ? a[h] = c.pop() || n.guid++ : h), j[k] || (j[k] = i ? {} : {
                toJSON: n.noop
            }), ("object" == typeof b || "function" == typeof b) && (e ? j[k] = n.extend(j[k], b) : j[k].data = n.extend(j[k].data, b)), g = j[k], e || (g.data || (g.data = {}), g = g.data), void 0 !== d && (g[n.camelCase(b)] = d), "string" == typeof b ? (f = g[b], null == f && (f = g[n.camelCase(b)])) : f = g, f
        }
    }

    function S(a, b, c) {
        if (n.acceptData(a)) {
            var d, e, f = a.nodeType,
                g = f ? n.cache : a,
                h = f ? a[n.expando] : n.expando;
            if (g[h]) {
                if (b && (d = c ? g[h] : g[h].data)) {
                    n.isArray(b) ? b = b.concat(n.map(b, n.camelCase)) : b in d ? b = [b] : (b = n.camelCase(b), b = b in d ? [b] : b.split(" ")), e = b.length;
                    while (e--) delete d[b[e]];
                    if (c ? !Q(d) : !n.isEmptyObject(d)) return
                }(c || (delete g[h].data, Q(g[h]))) && (f ? n.cleanData([a], !0) : l.deleteExpando || g != g.window ? delete g[h] : g[h] = null)
            }
        }
    }
    n.extend({
        cache: {},
        noData: {
            "applet ": !0,
            "embed ": !0,
            "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function(a) {
            return a = a.nodeType ? n.cache[a[n.expando]] : a[n.expando], !!a && !Q(a)
        },
        data: function(a, b, c) {
            return R(a, b, c)
        },
        removeData: function(a, b) {
            return S(a, b)
        },
        _data: function(a, b, c) {
            return R(a, b, c, !0)
        },
        _removeData: function(a, b) {
            return S(a, b, !0)
        }
    }), n.fn.extend({
        data: function(a, b) {
            var c, d, e, f = this[0],
                g = f && f.attributes;
            if (void 0 === a) {
                if (this.length && (e = n.data(f), 1 === f.nodeType && !n._data(f, "parsedAttrs"))) {
                    c = g.length;
                    while (c--) d = g[c].name, 0 === d.indexOf("data-") && (d = n.camelCase(d.slice(5)), P(f, d, e[d]));
                    n._data(f, "parsedAttrs", !0)
                }
                return e
            }
            return "object" == typeof a ? this.each(function() {
                n.data(this, a)
            }) : arguments.length > 1 ? this.each(function() {
                n.data(this, a, b)
            }) : f ? P(f, a, n.data(f, a)) : void 0
        },
        removeData: function(a) {
            return this.each(function() {
                n.removeData(this, a)
            })
        }
    }), n.extend({
        queue: function(a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = n._data(a, b), c && (!d || n.isArray(c) ? d = n._data(a, b, n.makeArray(c)) : d.push(c)), d || []) : void 0
        },
        dequeue: function(a, b) {
            b = b || "fx";
            var c = n.queue(a, b),
                d = c.length,
                e = c.shift(),
                f = n._queueHooks(a, b),
                g = function() {
                    n.dequeue(a, b)
                };
            "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
        },
        _queueHooks: function(a, b) {
            var c = b + "queueHooks";
            return n._data(a, c) || n._data(a, c, {
                empty: n.Callbacks("once memory").add(function() {
                    n._removeData(a, b + "queue"), n._removeData(a, c)
                })
            })
        }
    }), n.fn.extend({
        queue: function(a, b) {
            var c = 2;
            return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? n.queue(this[0], a) : void 0 === b ? this : this.each(function() {
                var c = n.queue(this, a, b);
                n._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && n.dequeue(this, a)
            })
        },
        dequeue: function(a) {
            return this.each(function() {
                n.dequeue(this, a)
            })
        },
        clearQueue: function(a) {
            return this.queue(a || "fx", [])
        },
        promise: function(a, b) {
            var c, d = 1,
                e = n.Deferred(),
                f = this,
                g = this.length,
                h = function() {
                    --d || e.resolveWith(f, [f])
                };
            "string" != typeof a && (b = a, a = void 0), a = a || "fx";
            while (g--) c = n._data(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h));
            return h(), e.promise(b)
        }
    });
    var T = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        U = ["Top", "Right", "Bottom", "Left"],
        V = function(a, b) {
            return a = b || a, "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a)
        },
        W = n.access = function(a, b, c, d, e, f, g) {
            var h = 0,
                i = a.length,
                j = null == c;
            if ("object" === n.type(c)) {
                e = !0;
                for (h in c) n.access(a, b, h, c[h], !0, f, g)
            } else if (void 0 !== d && (e = !0, n.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function(a, b, c) {
                    return j.call(n(a), c)
                })), b))
                for (; i > h; h++) b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
            return e ? a : j ? b.call(a) : i ? b(a[0], c) : f
        },
        X = /^(?:checkbox|radio)$/i;
    ! function() {
        var a = z.createDocumentFragment(),
            b = z.createElement("div"),
            c = z.createElement("input");
        if (b.setAttribute("className", "t"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a>", l.leadingWhitespace = 3 === b.firstChild.nodeType, l.tbody = !b.getElementsByTagName("tbody").length, l.htmlSerialize = !!b.getElementsByTagName("link").length, l.html5Clone = "<:nav></:nav>" !== z.createElement("nav").cloneNode(!0).outerHTML, c.type = "checkbox", c.checked = !0, a.appendChild(c), l.appendChecked = c.checked, b.innerHTML = "<textarea>x</textarea>", l.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue, a.appendChild(b), b.innerHTML = "<input type='radio' checked='checked' name='t'/>", l.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, l.noCloneEvent = !0, b.attachEvent && (b.attachEvent("onclick", function() {
                l.noCloneEvent = !1
            }), b.cloneNode(!0).click()), null == l.deleteExpando) {
            l.deleteExpando = !0;
            try {
                delete b.test
            } catch (d) {
                l.deleteExpando = !1
            }
        }
        a = b = c = null
    }(),
    function() {
        var b, c, d = z.createElement("div");
        for (b in {
                submit: !0,
                change: !0,
                focusin: !0
            }) c = "on" + b, (l[b + "Bubbles"] = c in a) || (d.setAttribute(c, "t"), l[b + "Bubbles"] = d.attributes[c].expando === !1);
        d = null
    }();
    var Y = /^(?:input|select|textarea)$/i,
        Z = /^key/,
        $ = /^(?:mouse|contextmenu)|click/,
        _ = /^(?:focusinfocus|focusoutblur)$/,
        ab = /^([^.]*)(?:\.(.+)|)$/;

    function bb() {
        return !0
    }

    function cb() {
        return !1
    }

    function db() {
        try {
            return z.activeElement
        } catch (a) {}
    }
    n.event = {
        global: {},
        add: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = n._data(a);
            if (r) {
                c.handler && (i = c, c = i.handler, e = i.selector), c.guid || (c.guid = n.guid++), (g = r.events) || (g = r.events = {}), (k = r.handle) || (k = r.handle = function(a) {
                    return typeof n === L || a && n.event.triggered === a.type ? void 0 : n.event.dispatch.apply(k.elem, arguments)
                }, k.elem = a), b = (b || "").match(F) || [""], h = b.length;
                while (h--) f = ab.exec(b[h]) || [], o = q = f[1], p = (f[2] || "").split(".").sort(), o && (j = n.event.special[o] || {}, o = (e ? j.delegateType : j.bindType) || o, j = n.event.special[o] || {}, l = n.extend({
                    type: o,
                    origType: q,
                    data: d,
                    handler: c,
                    guid: c.guid,
                    selector: e,
                    needsContext: e && n.expr.match.needsContext.test(e),
                    namespace: p.join(".")
                }, i), (m = g[o]) || (m = g[o] = [], m.delegateCount = 0, j.setup && j.setup.call(a, d, p, k) !== !1 || (a.addEventListener ? a.addEventListener(o, k, !1) : a.attachEvent && a.attachEvent("on" + o, k))), j.add && (j.add.call(a, l), l.handler.guid || (l.handler.guid = c.guid)), e ? m.splice(m.delegateCount++, 0, l) : m.push(l), n.event.global[o] = !0);
                a = null
            }
        },
        remove: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = n.hasData(a) && n._data(a);
            if (r && (k = r.events)) {
                b = (b || "").match(F) || [""], j = b.length;
                while (j--)
                    if (h = ab.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
                        l = n.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, m = k[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), i = f = m.length;
                        while (f--) g = m[f], !e && q !== g.origType || c && c.guid !== g.guid || h && !h.test(g.namespace) || d && d !== g.selector && ("**" !== d || !g.selector) || (m.splice(f, 1), g.selector && m.delegateCount--, l.remove && l.remove.call(a, g));
                        i && !m.length && (l.teardown && l.teardown.call(a, p, r.handle) !== !1 || n.removeEvent(a, o, r.handle), delete k[o])
                    } else
                        for (o in k) n.event.remove(a, o + b[j], c, d, !0);
                n.isEmptyObject(k) && (delete r.handle, n._removeData(a, "events"))
            }
        },
        trigger: function(b, c, d, e) {
            var f, g, h, i, k, l, m, o = [d || z],
                p = j.call(b, "type") ? b.type : b,
                q = j.call(b, "namespace") ? b.namespace.split(".") : [];
            if (h = l = d = d || z, 3 !== d.nodeType && 8 !== d.nodeType && !_.test(p + n.event.triggered) && (p.indexOf(".") >= 0 && (q = p.split("."), p = q.shift(), q.sort()), g = p.indexOf(":") < 0 && "on" + p, b = b[n.expando] ? b : new n.Event(p, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b.namespace = q.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + q.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = d), c = null == c ? [b] : n.makeArray(c, [b]), k = n.event.special[p] || {}, e || !k.trigger || k.trigger.apply(d, c) !== !1)) {
                if (!e && !k.noBubble && !n.isWindow(d)) {
                    for (i = k.delegateType || p, _.test(i + p) || (h = h.parentNode); h; h = h.parentNode) o.push(h), l = h;
                    l === (d.ownerDocument || z) && o.push(l.defaultView || l.parentWindow || a)
                }
                m = 0;
                while ((h = o[m++]) && !b.isPropagationStopped()) b.type = m > 1 ? i : k.bindType || p, f = (n._data(h, "events") || {})[b.type] && n._data(h, "handle"), f && f.apply(h, c), f = g && h[g], f && f.apply && n.acceptData(h) && (b.result = f.apply(h, c), b.result === !1 && b.preventDefault());
                if (b.type = p, !e && !b.isDefaultPrevented() && (!k._default || k._default.apply(o.pop(), c) === !1) && n.acceptData(d) && g && d[p] && !n.isWindow(d)) {
                    l = d[g], l && (d[g] = null), n.event.triggered = p;
                    try {
                        d[p]()
                    } catch (r) {}
                    n.event.triggered = void 0, l && (d[g] = l)
                }
                return b.result
            }
        },
        dispatch: function(a) {
            a = n.event.fix(a);
            var b, c, e, f, g, h = [],
                i = d.call(arguments),
                j = (n._data(this, "events") || {})[a.type] || [],
                k = n.event.special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) {
                h = n.event.handlers.call(this, a, j), b = 0;
                while ((f = h[b++]) && !a.isPropagationStopped()) {
                    a.currentTarget = f.elem, g = 0;
                    while ((e = f.handlers[g++]) && !a.isImmediatePropagationStopped())(!a.namespace_re || a.namespace_re.test(e.namespace)) && (a.handleObj = e, a.data = e.data, c = ((n.event.special[e.origType] || {}).handle || e.handler).apply(f.elem, i), void 0 !== c && (a.result = c) === !1 && (a.preventDefault(), a.stopPropagation()))
                }
                return k.postDispatch && k.postDispatch.call(this, a), a.result
            }
        },
        handlers: function(a, b) {
            var c, d, e, f, g = [],
                h = b.delegateCount,
                i = a.target;
            if (h && i.nodeType && (!a.button || "click" !== a.type))
                for (; i != this; i = i.parentNode || this)
                    if (1 === i.nodeType && (i.disabled !== !0 || "click" !== a.type)) {
                        for (e = [], f = 0; h > f; f++) d = b[f], c = d.selector + " ", void 0 === e[c] && (e[c] = d.needsContext ? n(c, this).index(i) >= 0 : n.find(c, this, null, [i]).length), e[c] && e.push(d);
                        e.length && g.push({
                            elem: i,
                            handlers: e
                        })
                    }
            return h < b.length && g.push({
                elem: this,
                handlers: b.slice(h)
            }), g
        },
        fix: function(a) {
            if (a[n.expando]) return a;
            var b, c, d, e = a.type,
                f = a,
                g = this.fixHooks[e];
            g || (this.fixHooks[e] = g = $.test(e) ? this.mouseHooks : Z.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new n.Event(f), b = d.length;
            while (b--) c = d[b], a[c] = f[c];
            return a.target || (a.target = f.srcElement || z), 3 === a.target.nodeType && (a.target = a.target.parentNode), a.metaKey = !!a.metaKey, g.filter ? g.filter(a, f) : a
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(a, b) {
                return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(a, b) {
                var c, d, e, f = b.button,
                    g = b.fromElement;
                return null == a.pageX && null != b.clientX && (d = a.target.ownerDocument || z, e = d.documentElement, c = d.body, a.pageX = b.clientX + (e && e.scrollLeft || c && c.scrollLeft || 0) - (e && e.clientLeft || c && c.clientLeft || 0), a.pageY = b.clientY + (e && e.scrollTop || c && c.scrollTop || 0) - (e && e.clientTop || c && c.clientTop || 0)), !a.relatedTarget && g && (a.relatedTarget = g === a.target ? b.toElement : g), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), a
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== db() && this.focus) try {
                        return this.focus(), !1
                    } catch (a) {}
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === db() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return n.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                },
                _default: function(a) {
                    return n.nodeName(a.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(a) {
                    void 0 !== a.result && (a.originalEvent.returnValue = a.result)
                }
            }
        },
        simulate: function(a, b, c, d) {
            var e = n.extend(new n.Event, c, {
                type: a,
                isSimulated: !0,
                originalEvent: {}
            });
            d ? n.event.trigger(e, null, b) : n.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
        }
    }, n.removeEvent = z.removeEventListener ? function(a, b, c) {
        a.removeEventListener && a.removeEventListener(b, c, !1)
    } : function(a, b, c) {
        var d = "on" + b;
        a.detachEvent && (typeof a[d] === L && (a[d] = null), a.detachEvent(d, c))
    }, n.Event = function(a, b) {
        return this instanceof n.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && (a.returnValue === !1 || a.getPreventDefault && a.getPreventDefault()) ? bb : cb) : this.type = a, b && n.extend(this, b), this.timeStamp = a && a.timeStamp || n.now(), void(this[n.expando] = !0)) : new n.Event(a, b)
    }, n.Event.prototype = {
        isDefaultPrevented: cb,
        isPropagationStopped: cb,
        isImmediatePropagationStopped: cb,
        preventDefault: function() {
            var a = this.originalEvent;
            this.isDefaultPrevented = bb, a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
        },
        stopPropagation: function() {
            var a = this.originalEvent;
            this.isPropagationStopped = bb, a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
        },
        stopImmediatePropagation: function() {
            this.isImmediatePropagationStopped = bb, this.stopPropagation()
        }
    }, n.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, function(a, b) {
        n.event.special[a] = {
            delegateType: b,
            bindType: b,
            handle: function(a) {
                var c, d = this,
                    e = a.relatedTarget,
                    f = a.handleObj;
                return (!e || e !== d && !n.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
            }
        }
    }), l.submitBubbles || (n.event.special.submit = {
        setup: function() {
            return n.nodeName(this, "form") ? !1 : void n.event.add(this, "click._submit keypress._submit", function(a) {
                var b = a.target,
                    c = n.nodeName(b, "input") || n.nodeName(b, "button") ? b.form : void 0;
                c && !n._data(c, "submitBubbles") && (n.event.add(c, "submit._submit", function(a) {
                    a._submit_bubble = !0
                }), n._data(c, "submitBubbles", !0))
            })
        },
        postDispatch: function(a) {
            a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && n.event.simulate("submit", this.parentNode, a, !0))
        },
        teardown: function() {
            return n.nodeName(this, "form") ? !1 : void n.event.remove(this, "._submit")
        }
    }), l.changeBubbles || (n.event.special.change = {
        setup: function() {
            return Y.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (n.event.add(this, "propertychange._change", function(a) {
                "checked" === a.originalEvent.propertyName && (this._just_changed = !0)
            }), n.event.add(this, "click._change", function(a) {
                this._just_changed && !a.isTrigger && (this._just_changed = !1), n.event.simulate("change", this, a, !0)
            })), !1) : void n.event.add(this, "beforeactivate._change", function(a) {
                var b = a.target;
                Y.test(b.nodeName) && !n._data(b, "changeBubbles") && (n.event.add(b, "change._change", function(a) {
                    !this.parentNode || a.isSimulated || a.isTrigger || n.event.simulate("change", this.parentNode, a, !0)
                }), n._data(b, "changeBubbles", !0))
            })
        },
        handle: function(a) {
            var b = a.target;
            return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0
        },
        teardown: function() {
            return n.event.remove(this, "._change"), !Y.test(this.nodeName)
        }
    }), l.focusinBubbles || n.each({
        focus: "focusin",
        blur: "focusout"
    }, function(a, b) {
        var c = function(a) {
            n.event.simulate(b, a.target, n.event.fix(a), !0)
        };
        n.event.special[b] = {
            setup: function() {
                var d = this.ownerDocument || this,
                    e = n._data(d, b);
                e || d.addEventListener(a, c, !0), n._data(d, b, (e || 0) + 1)
            },
            teardown: function() {
                var d = this.ownerDocument || this,
                    e = n._data(d, b) - 1;
                e ? n._data(d, b, e) : (d.removeEventListener(a, c, !0), n._removeData(d, b))
            }
        }
    }), n.fn.extend({
        on: function(a, b, c, d, e) {
            var f, g;
            if ("object" == typeof a) {
                "string" != typeof b && (c = c || b, b = void 0);
                for (f in a) this.on(f, b, c, a[f], e);
                return this
            }
            if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1) d = cb;
            else if (!d) return this;
            return 1 === e && (g = d, d = function(a) {
                return n().off(a), g.apply(this, arguments)
            }, d.guid = g.guid || (g.guid = n.guid++)), this.each(function() {
                n.event.add(this, a, d, c, b)
            })
        },
        one: function(a, b, c, d) {
            return this.on(a, b, c, d, 1)
        },
        off: function(a, b, c) {
            var d, e;
            if (a && a.preventDefault && a.handleObj) return d = a.handleObj, n(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
            if ("object" == typeof a) {
                for (e in a) this.off(e, b, a[e]);
                return this
            }
            return (b === !1 || "function" == typeof b) && (c = b, b = void 0), c === !1 && (c = cb), this.each(function() {
                n.event.remove(this, a, c, b)
            })
        },
        trigger: function(a, b) {
            return this.each(function() {
                n.event.trigger(a, b, this)
            })
        },
        triggerHandler: function(a, b) {
            var c = this[0];
            return c ? n.event.trigger(a, b, c, !0) : void 0
        }
    });

    function eb(a) {
        var b = fb.split("|"),
            c = a.createDocumentFragment();
        if (c.createElement)
            while (b.length) c.createElement(b.pop());
        return c
    }
    var fb = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        gb = / jQuery\d+="(?:null|\d+)"/g,
        hb = new RegExp("<(?:" + fb + ")[\\s/>]", "i"),
        ib = /^\s+/,
        jb = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        kb = /<([\w:]+)/,
        lb = /<tbody/i,
        mb = /<|&#?\w+;/,
        nb = /<(?:script|style|link)/i,
        ob = /checked\s*(?:[^=]|=\s*.checked.)/i,
        pb = /^$|\/(?:java|ecma)script/i,
        qb = /^true\/(.*)/,
        rb = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        sb = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: l.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        },
        tb = eb(z),
        ub = tb.appendChild(z.createElement("div"));
    sb.optgroup = sb.option, sb.tbody = sb.tfoot = sb.colgroup = sb.caption = sb.thead, sb.th = sb.td;

    function vb(a, b) {
        var c, d, e = 0,
            f = typeof a.getElementsByTagName !== L ? a.getElementsByTagName(b || "*") : typeof a.querySelectorAll !== L ? a.querySelectorAll(b || "*") : void 0;
        if (!f)
            for (f = [], c = a.childNodes || a; null != (d = c[e]); e++) !b || n.nodeName(d, b) ? f.push(d) : n.merge(f, vb(d, b));
        return void 0 === b || b && n.nodeName(a, b) ? n.merge([a], f) : f
    }

    function wb(a) {
        X.test(a.type) && (a.defaultChecked = a.checked)
    }

    function xb(a, b) {
        return n.nodeName(a, "table") && n.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
    }

    function yb(a) {
        return a.type = (null !== n.find.attr(a, "type")) + "/" + a.type, a
    }

    function zb(a) {
        var b = qb.exec(a.type);
        return b ? a.type = b[1] : a.removeAttribute("type"), a
    }

    function Ab(a, b) {
        for (var c, d = 0; null != (c = a[d]); d++) n._data(c, "globalEval", !b || n._data(b[d], "globalEval"))
    }

    function Bb(a, b) {
        if (1 === b.nodeType && n.hasData(a)) {
            var c, d, e, f = n._data(a),
                g = n._data(b, f),
                h = f.events;
            if (h) {
                delete g.handle, g.events = {};
                for (c in h)
                    for (d = 0, e = h[c].length; e > d; d++) n.event.add(b, c, h[c][d])
            }
            g.data && (g.data = n.extend({}, g.data))
        }
    }

    function Cb(a, b) {
        var c, d, e;
        if (1 === b.nodeType) {
            if (c = b.nodeName.toLowerCase(), !l.noCloneEvent && b[n.expando]) {
                e = n._data(b);
                for (d in e.events) n.removeEvent(b, d, e.handle);
                b.removeAttribute(n.expando)
            }
            "script" === c && b.text !== a.text ? (yb(b).text = a.text, zb(b)) : "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), l.html5Clone && a.innerHTML && !n.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && X.test(a.type) ? (b.defaultChecked = b.checked = a.checked, b.value !== a.value && (b.value = a.value)) : "option" === c ? b.defaultSelected = b.selected = a.defaultSelected : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue)
        }
    }
    n.extend({
        clone: function(a, b, c) {
            var d, e, f, g, h, i = n.contains(a.ownerDocument, a);
            if (l.html5Clone || n.isXMLDoc(a) || !hb.test("<" + a.nodeName + ">") ? f = a.cloneNode(!0) : (ub.innerHTML = a.outerHTML, ub.removeChild(f = ub.firstChild)), !(l.noCloneEvent && l.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a)))
                for (d = vb(f), h = vb(a), g = 0; null != (e = h[g]); ++g) d[g] && Cb(e, d[g]);
            if (b)
                if (c)
                    for (h = h || vb(a), d = d || vb(f), g = 0; null != (e = h[g]); g++) Bb(e, d[g]);
                else Bb(a, f);
            return d = vb(f, "script"), d.length > 0 && Ab(d, !i && vb(a, "script")), d = h = e = null, f
        },
        buildFragment: function(a, b, c, d) {
            for (var e, f, g, h, i, j, k, m = a.length, o = eb(b), p = [], q = 0; m > q; q++)
                if (f = a[q], f || 0 === f)
                    if ("object" === n.type(f)) n.merge(p, f.nodeType ? [f] : f);
                    else if (mb.test(f)) {
                h = h || o.appendChild(b.createElement("div")), i = (kb.exec(f) || ["", ""])[1].toLowerCase(), k = sb[i] || sb._default, h.innerHTML = k[1] + f.replace(jb, "<$1></$2>") + k[2], e = k[0];
                while (e--) h = h.lastChild;
                if (!l.leadingWhitespace && ib.test(f) && p.push(b.createTextNode(ib.exec(f)[0])), !l.tbody) {
                    f = "table" !== i || lb.test(f) ? "<table>" !== k[1] || lb.test(f) ? 0 : h : h.firstChild, e = f && f.childNodes.length;
                    while (e--) n.nodeName(j = f.childNodes[e], "tbody") && !j.childNodes.length && f.removeChild(j)
                }
                n.merge(p, h.childNodes), h.textContent = "";
                while (h.firstChild) h.removeChild(h.firstChild);
                h = o.lastChild
            } else p.push(b.createTextNode(f));
            h && o.removeChild(h), l.appendChecked || n.grep(vb(p, "input"), wb), q = 0;
            while (f = p[q++])
                if ((!d || -1 === n.inArray(f, d)) && (g = n.contains(f.ownerDocument, f), h = vb(o.appendChild(f), "script"), g && Ab(h), c)) {
                    e = 0;
                    while (f = h[e++]) pb.test(f.type || "") && c.push(f)
                }
            return h = null, o
        },
        cleanData: function(a, b) {
            for (var d, e, f, g, h = 0, i = n.expando, j = n.cache, k = l.deleteExpando, m = n.event.special; null != (d = a[h]); h++)
                if ((b || n.acceptData(d)) && (f = d[i], g = f && j[f])) {
                    if (g.events)
                        for (e in g.events) m[e] ? n.event.remove(d, e) : n.removeEvent(d, e, g.handle);
                    j[f] && (delete j[f], k ? delete d[i] : typeof d.removeAttribute !== L ? d.removeAttribute(i) : d[i] = null, c.push(f))
                }
        }
    }), n.fn.extend({
        text: function(a) {
            return W(this, function(a) {
                return void 0 === a ? n.text(this) : this.empty().append((this[0] && this[0].ownerDocument || z).createTextNode(a))
            }, null, a, arguments.length)
        },
        append: function() {
            return this.domManip(arguments, function(a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = xb(this, a);
                    b.appendChild(a)
                }
            })
        },
        prepend: function() {
            return this.domManip(arguments, function(a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = xb(this, a);
                    b.insertBefore(a, b.firstChild)
                }
            })
        },
        before: function() {
            return this.domManip(arguments, function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this)
            })
        },
        after: function() {
            return this.domManip(arguments, function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
            })
        },
        remove: function(a, b) {
            for (var c, d = a ? n.filter(a, this) : this, e = 0; null != (c = d[e]); e++) b || 1 !== c.nodeType || n.cleanData(vb(c)), c.parentNode && (b && n.contains(c.ownerDocument, c) && Ab(vb(c, "script")), c.parentNode.removeChild(c));
            return this
        },
        empty: function() {
            for (var a, b = 0; null != (a = this[b]); b++) {
                1 === a.nodeType && n.cleanData(vb(a, !1));
                while (a.firstChild) a.removeChild(a.firstChild);
                a.options && n.nodeName(a, "select") && (a.options.length = 0)
            }
            return this
        },
        clone: function(a, b) {
            return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function() {
                return n.clone(this, a, b)
            })
        },
        html: function(a) {
            return W(this, function(a) {
                var b = this[0] || {},
                    c = 0,
                    d = this.length;
                if (void 0 === a) return 1 === b.nodeType ? b.innerHTML.replace(gb, "") : void 0;
                if (!("string" != typeof a || nb.test(a) || !l.htmlSerialize && hb.test(a) || !l.leadingWhitespace && ib.test(a) || sb[(kb.exec(a) || ["", ""])[1].toLowerCase()])) {
                    a = a.replace(jb, "<$1></$2>");
                    try {
                        for (; d > c; c++) b = this[c] || {}, 1 === b.nodeType && (n.cleanData(vb(b, !1)), b.innerHTML = a);
                        b = 0
                    } catch (e) {}
                }
                b && this.empty().append(a)
            }, null, a, arguments.length)
        },
        replaceWith: function() {
            var a = arguments[0];
            return this.domManip(arguments, function(b) {
                a = this.parentNode, n.cleanData(vb(this)), a && a.replaceChild(b, this)
            }), a && (a.length || a.nodeType) ? this : this.remove()
        },
        detach: function(a) {
            return this.remove(a, !0)
        },
        domManip: function(a, b) {
            a = e.apply([], a);
            var c, d, f, g, h, i, j = 0,
                k = this.length,
                m = this,
                o = k - 1,
                p = a[0],
                q = n.isFunction(p);
            if (q || k > 1 && "string" == typeof p && !l.checkClone && ob.test(p)) return this.each(function(c) {
                var d = m.eq(c);
                q && (a[0] = p.call(this, c, d.html())), d.domManip(a, b)
            });
            if (k && (i = n.buildFragment(a, this[0].ownerDocument, !1, this), c = i.firstChild, 1 === i.childNodes.length && (i = c), c)) {
                for (g = n.map(vb(i, "script"), yb), f = g.length; k > j; j++) d = i, j !== o && (d = n.clone(d, !0, !0), f && n.merge(g, vb(d, "script"))), b.call(this[j], d, j);
                if (f)
                    for (h = g[g.length - 1].ownerDocument, n.map(g, zb), j = 0; f > j; j++) d = g[j], pb.test(d.type || "") && !n._data(d, "globalEval") && n.contains(h, d) && (d.src ? n._evalUrl && n._evalUrl(d.src) : n.globalEval((d.text || d.textContent || d.innerHTML || "").replace(rb, "")));
                i = c = null
            }
            return this
        }
    }), n.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(a, b) {
        n.fn[a] = function(a) {
            for (var c, d = 0, e = [], g = n(a), h = g.length - 1; h >= d; d++) c = d === h ? this : this.clone(!0), n(g[d])[b](c), f.apply(e, c.get());
            return this.pushStack(e)
        }
    });
    var Db, Eb = {};

    function Fb(b, c) {
        var d = n(c.createElement(b)).appendTo(c.body),
            e = a.getDefaultComputedStyle ? a.getDefaultComputedStyle(d[0]).display : n.css(d[0], "display");
        return d.detach(), e
    }

    function Gb(a) {
        var b = z,
            c = Eb[a];
        return c || (c = Fb(a, b), "none" !== c && c || (Db = (Db || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = (Db[0].contentWindow || Db[0].contentDocument).document, b.write(), b.close(), c = Fb(a, b), Db.detach()), Eb[a] = c), c
    }! function() {
        var a, b, c = z.createElement("div"),
            d = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
        c.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = c.getElementsByTagName("a")[0], a.style.cssText = "float:left;opacity:.5", l.opacity = /^0.5/.test(a.style.opacity), l.cssFloat = !!a.style.cssFloat, c.style.backgroundClip = "content-box", c.cloneNode(!0).style.backgroundClip = "", l.clearCloneStyle = "content-box" === c.style.backgroundClip, a = c = null, l.shrinkWrapBlocks = function() {
            var a, c, e, f;
            if (null == b) {
                if (a = z.getElementsByTagName("body")[0], !a) return;
                f = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px", c = z.createElement("div"), e = z.createElement("div"), a.appendChild(c).appendChild(e), b = !1, typeof e.style.zoom !== L && (e.style.cssText = d + ";width:1px;padding:1px;zoom:1", e.innerHTML = "<div></div>", e.firstChild.style.width = "5px", b = 3 !== e.offsetWidth), a.removeChild(c), a = c = e = null
            }
            return b
        }
    }();
    var Hb = /^margin/,
        Ib = new RegExp("^(" + T + ")(?!px)[a-z%]+$", "i"),
        Jb, Kb, Lb = /^(top|right|bottom|left)$/;
    a.getComputedStyle ? (Jb = function(a) {
        return a.ownerDocument.defaultView.getComputedStyle(a, null)
    }, Kb = function(a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Jb(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, c && ("" !== g || n.contains(a.ownerDocument, a) || (g = n.style(a, b)), Ib.test(g) && Hb.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 === g ? g : g + ""
    }) : z.documentElement.currentStyle && (Jb = function(a) {
        return a.currentStyle
    }, Kb = function(a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Jb(a), g = c ? c[b] : void 0, null == g && h && h[b] && (g = h[b]), Ib.test(g) && !Lb.test(b) && (d = h.left, e = a.runtimeStyle, f = e && e.left, f && (e.left = a.currentStyle.left), h.left = "fontSize" === b ? "1em" : g, g = h.pixelLeft + "px", h.left = d, f && (e.left = f)), void 0 === g ? g : g + "" || "auto"
    });

    function Mb(a, b) {
        return {
            get: function() {
                var c = a();
                if (null != c) return c ? void delete this.get : (this.get = b).apply(this, arguments)
            }
        }
    }! function() {
        var b, c, d, e, f, g, h = z.createElement("div"),
            i = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px",
            j = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
        h.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", b = h.getElementsByTagName("a")[0], b.style.cssText = "float:left;opacity:.5", l.opacity = /^0.5/.test(b.style.opacity), l.cssFloat = !!b.style.cssFloat, h.style.backgroundClip = "content-box", h.cloneNode(!0).style.backgroundClip = "", l.clearCloneStyle = "content-box" === h.style.backgroundClip, b = h = null, n.extend(l, {
            reliableHiddenOffsets: function() {
                if (null != c) return c;
                var a, b, d, e = z.createElement("div"),
                    f = z.getElementsByTagName("body")[0];
                if (f) return e.setAttribute("className", "t"), e.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = z.createElement("div"), a.style.cssText = i, f.appendChild(a).appendChild(e), e.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", b = e.getElementsByTagName("td"), b[0].style.cssText = "padding:0;margin:0;border:0;display:none", d = 0 === b[0].offsetHeight, b[0].style.display = "", b[1].style.display = "none", c = d && 0 === b[0].offsetHeight, f.removeChild(a), e = f = null, c
            },
            boxSizing: function() {
                return null == d && k(), d
            },
            boxSizingReliable: function() {
                return null == e && k(), e
            },
            pixelPosition: function() {
                return null == f && k(), f
            },
            reliableMarginRight: function() {
                var b, c, d, e;
                if (null == g && a.getComputedStyle) {
                    if (b = z.getElementsByTagName("body")[0], !b) return;
                    c = z.createElement("div"), d = z.createElement("div"), c.style.cssText = i, b.appendChild(c).appendChild(d), e = d.appendChild(z.createElement("div")), e.style.cssText = d.style.cssText = j, e.style.marginRight = e.style.width = "0", d.style.width = "1px", g = !parseFloat((a.getComputedStyle(e, null) || {}).marginRight), b.removeChild(c)
                }
                return g
            }
        });

        function k() {
            var b, c, h = z.getElementsByTagName("body")[0];
            h && (b = z.createElement("div"), c = z.createElement("div"), b.style.cssText = i, h.appendChild(b).appendChild(c), c.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;display:block;padding:1px;border:1px;width:4px;margin-top:1%;top:1%", n.swap(h, null != h.style.zoom ? {
                zoom: 1
            } : {}, function() {
                d = 4 === c.offsetWidth
            }), e = !0, f = !1, g = !0, a.getComputedStyle && (f = "1%" !== (a.getComputedStyle(c, null) || {}).top, e = "4px" === (a.getComputedStyle(c, null) || {
                width: "4px"
            }).width), h.removeChild(b), c = h = null)
        }
    }(), n.swap = function(a, b, c, d) {
        var e, f, g = {};
        for (f in b) g[f] = a.style[f], a.style[f] = b[f];
        e = c.apply(a, d || []);
        for (f in b) a.style[f] = g[f];
        return e
    };
    var Nb = /alpha\([^)]*\)/i,
        Ob = /opacity\s*=\s*([^)]*)/,
        Pb = /^(none|table(?!-c[ea]).+)/,
        Qb = new RegExp("^(" + T + ")(.*)$", "i"),
        Rb = new RegExp("^([+-])=(" + T + ")", "i"),
        Sb = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Tb = {
            letterSpacing: 0,
            fontWeight: 400
        },
        Ub = ["Webkit", "O", "Moz", "ms"];

    function Vb(a, b) {
        if (b in a) return b;
        var c = b.charAt(0).toUpperCase() + b.slice(1),
            d = b,
            e = Ub.length;
        while (e--)
            if (b = Ub[e] + c, b in a) return b;
        return d
    }

    function Wb(a, b) {
        for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g], d.style && (f[g] = n._data(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && V(d) && (f[g] = n._data(d, "olddisplay", Gb(d.nodeName)))) : f[g] || (e = V(d), (c && "none" !== c || !e) && n._data(d, "olddisplay", e ? c : n.css(d, "display"))));
        for (g = 0; h > g; g++) d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
        return a
    }

    function Xb(a, b, c) {
        var d = Qb.exec(b);
        return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
    }

    function Yb(a, b, c, d, e) {
        for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) "margin" === c && (g += n.css(a, c + U[f], !0, e)), d ? ("content" === c && (g -= n.css(a, "padding" + U[f], !0, e)), "margin" !== c && (g -= n.css(a, "border" + U[f] + "Width", !0, e))) : (g += n.css(a, "padding" + U[f], !0, e), "padding" !== c && (g += n.css(a, "border" + U[f] + "Width", !0, e)));
        return g
    }

    function Zb(a, b, c) {
        var d = !0,
            e = "width" === b ? a.offsetWidth : a.offsetHeight,
            f = Jb(a),
            g = l.boxSizing() && "border-box" === n.css(a, "boxSizing", !1, f);
        if (0 >= e || null == e) {
            if (e = Kb(a, b, f), (0 > e || null == e) && (e = a.style[b]), Ib.test(e)) return e;
            d = g && (l.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0
        }
        return e + Yb(a, b, c || (g ? "border" : "content"), d, f) + "px"
    }
    n.extend({
        cssHooks: {
            opacity: {
                get: function(a, b) {
                    if (b) {
                        var c = Kb(a, "opacity");
                        return "" === c ? "1" : c
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            "float": l.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(a, b, c, d) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var e, f, g, h = n.camelCase(b),
                    i = a.style;
                if (b = n.cssProps[h] || (n.cssProps[h] = Vb(i, h)), g = n.cssHooks[b] || n.cssHooks[h], void 0 === c) return g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b];
                if (f = typeof c, "string" === f && (e = Rb.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(n.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || n.cssNumber[h] || (c += "px"), l.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), !(g && "set" in g && void 0 === (c = g.set(a, c, d))))) try {
                    i[b] = "", i[b] = c
                } catch (j) {}
            }
        },
        css: function(a, b, c, d) {
            var e, f, g, h = n.camelCase(b);
            return b = n.cssProps[h] || (n.cssProps[h] = Vb(a.style, h)), g = n.cssHooks[b] || n.cssHooks[h], g && "get" in g && (f = g.get(a, !0, c)), void 0 === f && (f = Kb(a, b, d)), "normal" === f && b in Tb && (f = Tb[b]), "" === c || c ? (e = parseFloat(f), c === !0 || n.isNumeric(e) ? e || 0 : f) : f
        }
    }), n.each(["height", "width"], function(a, b) {
        n.cssHooks[b] = {
            get: function(a, c, d) {
                return c ? 0 === a.offsetWidth && Pb.test(n.css(a, "display")) ? n.swap(a, Sb, function() {
                    return Zb(a, b, d)
                }) : Zb(a, b, d) : void 0
            },
            set: function(a, c, d) {
                var e = d && Jb(a);
                return Xb(a, c, d ? Yb(a, b, d, l.boxSizing() && "border-box" === n.css(a, "boxSizing", !1, e), e) : 0)
            }
        }
    }), l.opacity || (n.cssHooks.opacity = {
        get: function(a, b) {
            return Ob.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : b ? "1" : ""
        },
        set: function(a, b) {
            var c = a.style,
                d = a.currentStyle,
                e = n.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")" : "",
                f = d && d.filter || c.filter || "";
            c.zoom = 1, (b >= 1 || "" === b) && "" === n.trim(f.replace(Nb, "")) && c.removeAttribute && (c.removeAttribute("filter"), "" === b || d && !d.filter) || (c.filter = Nb.test(f) ? f.replace(Nb, e) : f + " " + e)
        }
    }), n.cssHooks.marginRight = Mb(l.reliableMarginRight, function(a, b) {
        return b ? n.swap(a, {
            display: "inline-block"
        }, Kb, [a, "marginRight"]) : void 0
    }), n.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(a, b) {
        n.cssHooks[a + b] = {
            expand: function(c) {
                for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++) e[a + U[d] + b] = f[d] || f[d - 2] || f[0];
                return e
            }
        }, Hb.test(a) || (n.cssHooks[a + b].set = Xb)
    }), n.fn.extend({
        css: function(a, b) {
            return W(this, function(a, b, c) {
                var d, e, f = {},
                    g = 0;
                if (n.isArray(b)) {
                    for (d = Jb(a), e = b.length; e > g; g++) f[b[g]] = n.css(a, b[g], !1, d);
                    return f
                }
                return void 0 !== c ? n.style(a, b, c) : n.css(a, b)
            }, a, b, arguments.length > 1)
        },
        show: function() {
            return Wb(this, !0)
        },
        hide: function() {
            return Wb(this)
        },
        toggle: function(a) {
            return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function() {
                V(this) ? n(this).show() : n(this).hide()
            })
        }
    });

    function $b(a, b, c, d, e) {
        return new $b.prototype.init(a, b, c, d, e)
    }
    n.Tween = $b, $b.prototype = {
        constructor: $b,
        init: function(a, b, c, d, e, f) {
            this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (n.cssNumber[c] ? "" : "px")
        },
        cur: function() {
            var a = $b.propHooks[this.prop];
            return a && a.get ? a.get(this) : $b.propHooks._default.get(this)
        },
        run: function(a) {
            var b, c = $b.propHooks[this.prop];
            return this.pos = b = this.options.duration ? n.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : $b.propHooks._default.set(this), this
        }
    }, $b.prototype.init.prototype = $b.prototype, $b.propHooks = {
        _default: {
            get: function(a) {
                var b;
                return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = n.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop]
            },
            set: function(a) {
                n.fx.step[a.prop] ? n.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[n.cssProps[a.prop]] || n.cssHooks[a.prop]) ? n.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
            }
        }
    }, $b.propHooks.scrollTop = $b.propHooks.scrollLeft = {
        set: function(a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
        }
    }, n.easing = {
        linear: function(a) {
            return a
        },
        swing: function(a) {
            return .5 - Math.cos(a * Math.PI) / 2
        }
    }, n.fx = $b.prototype.init, n.fx.step = {};
    var _b, ac, bc = /^(?:toggle|show|hide)$/,
        cc = new RegExp("^(?:([+-])=|)(" + T + ")([a-z%]*)$", "i"),
        dc = /queueHooks$/,
        ec = [jc],
        fc = {
            "*": [function(a, b) {
                var c = this.createTween(a, b),
                    d = c.cur(),
                    e = cc.exec(b),
                    f = e && e[3] || (n.cssNumber[a] ? "" : "px"),
                    g = (n.cssNumber[a] || "px" !== f && +d) && cc.exec(n.css(c.elem, a)),
                    h = 1,
                    i = 20;
                if (g && g[3] !== f) {
                    f = f || g[3], e = e || [], g = +d || 1;
                    do h = h || ".5", g /= h, n.style(c.elem, a, g + f); while (h !== (h = c.cur() / d) && 1 !== h && --i)
                }
                return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), c
            }]
        };

    function gc() {
        return setTimeout(function() {
            _b = void 0
        }), _b = n.now()
    }

    function hc(a, b) {
        var c, d = {
                height: a
            },
            e = 0;
        for (b = b ? 1 : 0; 4 > e; e += 2 - b) c = U[e], d["margin" + c] = d["padding" + c] = a;
        return b && (d.opacity = d.width = a), d
    }

    function ic(a, b, c) {
        for (var d, e = (fc[b] || []).concat(fc["*"]), f = 0, g = e.length; g > f; f++)
            if (d = e[f].call(c, b, a)) return d
    }

    function jc(a, b, c) {
        var d, e, f, g, h, i, j, k, m = this,
            o = {},
            p = a.style,
            q = a.nodeType && V(a),
            r = n._data(a, "fxshow");
        c.queue || (h = n._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function() {
            h.unqueued || i()
        }), h.unqueued++, m.always(function() {
            m.always(function() {
                h.unqueued--, n.queue(a, "fx").length || h.empty.fire()
            })
        })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [p.overflow, p.overflowX, p.overflowY], j = n.css(a, "display"), k = Gb(a.nodeName), "none" === j && (j = k), "inline" === j && "none" === n.css(a, "float") && (l.inlineBlockNeedsLayout && "inline" !== k ? p.zoom = 1 : p.display = "inline-block")), c.overflow && (p.overflow = "hidden", l.shrinkWrapBlocks() || m.always(function() {
            p.overflow = c.overflow[0], p.overflowX = c.overflow[1], p.overflowY = c.overflow[2]
        }));
        for (d in b)
            if (e = b[d], bc.exec(e)) {
                if (delete b[d], f = f || "toggle" === e, e === (q ? "hide" : "show")) {
                    if ("show" !== e || !r || void 0 === r[d]) continue;
                    q = !0
                }
                o[d] = r && r[d] || n.style(a, d)
            }
        if (!n.isEmptyObject(o)) {
            r ? "hidden" in r && (q = r.hidden) : r = n._data(a, "fxshow", {}), f && (r.hidden = !q), q ? n(a).show() : m.done(function() {
                n(a).hide()
            }), m.done(function() {
                var b;
                n._removeData(a, "fxshow");
                for (b in o) n.style(a, b, o[b])
            });
            for (d in o) g = ic(q ? r[d] : 0, d, m), d in r || (r[d] = g.start, q && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0))
        }
    }

    function kc(a, b) {
        var c, d, e, f, g;
        for (c in a)
            if (d = n.camelCase(c), e = b[d], f = a[c], n.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = n.cssHooks[d], g && "expand" in g) {
                f = g.expand(f), delete a[d];
                for (c in f) c in a || (a[c] = f[c], b[c] = e)
            } else b[d] = e
    }

    function lc(a, b, c) {
        var d, e, f = 0,
            g = ec.length,
            h = n.Deferred().always(function() {
                delete i.elem
            }),
            i = function() {
                if (e) return !1;
                for (var b = _b || gc(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++) j.tweens[g].run(f);
                return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
            },
            j = h.promise({
                elem: a,
                props: n.extend({}, b),
                opts: n.extend(!0, {
                    specialEasing: {}
                }, c),
                originalProperties: b,
                originalOptions: c,
                startTime: _b || gc(),
                duration: c.duration,
                tweens: [],
                createTween: function(b, c) {
                    var d = n.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                    return j.tweens.push(d), d
                },
                stop: function(b) {
                    var c = 0,
                        d = b ? j.tweens.length : 0;
                    if (e) return this;
                    for (e = !0; d > c; c++) j.tweens[c].run(1);
                    return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this
                }
            }),
            k = j.props;
        for (kc(k, j.opts.specialEasing); g > f; f++)
            if (d = ec[f].call(j, a, k, j.opts)) return d;
        return n.map(k, ic, j), n.isFunction(j.opts.start) && j.opts.start.call(a, j), n.fx.timer(n.extend(i, {
            elem: a,
            anim: j,
            queue: j.opts.queue
        })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
    }
    n.Animation = n.extend(lc, {
            tweener: function(a, b) {
                n.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
                for (var c, d = 0, e = a.length; e > d; d++) c = a[d], fc[c] = fc[c] || [], fc[c].unshift(b)
            },
            prefilter: function(a, b) {
                b ? ec.unshift(a) : ec.push(a)
            }
        }), n.speed = function(a, b, c) {
            var d = a && "object" == typeof a ? n.extend({}, a) : {
                complete: c || !c && b || n.isFunction(a) && a,
                duration: a,
                easing: c && b || b && !n.isFunction(b) && b
            };
            return d.duration = n.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in n.fx.speeds ? n.fx.speeds[d.duration] : n.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function() {
                n.isFunction(d.old) && d.old.call(this), d.queue && n.dequeue(this, d.queue)
            }, d
        }, n.fn.extend({
            fadeTo: function(a, b, c, d) {
                return this.filter(V).css("opacity", 0).show().end().animate({
                    opacity: b
                }, a, c, d)
            },
            animate: function(a, b, c, d) {
                var e = n.isEmptyObject(a),
                    f = n.speed(b, c, d),
                    g = function() {
                        var b = lc(this, n.extend({}, a), f);
                        (e || n._data(this, "finish")) && b.stop(!0)
                    };
                return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
            },
            stop: function(a, b, c) {
                var d = function(a) {
                    var b = a.stop;
                    delete a.stop, b(c)
                };
                return "string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function() {
                    var b = !0,
                        e = null != a && a + "queueHooks",
                        f = n.timers,
                        g = n._data(this);
                    if (e) g[e] && g[e].stop && d(g[e]);
                    else
                        for (e in g) g[e] && g[e].stop && dc.test(e) && d(g[e]);
                    for (e = f.length; e--;) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
                    (b || !c) && n.dequeue(this, a)
                })
            },
            finish: function(a) {
                return a !== !1 && (a = a || "fx"), this.each(function() {
                    var b, c = n._data(this),
                        d = c[a + "queue"],
                        e = c[a + "queueHooks"],
                        f = n.timers,
                        g = d ? d.length : 0;
                    for (c.finish = !0, n.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;) f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
                    for (b = 0; g > b; b++) d[b] && d[b].finish && d[b].finish.call(this);
                    delete c.finish
                })
            }
        }), n.each(["toggle", "show", "hide"], function(a, b) {
            var c = n.fn[b];
            n.fn[b] = function(a, d, e) {
                return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(hc(b, !0), a, d, e)
            }
        }), n.each({
            slideDown: hc("show"),
            slideUp: hc("hide"),
            slideToggle: hc("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function(a, b) {
            n.fn[a] = function(a, c, d) {
                return this.animate(b, a, c, d)
            }
        }), n.timers = [], n.fx.tick = function() {
            var a, b = n.timers,
                c = 0;
            for (_b = n.now(); c < b.length; c++) a = b[c], a() || b[c] !== a || b.splice(c--, 1);
            b.length || n.fx.stop(), _b = void 0
        }, n.fx.timer = function(a) {
            n.timers.push(a), a() ? n.fx.start() : n.timers.pop()
        }, n.fx.interval = 13, n.fx.start = function() {
            ac || (ac = setInterval(n.fx.tick, n.fx.interval))
        }, n.fx.stop = function() {
            clearInterval(ac), ac = null
        }, n.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        }, n.fn.delay = function(a, b) {
            return a = n.fx ? n.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function(b, c) {
                var d = setTimeout(b, a);
                c.stop = function() {
                    clearTimeout(d)
                }
            })
        },
        function() {
            var a, b, c, d, e = z.createElement("div");
            e.setAttribute("className", "t"), e.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = e.getElementsByTagName("a")[0], c = z.createElement("select"), d = c.appendChild(z.createElement("option")), b = e.getElementsByTagName("input")[0], a.style.cssText = "top:1px", l.getSetAttribute = "t" !== e.className, l.style = /top/.test(a.getAttribute("style")), l.hrefNormalized = "/a" === a.getAttribute("href"), l.checkOn = !!b.value, l.optSelected = d.selected, l.enctype = !!z.createElement("form").enctype, c.disabled = !0, l.optDisabled = !d.disabled, b = z.createElement("input"), b.setAttribute("value", ""), l.input = "" === b.getAttribute("value"), b.value = "t", b.setAttribute("type", "radio"), l.radioValue = "t" === b.value, a = b = c = d = e = null
        }();
    var mc = /\r/g;
    n.fn.extend({
        val: function(a) {
            var b, c, d, e = this[0]; {
                if (arguments.length) return d = n.isFunction(a), this.each(function(c) {
                    var e;
                    1 === this.nodeType && (e = d ? a.call(this, c, n(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : n.isArray(e) && (e = n.map(e, function(a) {
                        return null == a ? "" : a + ""
                    })), b = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()], b && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e))
                });
                if (e) return b = n.valHooks[e.type] || n.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(mc, "") : null == c ? "" : c)
            }
        }
    }), n.extend({
        valHooks: {
            option: {
                get: function(a) {
                    var b = n.find.attr(a, "value");
                    return null != b ? b : n.text(a)
                }
            },
            select: {
                get: function(a) {
                    for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)
                        if (c = d[i], !(!c.selected && i !== e || (l.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && n.nodeName(c.parentNode, "optgroup"))) {
                            if (b = n(c).val(), f) return b;
                            g.push(b)
                        }
                    return g
                },
                set: function(a, b) {
                    var c, d, e = a.options,
                        f = n.makeArray(b),
                        g = e.length;
                    while (g--)
                        if (d = e[g], n.inArray(n.valHooks.option.get(d), f) >= 0) try {
                            d.selected = c = !0
                        } catch (h) {
                            d.scrollHeight
                        } else d.selected = !1;
                    return c || (a.selectedIndex = -1), e
                }
            }
        }
    }), n.each(["radio", "checkbox"], function() {
        n.valHooks[this] = {
            set: function(a, b) {
                return n.isArray(b) ? a.checked = n.inArray(n(a).val(), b) >= 0 : void 0
            }
        }, l.checkOn || (n.valHooks[this].get = function(a) {
            return null === a.getAttribute("value") ? "on" : a.value
        })
    });
    var nc, oc, pc = n.expr.attrHandle,
        qc = /^(?:checked|selected)$/i,
        rc = l.getSetAttribute,
        sc = l.input;
    n.fn.extend({
        attr: function(a, b) {
            return W(this, n.attr, a, b, arguments.length > 1)
        },
        removeAttr: function(a) {
            return this.each(function() {
                n.removeAttr(this, a)
            })
        }
    }), n.extend({
        attr: function(a, b, c) {
            var d, e, f = a.nodeType;
            if (a && 3 !== f && 8 !== f && 2 !== f) return typeof a.getAttribute === L ? n.prop(a, b, c) : (1 === f && n.isXMLDoc(a) || (b = b.toLowerCase(), d = n.attrHooks[b] || (n.expr.match.bool.test(b) ? oc : nc)), void 0 === c ? d && "get" in d && null !== (e = d.get(a, b)) ? e : (e = n.find.attr(a, b), null == e ? void 0 : e) : null !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), c) : void n.removeAttr(a, b))
        },
        removeAttr: function(a, b) {
            var c, d, e = 0,
                f = b && b.match(F);
            if (f && 1 === a.nodeType)
                while (c = f[e++]) d = n.propFix[c] || c, n.expr.match.bool.test(c) ? sc && rc || !qc.test(c) ? a[d] = !1 : a[n.camelCase("default-" + c)] = a[d] = !1 : n.attr(a, c, ""), a.removeAttribute(rc ? c : d)
        },
        attrHooks: {
            type: {
                set: function(a, b) {
                    if (!l.radioValue && "radio" === b && n.nodeName(a, "input")) {
                        var c = a.value;
                        return a.setAttribute("type", b), c && (a.value = c), b
                    }
                }
            }
        }
    }), oc = {
        set: function(a, b, c) {
            return b === !1 ? n.removeAttr(a, c) : sc && rc || !qc.test(c) ? a.setAttribute(!rc && n.propFix[c] || c, c) : a[n.camelCase("default-" + c)] = a[c] = !0, c
        }
    }, n.each(n.expr.match.bool.source.match(/\w+/g), function(a, b) {
        var c = pc[b] || n.find.attr;
        pc[b] = sc && rc || !qc.test(b) ? function(a, b, d) {
            var e, f;
            return d || (f = pc[b], pc[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, pc[b] = f), e
        } : function(a, b, c) {
            return c ? void 0 : a[n.camelCase("default-" + b)] ? b.toLowerCase() : null
        }
    }), sc && rc || (n.attrHooks.value = {
        set: function(a, b, c) {
            return n.nodeName(a, "input") ? void(a.defaultValue = b) : nc && nc.set(a, b, c)
        }
    }), rc || (nc = {
        set: function(a, b, c) {
            var d = a.getAttributeNode(c);
            return d || a.setAttributeNode(d = a.ownerDocument.createAttribute(c)), d.value = b += "", "value" === c || b === a.getAttribute(c) ? b : void 0
        }
    }, pc.id = pc.name = pc.coords = function(a, b, c) {
        var d;
        return c ? void 0 : (d = a.getAttributeNode(b)) && "" !== d.value ? d.value : null
    }, n.valHooks.button = {
        get: function(a, b) {
            var c = a.getAttributeNode(b);
            return c && c.specified ? c.value : void 0
        },
        set: nc.set
    }, n.attrHooks.contenteditable = {
        set: function(a, b, c) {
            nc.set(a, "" === b ? !1 : b, c)
        }
    }, n.each(["width", "height"], function(a, b) {
        n.attrHooks[b] = {
            set: function(a, c) {
                return "" === c ? (a.setAttribute(b, "auto"), c) : void 0
            }
        }
    })), l.style || (n.attrHooks.style = {
        get: function(a) {
            return a.style.cssText || void 0
        },
        set: function(a, b) {
            return a.style.cssText = b + ""
        }
    });
    var tc = /^(?:input|select|textarea|button|object)$/i,
        uc = /^(?:a|area)$/i;
    n.fn.extend({
        prop: function(a, b) {
            return W(this, n.prop, a, b, arguments.length > 1)
        },
        removeProp: function(a) {
            return a = n.propFix[a] || a, this.each(function() {
                try {
                    this[a] = void 0, delete this[a]
                } catch (b) {}
            })
        }
    }), n.extend({
        propFix: {
            "for": "htmlFor",
            "class": "className"
        },
        prop: function(a, b, c) {
            var d, e, f, g = a.nodeType;
            if (a && 3 !== g && 8 !== g && 2 !== g) return f = 1 !== g || !n.isXMLDoc(a), f && (b = n.propFix[b] || b, e = n.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b]
        },
        propHooks: {
            tabIndex: {
                get: function(a) {
                    var b = n.find.attr(a, "tabindex");
                    return b ? parseInt(b, 10) : tc.test(a.nodeName) || uc.test(a.nodeName) && a.href ? 0 : -1
                }
            }
        }
    }), l.hrefNormalized || n.each(["href", "src"], function(a, b) {
        n.propHooks[b] = {
            get: function(a) {
                return a.getAttribute(b, 4)
            }
        }
    }), l.optSelected || (n.propHooks.selected = {
        get: function(a) {
            var b = a.parentNode;
            return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex), null
        }
    }), n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        n.propFix[this.toLowerCase()] = this
    }), l.enctype || (n.propFix.enctype = "encoding");
    var vc = /[\t\r\n\f]/g;
    n.fn.extend({
        addClass: function(a) {
            var b, c, d, e, f, g, h = 0,
                i = this.length,
                j = "string" == typeof a && a;
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).addClass(a.call(this, b, this.className))
            });
            if (j)
                for (b = (a || "").match(F) || []; i > h; h++)
                    if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(vc, " ") : " ")) {
                        f = 0;
                        while (e = b[f++]) d.indexOf(" " + e + " ") < 0 && (d += e + " ");
                        g = n.trim(d), c.className !== g && (c.className = g)
                    }
            return this
        },
        removeClass: function(a) {
            var b, c, d, e, f, g, h = 0,
                i = this.length,
                j = 0 === arguments.length || "string" == typeof a && a;
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).removeClass(a.call(this, b, this.className))
            });
            if (j)
                for (b = (a || "").match(F) || []; i > h; h++)
                    if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(vc, " ") : "")) {
                        f = 0;
                        while (e = b[f++])
                            while (d.indexOf(" " + e + " ") >= 0) d = d.replace(" " + e + " ", " ");
                        g = a ? n.trim(d) : "", c.className !== g && (c.className = g)
                    }
            return this
        },
        toggleClass: function(a, b) {
            var c = typeof a;
            return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : this.each(n.isFunction(a) ? function(c) {
                n(this).toggleClass(a.call(this, c, this.className, b), b)
            } : function() {
                if ("string" === c) {
                    var b, d = 0,
                        e = n(this),
                        f = a.match(F) || [];
                    while (b = f[d++]) e.hasClass(b) ? e.removeClass(b) : e.addClass(b)
                } else(c === L || "boolean" === c) && (this.className && n._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : n._data(this, "__className__") || "")
            })
        },
        hasClass: function(a) {
            for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++)
                if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(vc, " ").indexOf(b) >= 0) return !0;
            return !1
        }
    }), n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(a, b) {
        n.fn[b] = function(a, c) {
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
        }
    }), n.fn.extend({
        hover: function(a, b) {
            return this.mouseenter(a).mouseleave(b || a)
        },
        bind: function(a, b, c) {
            return this.on(a, null, b, c)
        },
        unbind: function(a, b) {
            return this.off(a, null, b)
        },
        delegate: function(a, b, c, d) {
            return this.on(b, a, c, d)
        },
        undelegate: function(a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
        }
    });
    var wc = n.now(),
        xc = /\?/,
        yc = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
    n.parseJSON = function(b) {
        if (a.JSON && a.JSON.parse) return a.JSON.parse(b + "");
        var c, d = null,
            e = n.trim(b + "");
        return e && !n.trim(e.replace(yc, function(a, b, e, f) {
            return c && b && (d = 0), 0 === d ? a : (c = e || b, d += !f - !e, "")
        })) ? Function("return " + e)() : n.error("Invalid JSON: " + b)
    }, n.parseXML = function(b) {
        var c, d;
        if (!b || "string" != typeof b) return null;
        try {
            a.DOMParser ? (d = new DOMParser, c = d.parseFromString(b, "text/xml")) : (c = new ActiveXObject("Microsoft.XMLDOM"), c.async = "false", c.loadXML(b))
        } catch (e) {
            c = void 0
        }
        return c && c.documentElement && !c.getElementsByTagName("parsererror").length || n.error("Invalid XML: " + b), c
    };
    var zc, Ac, Bc = /#.*$/,
        Cc = /([?&])_=[^&]*/,
        Dc = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Ec = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        Fc = /^(?:GET|HEAD)$/,
        Gc = /^\/\//,
        Hc = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
        Ic = {},
        Jc = {},
        Kc = "*/".concat("*");
    try {
        Ac = location.href
    } catch (Lc) {
        Ac = z.createElement("a"), Ac.href = "", Ac = Ac.href
    }
    zc = Hc.exec(Ac.toLowerCase()) || [];

    function Mc(a) {
        return function(b, c) {
            "string" != typeof b && (c = b, b = "*");
            var d, e = 0,
                f = b.toLowerCase().match(F) || [];
            if (n.isFunction(c))
                while (d = f[e++]) "+" === d.charAt(0) ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
        }
    }

    function Nc(a, b, c, d) {
        var e = {},
            f = a === Jc;

        function g(h) {
            var i;
            return e[h] = !0, n.each(a[h] || [], function(a, h) {
                var j = h(b, c, d);
                return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1)
            }), i
        }
        return g(b.dataTypes[0]) || !e["*"] && g("*")
    }

    function Oc(a, b) {
        var c, d, e = n.ajaxSettings.flatOptions || {};
        for (d in b) void 0 !== b[d] && ((e[d] ? a : c || (c = {}))[d] = b[d]);
        return c && n.extend(!0, a, c), a
    }

    function Pc(a, b, c) {
        var d, e, f, g, h = a.contents,
            i = a.dataTypes;
        while ("*" === i[0]) i.shift(), void 0 === e && (e = a.mimeType || b.getResponseHeader("Content-Type"));
        if (e)
            for (g in h)
                if (h[g] && h[g].test(e)) {
                    i.unshift(g);
                    break
                }
        if (i[0] in c) f = i[0];
        else {
            for (g in c) {
                if (!i[0] || a.converters[g + " " + i[0]]) {
                    f = g;
                    break
                }
                d || (d = g)
            }
            f = f || d
        }
        return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
    }

    function Qc(a, b, c, d) {
        var e, f, g, h, i, j = {},
            k = a.dataTypes.slice();
        if (k[1])
            for (g in a.converters) j[g.toLowerCase()] = a.converters[g];
        f = k.shift();
        while (f)
            if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())
                if ("*" === f) f = i;
                else if ("*" !== i && i !== f) {
            if (g = j[i + " " + f] || j["* " + f], !g)
                for (e in j)
                    if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                        g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
                        break
                    }
            if (g !== !0)
                if (g && a["throws"]) b = g(b);
                else try {
                    b = g(b)
                } catch (l) {
                    return {
                        state: "parsererror",
                        error: g ? l : "No conversion from " + i + " to " + f
                    }
                }
        }
        return {
            state: "success",
            data: b
        }
    }
    n.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Ac,
            type: "GET",
            isLocal: Ec.test(zc[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Kc,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": n.parseJSON,
                "text xml": n.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(a, b) {
            return b ? Oc(Oc(a, n.ajaxSettings), b) : Oc(n.ajaxSettings, a)
        },
        ajaxPrefilter: Mc(Ic),
        ajaxTransport: Mc(Jc),
        ajax: function(a, b) {
            "object" == typeof a && (b = a, a = void 0), b = b || {};
            var c, d, e, f, g, h, i, j, k = n.ajaxSetup({}, b),
                l = k.context || k,
                m = k.context && (l.nodeType || l.jquery) ? n(l) : n.event,
                o = n.Deferred(),
                p = n.Callbacks("once memory"),
                q = k.statusCode || {},
                r = {},
                s = {},
                t = 0,
                u = "canceled",
                v = {
                    readyState: 0,
                    getResponseHeader: function(a) {
                        var b;
                        if (2 === t) {
                            if (!j) {
                                j = {};
                                while (b = Dc.exec(f)) j[b[1].toLowerCase()] = b[2]
                            }
                            b = j[a.toLowerCase()]
                        }
                        return null == b ? null : b
                    },
                    getAllResponseHeaders: function() {
                        return 2 === t ? f : null
                    },
                    setRequestHeader: function(a, b) {
                        var c = a.toLowerCase();
                        return t || (a = s[c] = s[c] || a, r[a] = b), this
                    },
                    overrideMimeType: function(a) {
                        return t || (k.mimeType = a), this
                    },
                    statusCode: function(a) {
                        var b;
                        if (a)
                            if (2 > t)
                                for (b in a) q[b] = [q[b], a[b]];
                            else v.always(a[v.status]);
                        return this
                    },
                    abort: function(a) {
                        var b = a || u;
                        return i && i.abort(b), x(0, b), this
                    }
                };
            if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, k.url = ((a || k.url || Ac) + "").replace(Bc, "").replace(Gc, zc[1] + "//"), k.type = b.method || b.type || k.method || k.type, k.dataTypes = n.trim(k.dataType || "*").toLowerCase().match(F) || [""], null == k.crossDomain && (c = Hc.exec(k.url.toLowerCase()), k.crossDomain = !(!c || c[1] === zc[1] && c[2] === zc[2] && (c[3] || ("http:" === c[1] ? "80" : "443")) === (zc[3] || ("http:" === zc[1] ? "80" : "443")))), k.data && k.processData && "string" != typeof k.data && (k.data = n.param(k.data, k.traditional)), Nc(Ic, k, b, v), 2 === t) return v;
            h = k.global, h && 0 === n.active++ && n.event.trigger("ajaxStart"), k.type = k.type.toUpperCase(), k.hasContent = !Fc.test(k.type), e = k.url, k.hasContent || (k.data && (e = k.url += (xc.test(e) ? "&" : "?") + k.data, delete k.data), k.cache === !1 && (k.url = Cc.test(e) ? e.replace(Cc, "$1_=" + wc++) : e + (xc.test(e) ? "&" : "?") + "_=" + wc++)), k.ifModified && (n.lastModified[e] && v.setRequestHeader("If-Modified-Since", n.lastModified[e]), n.etag[e] && v.setRequestHeader("If-None-Match", n.etag[e])), (k.data && k.hasContent && k.contentType !== !1 || b.contentType) && v.setRequestHeader("Content-Type", k.contentType), v.setRequestHeader("Accept", k.dataTypes[0] && k.accepts[k.dataTypes[0]] ? k.accepts[k.dataTypes[0]] + ("*" !== k.dataTypes[0] ? ", " + Kc + "; q=0.01" : "") : k.accepts["*"]);
            for (d in k.headers) v.setRequestHeader(d, k.headers[d]);
            if (k.beforeSend && (k.beforeSend.call(l, v, k) === !1 || 2 === t)) return v.abort();
            u = "abort";
            for (d in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) v[d](k[d]);
            if (i = Nc(Jc, k, b, v)) {
                v.readyState = 1, h && m.trigger("ajaxSend", [v, k]), k.async && k.timeout > 0 && (g = setTimeout(function() {
                    v.abort("timeout")
                }, k.timeout));
                try {
                    t = 1, i.send(r, x)
                } catch (w) {
                    if (!(2 > t)) throw w;
                    x(-1, w)
                }
            } else x(-1, "No Transport");

            function x(a, b, c, d) {
                var j, r, s, u, w, x = b;
                2 !== t && (t = 2, g && clearTimeout(g), i = void 0, f = d || "", v.readyState = a > 0 ? 4 : 0, j = a >= 200 && 300 > a || 304 === a, c && (u = Pc(k, v, c)), u = Qc(k, u, v, j), j ? (k.ifModified && (w = v.getResponseHeader("Last-Modified"), w && (n.lastModified[e] = w), w = v.getResponseHeader("etag"), w && (n.etag[e] = w)), 204 === a || "HEAD" === k.type ? x = "nocontent" : 304 === a ? x = "notmodified" : (x = u.state, r = u.data, s = u.error, j = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [r, x, v]) : o.rejectWith(l, [v, x, s]), v.statusCode(q), q = void 0, h && m.trigger(j ? "ajaxSuccess" : "ajaxError", [v, k, j ? r : s]), p.fireWith(l, [v, x]), h && (m.trigger("ajaxComplete", [v, k]), --n.active || n.event.trigger("ajaxStop")))
            }
            return v
        },
        getJSON: function(a, b, c) {
            return n.get(a, b, c, "json")
        },
        getScript: function(a, b) {
            return n.get(a, void 0, b, "script")
        }
    }), n.each(["get", "post"], function(a, b) {
        n[b] = function(a, c, d, e) {
            return n.isFunction(c) && (e = e || d, d = c, c = void 0), n.ajax({
                url: a,
                type: b,
                dataType: e,
                data: c,
                success: d
            })
        }
    }), n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(a, b) {
        n.fn[b] = function(a) {
            return this.on(b, a)
        }
    }), n._evalUrl = function(a) {
        return n.ajax({
            url: a,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            "throws": !0
        })
    }, n.fn.extend({
        wrapAll: function(a) {
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).wrapAll(a.call(this, b))
            });
            if (this[0]) {
                var b = n(a, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && b.insertBefore(this[0]), b.map(function() {
                    var a = this;
                    while (a.firstChild && 1 === a.firstChild.nodeType) a = a.firstChild;
                    return a
                }).append(this)
            }
            return this
        },
        wrapInner: function(a) {
            return this.each(n.isFunction(a) ? function(b) {
                n(this).wrapInner(a.call(this, b))
            } : function() {
                var b = n(this),
                    c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a)
            })
        },
        wrap: function(a) {
            var b = n.isFunction(a);
            return this.each(function(c) {
                n(this).wrapAll(b ? a.call(this, c) : a)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                n.nodeName(this, "body") || n(this).replaceWith(this.childNodes)
            }).end()
        }
    }), n.expr.filters.hidden = function(a) {
        return a.offsetWidth <= 0 && a.offsetHeight <= 0 || !l.reliableHiddenOffsets() && "none" === (a.style && a.style.display || n.css(a, "display"))
    }, n.expr.filters.visible = function(a) {
        return !n.expr.filters.hidden(a)
    };
    var Rc = /%20/g,
        Sc = /\[\]$/,
        Tc = /\r?\n/g,
        Uc = /^(?:submit|button|image|reset|file)$/i,
        Vc = /^(?:input|select|textarea|keygen)/i;

    function Wc(a, b, c, d) {
        var e;
        if (n.isArray(b)) n.each(b, function(b, e) {
            c || Sc.test(a) ? d(a, e) : Wc(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d)
        });
        else if (c || "object" !== n.type(b)) d(a, b);
        else
            for (e in b) Wc(a + "[" + e + "]", b[e], c, d)
    }
    n.param = function(a, b) {
        var c, d = [],
            e = function(a, b) {
                b = n.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
            };
        if (void 0 === b && (b = n.ajaxSettings && n.ajaxSettings.traditional), n.isArray(a) || a.jquery && !n.isPlainObject(a)) n.each(a, function() {
            e(this.name, this.value)
        });
        else
            for (c in a) Wc(c, a[c], b, e);
        return d.join("&").replace(Rc, "+")
    }, n.fn.extend({
        serialize: function() {
            return n.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var a = n.prop(this, "elements");
                return a ? n.makeArray(a) : this
            }).filter(function() {
                var a = this.type;
                return this.name && !n(this).is(":disabled") && Vc.test(this.nodeName) && !Uc.test(a) && (this.checked || !X.test(a))
            }).map(function(a, b) {
                var c = n(this).val();
                return null == c ? null : n.isArray(c) ? n.map(c, function(a) {
                    return {
                        name: b.name,
                        value: a.replace(Tc, "\r\n")
                    }
                }) : {
                    name: b.name,
                    value: c.replace(Tc, "\r\n")
                }
            }).get()
        }
    }), n.ajaxSettings.xhr = void 0 !== a.ActiveXObject ? function() {
        return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && $c() || _c()
    } : $c;
    var Xc = 0,
        Yc = {},
        Zc = n.ajaxSettings.xhr();
    a.ActiveXObject && n(a).on("unload", function() {
        for (var a in Yc) Yc[a](void 0, !0)
    }), l.cors = !!Zc && "withCredentials" in Zc, Zc = l.ajax = !!Zc, Zc && n.ajaxTransport(function(a) {
        if (!a.crossDomain || l.cors) {
            var b;
            return {
                send: function(c, d) {
                    var e, f = a.xhr(),
                        g = ++Xc;
                    if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields)
                        for (e in a.xhrFields) f[e] = a.xhrFields[e];
                    a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
                    for (e in c) void 0 !== c[e] && f.setRequestHeader(e, c[e] + "");
                    f.send(a.hasContent && a.data || null), b = function(c, e) {
                        var h, i, j;
                        if (b && (e || 4 === f.readyState))
                            if (delete Yc[g], b = void 0, f.onreadystatechange = n.noop, e) 4 !== f.readyState && f.abort();
                            else {
                                j = {}, h = f.status, "string" == typeof f.responseText && (j.text = f.responseText);
                                try {
                                    i = f.statusText
                                } catch (k) {
                                    i = ""
                                }
                                h || !a.isLocal || a.crossDomain ? 1223 === h && (h = 204) : h = j.text ? 200 : 404
                            }
                        j && d(h, i, j, f.getAllResponseHeaders())
                    }, a.async ? 4 === f.readyState ? setTimeout(b) : f.onreadystatechange = Yc[g] = b : b()
                },
                abort: function() {
                    b && b(void 0, !0)
                }
            }
        }
    });

    function $c() {
        try {
            return new a.XMLHttpRequest
        } catch (b) {}
    }

    function _c() {
        try {
            return new a.ActiveXObject("Microsoft.XMLHTTP")
        } catch (b) {}
    }
    n.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function(a) {
                return n.globalEval(a), a
            }
        }
    }), n.ajaxPrefilter("script", function(a) {
        void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1)
    }), n.ajaxTransport("script", function(a) {
        if (a.crossDomain) {
            var b, c = z.head || n("head")[0] || z.documentElement;
            return {
                send: function(d, e) {
                    b = z.createElement("script"), b.async = !0, a.scriptCharset && (b.charset = a.scriptCharset), b.src = a.url, b.onload = b.onreadystatechange = function(a, c) {
                        (c || !b.readyState || /loaded|complete/.test(b.readyState)) && (b.onload = b.onreadystatechange = null, b.parentNode && b.parentNode.removeChild(b), b = null, c || e(200, "success"))
                    }, c.insertBefore(b, c.firstChild)
                },
                abort: function() {
                    b && b.onload(void 0, !0)
                }
            }
        }
    });
    var ad = [],
        bd = /(=)\?(?=&|$)|\?\?/;
    n.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var a = ad.pop() || n.expando + "_" + wc++;
            return this[a] = !0, a
        }
    }), n.ajaxPrefilter("json jsonp", function(b, c, d) {
        var e, f, g, h = b.jsonp !== !1 && (bd.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && bd.test(b.data) && "data");
        return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = n.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(bd, "$1" + e) : b.jsonp !== !1 && (b.url += (xc.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function() {
            return g || n.error(e + " was not called"), g[0]
        }, b.dataTypes[0] = "json", f = a[e], a[e] = function() {
            g = arguments
        }, d.always(function() {
            a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, ad.push(e)), g && n.isFunction(f) && f(g[0]), g = f = void 0
        }), "script") : void 0
    }), n.parseHTML = function(a, b, c) {
        if (!a || "string" != typeof a) return null;
        "boolean" == typeof b && (c = b, b = !1), b = b || z;
        var d = v.exec(a),
            e = !c && [];
        return d ? [b.createElement(d[1])] : (d = n.buildFragment([a], b, e), e && e.length && n(e).remove(), n.merge([], d.childNodes))
    };
    var cd = n.fn.load;
    n.fn.load = function(a, b, c) {
        if ("string" != typeof a && cd) return cd.apply(this, arguments);
        var d, e, f, g = this,
            h = a.indexOf(" ");
        return h >= 0 && (d = a.slice(h, a.length), a = a.slice(0, h)), n.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (f = "POST"), g.length > 0 && n.ajax({
            url: a,
            type: f,
            dataType: "html",
            data: b
        }).done(function(a) {
            e = arguments, g.html(d ? n("<div>").append(n.parseHTML(a)).find(d) : a)
        }).complete(c && function(a, b) {
            g.each(c, e || [a.responseText, b, a])
        }), this
    }, n.expr.filters.animated = function(a) {
        return n.grep(n.timers, function(b) {
            return a === b.elem
        }).length
    };
    var dd = a.document.documentElement;

    function ed(a) {
        return n.isWindow(a) ? a : 9 === a.nodeType ? a.defaultView || a.parentWindow : !1
    }
    n.offset = {
        setOffset: function(a, b, c) {
            var d, e, f, g, h, i, j, k = n.css(a, "position"),
                l = n(a),
                m = {};
            "static" === k && (a.style.position = "relative"), h = l.offset(), f = n.css(a, "top"), i = n.css(a, "left"), j = ("absolute" === k || "fixed" === k) && n.inArray("auto", [f, i]) > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), n.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (m.top = b.top - h.top + g), null != b.left && (m.left = b.left - h.left + e), "using" in b ? b.using.call(a, m) : l.css(m)
        }
    }, n.fn.extend({
        offset: function(a) {
            if (arguments.length) return void 0 === a ? this : this.each(function(b) {
                n.offset.setOffset(this, a, b)
            });
            var b, c, d = {
                    top: 0,
                    left: 0
                },
                e = this[0],
                f = e && e.ownerDocument;
            if (f) return b = f.documentElement, n.contains(b, e) ? (typeof e.getBoundingClientRect !== L && (d = e.getBoundingClientRect()), c = ed(f), {
                top: d.top + (c.pageYOffset || b.scrollTop) - (b.clientTop || 0),
                left: d.left + (c.pageXOffset || b.scrollLeft) - (b.clientLeft || 0)
            }) : d
        },
        position: function() {
            if (this[0]) {
                var a, b, c = {
                        top: 0,
                        left: 0
                    },
                    d = this[0];
                return "fixed" === n.css(d, "position") ? b = d.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0], "html") || (c = a.offset()), c.top += n.css(a[0], "borderTopWidth", !0), c.left += n.css(a[0], "borderLeftWidth", !0)), {
                    top: b.top - c.top - n.css(d, "marginTop", !0),
                    left: b.left - c.left - n.css(d, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                var a = this.offsetParent || dd;
                while (a && !n.nodeName(a, "html") && "static" === n.css(a, "position")) a = a.offsetParent;
                return a || dd
            })
        }
    }), n.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(a, b) {
        var c = /Y/.test(b);
        n.fn[a] = function(d) {
            return W(this, function(a, d, e) {
                var f = ed(a);
                return void 0 === e ? f ? b in f ? f[b] : f.document.documentElement[d] : a[d] : void(f ? f.scrollTo(c ? n(f).scrollLeft() : e, c ? e : n(f).scrollTop()) : a[d] = e)
            }, a, d, arguments.length, null)
        }
    }), n.each(["top", "left"], function(a, b) {
        n.cssHooks[b] = Mb(l.pixelPosition, function(a, c) {
            return c ? (c = Kb(a, b), Ib.test(c) ? n(a).position()[b] + "px" : c) : void 0
        })
    }), n.each({
        Height: "height",
        Width: "width"
    }, function(a, b) {
        n.each({
            padding: "inner" + a,
            content: b,
            "": "outer" + a
        }, function(c, d) {
            n.fn[d] = function(d, e) {
                var f = arguments.length && (c || "boolean" != typeof d),
                    g = c || (d === !0 || e === !0 ? "margin" : "border");
                return W(this, function(b, c, d) {
                    var e;
                    return n.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? n.css(b, c, g) : n.style(b, c, d, g)
                }, b, f ? d : void 0, f, null)
            }
        })
    }), n.fn.size = function() {
        return this.length
    }, n.fn.andSelf = n.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
        return n
    });
    var fd = a.jQuery,
        gd = a.$;
    return n.noConflict = function(b) {
        return a.$ === n && (a.$ = gd), b && a.jQuery === n && (a.jQuery = fd), n
    }, typeof b === L && (a.jQuery = a.$ = n), n
});;
(function(e, t) {
    function i(t, i) {
        var a, n, r, o = t.nodeName.toLowerCase();
        return "area" === o ? (a = t.parentNode, n = a.name, t.href && n && "map" === a.nodeName.toLowerCase() ? (r = e("img[usemap=#" + n + "]")[0], !!r && s(r)) : !1) : (/input|select|textarea|button|object/.test(o) ? !t.disabled : "a" === o ? t.href || i : i) && s(t)
    }

    function s(t) {
        return e.expr.filters.visible(t) && !e(t).parents().addBack().filter(function() {
            return "hidden" === e.css(this, "visibility")
        }).length
    }
    var a = 0,
        n = /^ui-id-\d+$/;
    e.ui = e.ui || {}, e.extend(e.ui, {
        version: "1.10.4",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            NUMPAD_ADD: 107,
            NUMPAD_DECIMAL: 110,
            NUMPAD_DIVIDE: 111,
            NUMPAD_ENTER: 108,
            NUMPAD_MULTIPLY: 106,
            NUMPAD_SUBTRACT: 109,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), e.fn.extend({
        focus: function(t) {
            return function(i, s) {
                return "number" == typeof i ? this.each(function() {
                    var t = this;
                    setTimeout(function() {
                        e(t).focus(), s && s.call(t)
                    }, i)
                }) : t.apply(this, arguments)
            }
        }(e.fn.focus),
        scrollParent: function() {
            var t;
            return t = e.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function() {
                return /(relative|absolute|fixed)/.test(e.css(this, "position")) && /(auto|scroll)/.test(e.css(this, "overflow") + e.css(this, "overflow-y") + e.css(this, "overflow-x"))
            }).eq(0) : this.parents().filter(function() {
                return /(auto|scroll)/.test(e.css(this, "overflow") + e.css(this, "overflow-y") + e.css(this, "overflow-x"))
            }).eq(0), /fixed/.test(this.css("position")) || !t.length ? e(document) : t
        },
        zIndex: function(i) {
            if (i !== t) return this.css("zIndex", i);
            if (this.length)
                for (var s, a, n = e(this[0]); n.length && n[0] !== document;) {
                    if (s = n.css("position"), ("absolute" === s || "relative" === s || "fixed" === s) && (a = parseInt(n.css("zIndex"), 10), !isNaN(a) && 0 !== a)) return a;
                    n = n.parent()
                }
            return 0
        },
        uniqueId: function() {
            return this.each(function() {
                this.id || (this.id = "ui-id-" + ++a)
            })
        },
        removeUniqueId: function() {
            return this.each(function() {
                n.test(this.id) && e(this).removeAttr("id")
            })
        }
    }), e.extend(e.expr[":"], {
        data: e.expr.createPseudo ? e.expr.createPseudo(function(t) {
            return function(i) {
                return !!e.data(i, t)
            }
        }) : function(t, i, s) {
            return !!e.data(t, s[3])
        },
        focusable: function(t) {
            return i(t, !isNaN(e.attr(t, "tabindex")))
        },
        tabbable: function(t) {
            var s = e.attr(t, "tabindex"),
                a = isNaN(s);
            return (a || s >= 0) && i(t, !a)
        }
    }), e("<a>").outerWidth(1).jquery || e.each(["Width", "Height"], function(i, s) {
        function a(t, i, s, a) {
            return e.each(n, function() {
                i -= parseFloat(e.css(t, "padding" + this)) || 0, s && (i -= parseFloat(e.css(t, "border" + this + "Width")) || 0), a && (i -= parseFloat(e.css(t, "margin" + this)) || 0)
            }), i
        }
        var n = "Width" === s ? ["Left", "Right"] : ["Top", "Bottom"],
            r = s.toLowerCase(),
            o = {
                innerWidth: e.fn.innerWidth,
                innerHeight: e.fn.innerHeight,
                outerWidth: e.fn.outerWidth,
                outerHeight: e.fn.outerHeight
            };
        e.fn["inner" + s] = function(i) {
            return i === t ? o["inner" + s].call(this) : this.each(function() {
                e(this).css(r, a(this, i) + "px")
            })
        }, e.fn["outer" + s] = function(t, i) {
            return "number" != typeof t ? o["outer" + s].call(this, t) : this.each(function() {
                e(this).css(r, a(this, t, !0, i) + "px")
            })
        }
    }), e.fn.addBack || (e.fn.addBack = function(e) {
        return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
    }), e("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (e.fn.removeData = function(t) {
        return function(i) {
            return arguments.length ? t.call(this, e.camelCase(i)) : t.call(this)
        }
    }(e.fn.removeData)), e.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), e.support.selectstart = "onselectstart" in document.createElement("div"), e.fn.extend({
        disableSelection: function() {
            return this.bind((e.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function(e) {
                e.preventDefault()
            })
        },
        enableSelection: function() {
            return this.unbind(".ui-disableSelection")
        }
    }), e.extend(e.ui, {
        plugin: {
            add: function(t, i, s) {
                var a, n = e.ui[t].prototype;
                for (a in s) n.plugins[a] = n.plugins[a] || [], n.plugins[a].push([i, s[a]])
            },
            call: function(e, t, i) {
                var s, a = e.plugins[t];
                if (a && e.element[0].parentNode && 11 !== e.element[0].parentNode.nodeType)
                    for (s = 0; a.length > s; s++) e.options[a[s][0]] && a[s][1].apply(e.element, i)
            }
        },
        hasScroll: function(t, i) {
            if ("hidden" === e(t).css("overflow")) return !1;
            var s = i && "left" === i ? "scrollLeft" : "scrollTop",
                a = !1;
            return t[s] > 0 ? !0 : (t[s] = 1, a = t[s] > 0, t[s] = 0, a)
        }
    })
})(jQuery);
(function(e, t) {
    var i = 0,
        s = Array.prototype.slice,
        a = e.cleanData;
    e.cleanData = function(t) {
        for (var i, s = 0; null != (i = t[s]); s++) try {
            e(i).triggerHandler("remove")
        } catch (n) {}
        a(t)
    }, e.widget = function(i, s, a) {
        var n, r, o, h, l = {},
            u = i.split(".")[0];
        i = i.split(".")[1], n = u + "-" + i, a || (a = s, s = e.Widget), e.expr[":"][n.toLowerCase()] = function(t) {
            return !!e.data(t, n)
        }, e[u] = e[u] || {}, r = e[u][i], o = e[u][i] = function(e, i) {
            return this._createWidget ? (arguments.length && this._createWidget(e, i), t) : new o(e, i)
        }, e.extend(o, r, {
            version: a.version,
            _proto: e.extend({}, a),
            _childConstructors: []
        }), h = new s, h.options = e.widget.extend({}, h.options), e.each(a, function(i, a) {
            return e.isFunction(a) ? (l[i] = function() {
                var e = function() {
                        return s.prototype[i].apply(this, arguments)
                    },
                    t = function(e) {
                        return s.prototype[i].apply(this, e)
                    };
                return function() {
                    var i, s = this._super,
                        n = this._superApply;
                    return this._super = e, this._superApply = t, i = a.apply(this, arguments), this._super = s, this._superApply = n, i
                }
            }(), t) : (l[i] = a, t)
        }), o.prototype = e.widget.extend(h, {
            widgetEventPrefix: r ? h.widgetEventPrefix || i : i
        }, l, {
            constructor: o,
            namespace: u,
            widgetName: i,
            widgetFullName: n
        }), r ? (e.each(r._childConstructors, function(t, i) {
            var s = i.prototype;
            e.widget(s.namespace + "." + s.widgetName, o, i._proto)
        }), delete r._childConstructors) : s._childConstructors.push(o), e.widget.bridge(i, o)
    }, e.widget.extend = function(i) {
        for (var a, n, r = s.call(arguments, 1), o = 0, h = r.length; h > o; o++)
            for (a in r[o]) n = r[o][a], r[o].hasOwnProperty(a) && n !== t && (i[a] = e.isPlainObject(n) ? e.isPlainObject(i[a]) ? e.widget.extend({}, i[a], n) : e.widget.extend({}, n) : n);
        return i
    }, e.widget.bridge = function(i, a) {
        var n = a.prototype.widgetFullName || i;
        e.fn[i] = function(r) {
            var o = "string" == typeof r,
                h = s.call(arguments, 1),
                l = this;
            return r = !o && h.length ? e.widget.extend.apply(null, [r].concat(h)) : r, o ? this.each(function() {
                var s, a = e.data(this, n);
                return a ? e.isFunction(a[r]) && "_" !== r.charAt(0) ? (s = a[r].apply(a, h), s !== a && s !== t ? (l = s && s.jquery ? l.pushStack(s.get()) : s, !1) : t) : e.error("no such method '" + r + "' for " + i + " widget instance") : e.error("cannot call methods on " + i + " prior to initialization; " + "attempted to call method '" + r + "'")
            }) : this.each(function() {
                var t = e.data(this, n);
                t ? t.option(r || {})._init() : e.data(this, n, new a(r, this))
            }), l
        }
    }, e.Widget = function() {}, e.Widget._childConstructors = [], e.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            disabled: !1,
            create: null
        },
        _createWidget: function(t, s) {
            s = e(s || this.defaultElement || this)[0], this.element = e(s), this.uuid = i++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = e.widget.extend({}, this.options, this._getCreateOptions(), t), this.bindings = e(), this.hoverable = e(), this.focusable = e(), s !== this && (e.data(s, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function(e) {
                    e.target === s && this.destroy()
                }
            }), this.document = e(s.style ? s.ownerDocument : s.document || s), this.window = e(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: e.noop,
        _getCreateEventData: e.noop,
        _create: e.noop,
        _init: e.noop,
        destroy: function() {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled " + "ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
        },
        _destroy: e.noop,
        widget: function() {
            return this.element
        },
        option: function(i, s) {
            var a, n, r, o = i;
            if (0 === arguments.length) return e.widget.extend({}, this.options);
            if ("string" == typeof i)
                if (o = {}, a = i.split("."), i = a.shift(), a.length) {
                    for (n = o[i] = e.widget.extend({}, this.options[i]), r = 0; a.length - 1 > r; r++) n[a[r]] = n[a[r]] || {}, n = n[a[r]];
                    if (i = a.pop(), 1 === arguments.length) return n[i] === t ? null : n[i];
                    n[i] = s
                } else {
                    if (1 === arguments.length) return this.options[i] === t ? null : this.options[i];
                    o[i] = s
                }
            return this._setOptions(o), this
        },
        _setOptions: function(e) {
            var t;
            for (t in e) this._setOption(t, e[t]);
            return this
        },
        _setOption: function(e, t) {
            return this.options[e] = t, "disabled" === e && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!t).attr("aria-disabled", t), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")), this
        },
        enable: function() {
            return this._setOption("disabled", !1)
        },
        disable: function() {
            return this._setOption("disabled", !0)
        },
        _on: function(i, s, a) {
            var n, r = this;
            "boolean" != typeof i && (a = s, s = i, i = !1), a ? (s = n = e(s), this.bindings = this.bindings.add(s)) : (a = s, s = this.element, n = this.widget()), e.each(a, function(a, o) {
                function h() {
                    return i || r.options.disabled !== !0 && !e(this).hasClass("ui-state-disabled") ? ("string" == typeof o ? r[o] : o).apply(r, arguments) : t
                }
                "string" != typeof o && (h.guid = o.guid = o.guid || h.guid || e.guid++);
                var l = a.match(/^(\w+)\s*(.*)$/),
                    u = l[1] + r.eventNamespace,
                    d = l[2];
                d ? n.delegate(d, u, h) : s.bind(u, h)
            })
        },
        _off: function(e, t) {
            t = (t || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, e.unbind(t).undelegate(t)
        },
        _delay: function(e, t) {
            function i() {
                return ("string" == typeof e ? s[e] : e).apply(s, arguments)
            }
            var s = this;
            return setTimeout(i, t || 0)
        },
        _hoverable: function(t) {
            this.hoverable = this.hoverable.add(t), this._on(t, {
                mouseenter: function(t) {
                    e(t.currentTarget).addClass("ui-state-hover")
                },
                mouseleave: function(t) {
                    e(t.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable: function(t) {
            this.focusable = this.focusable.add(t), this._on(t, {
                focusin: function(t) {
                    e(t.currentTarget).addClass("ui-state-focus")
                },
                focusout: function(t) {
                    e(t.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger: function(t, i, s) {
            var a, n, r = this.options[t];
            if (s = s || {}, i = e.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), i.target = this.element[0], n = i.originalEvent)
                for (a in n) a in i || (i[a] = n[a]);
            return this.element.trigger(i, s), !(e.isFunction(r) && r.apply(this.element[0], [i].concat(s)) === !1 || i.isDefaultPrevented())
        }
    }, e.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(t, i) {
        e.Widget.prototype["_" + t] = function(s, a, n) {
            "string" == typeof a && (a = {
                effect: a
            });
            var r, o = a ? a === !0 || "number" == typeof a ? i : a.effect || i : t;
            a = a || {}, "number" == typeof a && (a = {
                duration: a
            }), r = !e.isEmptyObject(a), a.complete = n, a.delay && s.delay(a.delay), r && e.effects && e.effects.effect[o] ? s[t](a) : o !== t && s[o] ? s[o](a.duration, a.easing, n) : s.queue(function(i) {
                e(this)[t](), n && n.call(s[0]), i()
            })
        }
    })
})(jQuery);
(function(e) {
    var t = !1;
    e(document).mouseup(function() {
        t = !1
    }), e.widget("ui.mouse", {
        version: "1.10.4",
        options: {
            cancel: "input,textarea,button,select,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var t = this;
            this.element.bind("mousedown." + this.widgetName, function(e) {
                return t._mouseDown(e)
            }).bind("click." + this.widgetName, function(i) {
                return !0 === e.data(i.target, t.widgetName + ".preventClickEvent") ? (e.removeData(i.target, t.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : undefined
            }), this.started = !1
        },
        _mouseDestroy: function() {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && e(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function(i) {
            if (!t) {
                this._mouseStarted && this._mouseUp(i), this._mouseDownEvent = i;
                var s = this,
                    a = 1 === i.which,
                    n = "string" == typeof this.options.cancel && i.target.nodeName ? e(i.target).closest(this.options.cancel).length : !1;
                return a && !n && this._mouseCapture(i) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    s.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(i) && this._mouseDelayMet(i) && (this._mouseStarted = this._mouseStart(i) !== !1, !this._mouseStarted) ? (i.preventDefault(), !0) : (!0 === e.data(i.target, this.widgetName + ".preventClickEvent") && e.removeData(i.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(e) {
                    return s._mouseMove(e)
                }, this._mouseUpDelegate = function(e) {
                    return s._mouseUp(e)
                }, e(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), i.preventDefault(), t = !0, !0)) : !0
            }
        },
        _mouseMove: function(t) {
            return e.ui.ie && (!document.documentMode || 9 > document.documentMode) && !t.button ? this._mouseUp(t) : this._mouseStarted ? (this._mouseDrag(t), t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, t) !== !1, this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted)
        },
        _mouseUp: function(t) {
            return e(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, t.target === this._mouseDownEvent.target && e.data(t.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(t)), !1
        },
        _mouseDistanceMet: function(e) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0
        }
    })
})(jQuery);
(function(e, t) {
    function i(e, t, i) {
        return [parseFloat(e[0]) * (p.test(e[0]) ? t / 100 : 1), parseFloat(e[1]) * (p.test(e[1]) ? i / 100 : 1)]
    }

    function s(t, i) {
        return parseInt(e.css(t, i), 10) || 0
    }

    function a(t) {
        var i = t[0];
        return 9 === i.nodeType ? {
            width: t.width(),
            height: t.height(),
            offset: {
                top: 0,
                left: 0
            }
        } : e.isWindow(i) ? {
            width: t.width(),
            height: t.height(),
            offset: {
                top: t.scrollTop(),
                left: t.scrollLeft()
            }
        } : i.preventDefault ? {
            width: 0,
            height: 0,
            offset: {
                top: i.pageY,
                left: i.pageX
            }
        } : {
            width: t.outerWidth(),
            height: t.outerHeight(),
            offset: t.offset()
        }
    }
    e.ui = e.ui || {};
    var n, r = Math.max,
        o = Math.abs,
        h = Math.round,
        l = /left|center|right/,
        u = /top|center|bottom/,
        d = /[\+\-]\d+(\.[\d]+)?%?/,
        c = /^\w+/,
        p = /%$/,
        f = e.fn.position;
    e.position = {
            scrollbarWidth: function() {
                if (n !== t) return n;
                var i, s, a = e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                    r = a.children()[0];
                return e("body").append(a), i = r.offsetWidth, a.css("overflow", "scroll"), s = r.offsetWidth, i === s && (s = a[0].clientWidth), a.remove(), n = i - s
            },
            getScrollInfo: function(t) {
                var i = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"),
                    s = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"),
                    a = "scroll" === i || "auto" === i && t.width < t.element[0].scrollWidth,
                    n = "scroll" === s || "auto" === s && t.height < t.element[0].scrollHeight;
                return {
                    width: n ? e.position.scrollbarWidth() : 0,
                    height: a ? e.position.scrollbarWidth() : 0
                }
            },
            getWithinInfo: function(t) {
                var i = e(t || window),
                    s = e.isWindow(i[0]),
                    a = !!i[0] && 9 === i[0].nodeType;
                return {
                    element: i,
                    isWindow: s,
                    isDocument: a,
                    offset: i.offset() || {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: s ? i.width() : i.outerWidth(),
                    height: s ? i.height() : i.outerHeight()
                }
            }
        }, e.fn.position = function(t) {
            if (!t || !t.of) return f.apply(this, arguments);
            t = e.extend({}, t);
            var n, p, m, g, v, y, b = e(t.of),
                _ = e.position.getWithinInfo(t.within),
                x = e.position.getScrollInfo(_),
                k = (t.collision || "flip").split(" "),
                w = {};
            return y = a(b), b[0].preventDefault && (t.at = "left top"), p = y.width, m = y.height, g = y.offset, v = e.extend({}, g), e.each(["my", "at"], function() {
                var e, i, s = (t[this] || "").split(" ");
                1 === s.length && (s = l.test(s[0]) ? s.concat(["center"]) : u.test(s[0]) ? ["center"].concat(s) : ["center", "center"]), s[0] = l.test(s[0]) ? s[0] : "center", s[1] = u.test(s[1]) ? s[1] : "center", e = d.exec(s[0]), i = d.exec(s[1]), w[this] = [e ? e[0] : 0, i ? i[0] : 0], t[this] = [c.exec(s[0])[0], c.exec(s[1])[0]]
            }), 1 === k.length && (k[1] = k[0]), "right" === t.at[0] ? v.left += p : "center" === t.at[0] && (v.left += p / 2), "bottom" === t.at[1] ? v.top += m : "center" === t.at[1] && (v.top += m / 2), n = i(w.at, p, m), v.left += n[0], v.top += n[1], this.each(function() {
                var a, l, u = e(this),
                    d = u.outerWidth(),
                    c = u.outerHeight(),
                    f = s(this, "marginLeft"),
                    y = s(this, "marginTop"),
                    D = d + f + s(this, "marginRight") + x.width,
                    T = c + y + s(this, "marginBottom") + x.height,
                    S = e.extend({}, v),
                    M = i(w.my, u.outerWidth(), u.outerHeight());
                "right" === t.my[0] ? S.left -= d : "center" === t.my[0] && (S.left -= d / 2), "bottom" === t.my[1] ? S.top -= c : "center" === t.my[1] && (S.top -= c / 2), S.left += M[0], S.top += M[1], e.support.offsetFractions || (S.left = h(S.left), S.top = h(S.top)), a = {
                    marginLeft: f,
                    marginTop: y
                }, e.each(["left", "top"], function(i, s) {
                    e.ui.position[k[i]] && e.ui.position[k[i]][s](S, {
                        targetWidth: p,
                        targetHeight: m,
                        elemWidth: d,
                        elemHeight: c,
                        collisionPosition: a,
                        collisionWidth: D,
                        collisionHeight: T,
                        offset: [n[0] + M[0], n[1] + M[1]],
                        my: t.my,
                        at: t.at,
                        within: _,
                        elem: u
                    })
                }), t.using && (l = function(e) {
                    var i = g.left - S.left,
                        s = i + p - d,
                        a = g.top - S.top,
                        n = a + m - c,
                        h = {
                            target: {
                                element: b,
                                left: g.left,
                                top: g.top,
                                width: p,
                                height: m
                            },
                            element: {
                                element: u,
                                left: S.left,
                                top: S.top,
                                width: d,
                                height: c
                            },
                            horizontal: 0 > s ? "left" : i > 0 ? "right" : "center",
                            vertical: 0 > n ? "top" : a > 0 ? "bottom" : "middle"
                        };
                    d > p && p > o(i + s) && (h.horizontal = "center"), c > m && m > o(a + n) && (h.vertical = "middle"), h.important = r(o(i), o(s)) > r(o(a), o(n)) ? "horizontal" : "vertical", t.using.call(this, e, h)
                }), u.offset(e.extend(S, {
                    using: l
                }))
            })
        }, e.ui.position = {
            fit: {
                left: function(e, t) {
                    var i, s = t.within,
                        a = s.isWindow ? s.scrollLeft : s.offset.left,
                        n = s.width,
                        o = e.left - t.collisionPosition.marginLeft,
                        h = a - o,
                        l = o + t.collisionWidth - n - a;
                    t.collisionWidth > n ? h > 0 && 0 >= l ? (i = e.left + h + t.collisionWidth - n - a, e.left += h - i) : e.left = l > 0 && 0 >= h ? a : h > l ? a + n - t.collisionWidth : a : h > 0 ? e.left += h : l > 0 ? e.left -= l : e.left = r(e.left - o, e.left)
                },
                top: function(e, t) {
                    var i, s = t.within,
                        a = s.isWindow ? s.scrollTop : s.offset.top,
                        n = t.within.height,
                        o = e.top - t.collisionPosition.marginTop,
                        h = a - o,
                        l = o + t.collisionHeight - n - a;
                    t.collisionHeight > n ? h > 0 && 0 >= l ? (i = e.top + h + t.collisionHeight - n - a, e.top += h - i) : e.top = l > 0 && 0 >= h ? a : h > l ? a + n - t.collisionHeight : a : h > 0 ? e.top += h : l > 0 ? e.top -= l : e.top = r(e.top - o, e.top)
                }
            },
            flip: {
                left: function(e, t) {
                    var i, s, a = t.within,
                        n = a.offset.left + a.scrollLeft,
                        r = a.width,
                        h = a.isWindow ? a.scrollLeft : a.offset.left,
                        l = e.left - t.collisionPosition.marginLeft,
                        u = l - h,
                        d = l + t.collisionWidth - r - h,
                        c = "left" === t.my[0] ? -t.elemWidth : "right" === t.my[0] ? t.elemWidth : 0,
                        p = "left" === t.at[0] ? t.targetWidth : "right" === t.at[0] ? -t.targetWidth : 0,
                        f = -2 * t.offset[0];
                    0 > u ? (i = e.left + c + p + f + t.collisionWidth - r - n, (0 > i || o(u) > i) && (e.left += c + p + f)) : d > 0 && (s = e.left - t.collisionPosition.marginLeft + c + p + f - h, (s > 0 || d > o(s)) && (e.left += c + p + f))
                },
                top: function(e, t) {
                    var i, s, a = t.within,
                        n = a.offset.top + a.scrollTop,
                        r = a.height,
                        h = a.isWindow ? a.scrollTop : a.offset.top,
                        l = e.top - t.collisionPosition.marginTop,
                        u = l - h,
                        d = l + t.collisionHeight - r - h,
                        c = "top" === t.my[1],
                        p = c ? -t.elemHeight : "bottom" === t.my[1] ? t.elemHeight : 0,
                        f = "top" === t.at[1] ? t.targetHeight : "bottom" === t.at[1] ? -t.targetHeight : 0,
                        m = -2 * t.offset[1];
                    0 > u ? (s = e.top + p + f + m + t.collisionHeight - r - n, e.top + p + f + m > u && (0 > s || o(u) > s) && (e.top += p + f + m)) : d > 0 && (i = e.top - t.collisionPosition.marginTop + p + f + m - h, e.top + p + f + m > d && (i > 0 || d > o(i)) && (e.top += p + f + m))
                }
            },
            flipfit: {
                left: function() {
                    e.ui.position.flip.left.apply(this, arguments), e.ui.position.fit.left.apply(this, arguments)
                },
                top: function() {
                    e.ui.position.flip.top.apply(this, arguments), e.ui.position.fit.top.apply(this, arguments)
                }
            }
        },
        function() {
            var t, i, s, a, n, r = document.getElementsByTagName("body")[0],
                o = document.createElement("div");
            t = document.createElement(r ? "div" : "body"), s = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            }, r && e.extend(s, {
                position: "absolute",
                left: "-1000px",
                top: "-1000px"
            });
            for (n in s) t.style[n] = s[n];
            t.appendChild(o), i = r || document.documentElement, i.insertBefore(t, i.firstChild), o.style.cssText = "position: absolute; left: 10.7432222px;", a = e(o).offset().left, e.support.offsetFractions = a > 10 && 11 > a, t.innerHTML = "", i.removeChild(t)
        }()
})(jQuery);
(function(e) {
    e.widget("ui.draggable", e.ui.mouse, {
        version: "1.10.4",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function() {
            "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._mouseInit()
        },
        _destroy: function() {
            this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._mouseDestroy()
        },
        _mouseCapture: function(t) {
            var i = this.options;
            return this.helper || i.disabled || e(t.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(t), this.handle ? (e(i.iframeFix === !0 ? "iframe" : i.iframeFix).each(function() {
                e("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                    width: this.offsetWidth + "px",
                    height: this.offsetHeight + "px",
                    position: "absolute",
                    opacity: "0.001",
                    zIndex: 1e3
                }).css(e(this).offset()).appendTo("body")
            }), !0) : !1)
        },
        _mouseStart: function(t) {
            var i = this.options;
            return this.helper = this._createHelper(t), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), e.ui.ddmanager && (e.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(), this.offsetParent = this.helper.offsetParent(), this.offsetParentCssPosition = this.offsetParent.css("position"), this.offset = this.positionAbs = this.element.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, this.offset.scroll = !1, e.extend(this.offset, {
                click: {
                    left: t.pageX - this.offset.left,
                    top: t.pageY - this.offset.top
                },
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }), this.originalPosition = this.position = this._generatePosition(t), this.originalPageX = t.pageX, this.originalPageY = t.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), this._setContainment(), this._trigger("start", t) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), e.ui.ddmanager && !i.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this._mouseDrag(t, !0), e.ui.ddmanager && e.ui.ddmanager.dragStart(this, t), !0)
        },
        _mouseDrag: function(t, i) {
            if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(t), this.positionAbs = this._convertPositionTo("absolute"), !i) {
                var s = this._uiHash();
                if (this._trigger("drag", t, s) === !1) return this._mouseUp({}), !1;
                this.position = s.position
            }
            return this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), e.ui.ddmanager && e.ui.ddmanager.drag(this, t), !1
        },
        _mouseStop: function(t) {
            var i = this,
                s = !1;
            return e.ui.ddmanager && !this.options.dropBehaviour && (s = e.ui.ddmanager.drop(this, t)), this.dropped && (s = this.dropped, this.dropped = !1), "original" !== this.options.helper || e.contains(this.element[0].ownerDocument, this.element[0]) ? ("invalid" === this.options.revert && !s || "valid" === this.options.revert && s || this.options.revert === !0 || e.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? e(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
                i._trigger("stop", t) !== !1 && i._clear()
            }) : this._trigger("stop", t) !== !1 && this._clear(), !1) : !1
        },
        _mouseUp: function(t) {
            return e("div.ui-draggable-iframeFix").each(function() {
                this.parentNode.removeChild(this)
            }), e.ui.ddmanager && e.ui.ddmanager.dragStop(this, t), e.ui.mouse.prototype._mouseUp.call(this, t)
        },
        cancel: function() {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this
        },
        _getHandle: function(t) {
            return this.options.handle ? !!e(t.target).closest(this.element.find(this.options.handle)).length : !0
        },
        _createHelper: function(t) {
            var i = this.options,
                s = e.isFunction(i.helper) ? e(i.helper.apply(this.element[0], [t])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
            return s.parents("body").length || s.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), s[0] === this.element[0] || /(fixed|absolute)/.test(s.css("position")) || s.css("position", "absolute"), s
        },
        _adjustOffsetFromHelper: function(t) {
            "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = {
                left: +t[0],
                top: +t[1] || 0
            }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top)
        },
        _getParentOffset: function() {
            var t = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && e.ui.ie) && (t = {
                top: 0,
                left: 0
            }), {
                top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" === this.cssPosition) {
                var e = this.element.position();
                return {
                    top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {
                top: 0,
                left: 0
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var t, i, s, a = this.options;
            return a.containment ? "window" === a.containment ? (this.containment = [e(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, e(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, e(window).scrollLeft() + e(window).width() - this.helperProportions.width - this.margins.left, e(window).scrollTop() + (e(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], undefined) : "document" === a.containment ? (this.containment = [0, 0, e(document).width() - this.helperProportions.width - this.margins.left, (e(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], undefined) : a.containment.constructor === Array ? (this.containment = a.containment, undefined) : ("parent" === a.containment && (a.containment = this.helper[0].parentNode), i = e(a.containment), s = i[0], s && (t = "hidden" !== i.css("overflow"), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (t ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (t ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = i), undefined) : (this.containment = null, undefined)
        },
        _convertPositionTo: function(t, i) {
            i || (i = this.position);
            var s = "absolute" === t ? 1 : -1,
                a = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent;
            return this.offset.scroll || (this.offset.scroll = {
                top: a.scrollTop(),
                left: a.scrollLeft()
            }), {
                top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top) * s,
                left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) * s
            }
        },
        _generatePosition: function(t) {
            var i, s, a, n, r = this.options,
                o = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                h = t.pageX,
                l = t.pageY;
            return this.offset.scroll || (this.offset.scroll = {
                top: o.scrollTop(),
                left: o.scrollLeft()
            }), this.originalPosition && (this.containment && (this.relative_container ? (s = this.relative_container.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, t.pageX - this.offset.click.left < i[0] && (h = i[0] + this.offset.click.left), t.pageY - this.offset.click.top < i[1] && (l = i[1] + this.offset.click.top), t.pageX - this.offset.click.left > i[2] && (h = i[2] + this.offset.click.left), t.pageY - this.offset.click.top > i[3] && (l = i[3] + this.offset.click.top)), r.grid && (a = r.grid[1] ? this.originalPageY + Math.round((l - this.originalPageY) / r.grid[1]) * r.grid[1] : this.originalPageY, l = i ? a - this.offset.click.top >= i[1] || a - this.offset.click.top > i[3] ? a : a - this.offset.click.top >= i[1] ? a - r.grid[1] : a + r.grid[1] : a, n = r.grid[0] ? this.originalPageX + Math.round((h - this.originalPageX) / r.grid[0]) * r.grid[0] : this.originalPageX, h = i ? n - this.offset.click.left >= i[0] || n - this.offset.click.left > i[2] ? n : n - this.offset.click.left >= i[0] ? n - r.grid[0] : n + r.grid[0] : n)), {
                top: l - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top),
                left: h - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left)
            }
        },
        _clear: function() {
            this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1
        },
        _trigger: function(t, i, s) {
            return s = s || this._uiHash(), e.ui.plugin.call(this, t, [i, s]), "drag" === t && (this.positionAbs = this._convertPositionTo("absolute")), e.Widget.prototype._trigger.call(this, t, i, s)
        },
        plugins: {},
        _uiHash: function() {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            }
        }
    }), e.ui.plugin.add("draggable", "connectToSortable", {
        start: function(t, i) {
            var s = e(this).data("ui-draggable"),
                a = s.options,
                n = e.extend({}, i, {
                    item: s.element
                });
            s.sortables = [], e(a.connectToSortable).each(function() {
                var i = e.data(this, "ui-sortable");
                i && !i.options.disabled && (s.sortables.push({
                    instance: i,
                    shouldRevert: i.options.revert
                }), i.refreshPositions(), i._trigger("activate", t, n))
            })
        },
        stop: function(t, i) {
            var s = e(this).data("ui-draggable"),
                a = e.extend({}, i, {
                    item: s.element
                });
            e.each(s.sortables, function() {
                this.instance.isOver ? (this.instance.isOver = 0, s.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(t), this.instance.options.helper = this.instance.options._helper, "original" === s.options.helper && this.instance.currentItem.css({
                    top: "auto",
                    left: "auto"
                })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", t, a))
            })
        },
        drag: function(t, i) {
            var s = e(this).data("ui-draggable"),
                a = this;
            e.each(s.sortables, function() {
                var n = !1,
                    r = this;
                this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (n = !0, e.each(s.sortables, function() {
                    return this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this !== r && this.instance._intersectsWith(this.instance.containerCache) && e.contains(r.instance.element[0], this.instance.element[0]) && (n = !1), n
                })), n ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = e(a).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function() {
                    return i.helper[0]
                }, t.target = this.instance.currentItem[0], this.instance._mouseCapture(t, !0), this.instance._mouseStart(t, !0, !0), this.instance.offset.click.top = s.offset.click.top, this.instance.offset.click.left = s.offset.click.left, this.instance.offset.parent.left -= s.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= s.offset.parent.top - this.instance.offset.parent.top, s._trigger("toSortable", t), s.dropped = this.instance.element, s.currentItem = s.element, this.instance.fromOutside = s), this.instance.currentItem && this.instance._mouseDrag(t)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", t, this.instance._uiHash(this.instance)), this.instance._mouseStop(t, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), s._trigger("fromSortable", t), s.dropped = !1)
            })
        }
    }), e.ui.plugin.add("draggable", "cursor", {
        start: function() {
            var t = e("body"),
                i = e(this).data("ui-draggable").options;
            t.css("cursor") && (i._cursor = t.css("cursor")), t.css("cursor", i.cursor)
        },
        stop: function() {
            var t = e(this).data("ui-draggable").options;
            t._cursor && e("body").css("cursor", t._cursor)
        }
    }), e.ui.plugin.add("draggable", "opacity", {
        start: function(t, i) {
            var s = e(i.helper),
                a = e(this).data("ui-draggable").options;
            s.css("opacity") && (a._opacity = s.css("opacity")), s.css("opacity", a.opacity)
        },
        stop: function(t, i) {
            var s = e(this).data("ui-draggable").options;
            s._opacity && e(i.helper).css("opacity", s._opacity)
        }
    }), e.ui.plugin.add("draggable", "scroll", {
        start: function() {
            var t = e(this).data("ui-draggable");
            t.scrollParent[0] !== document && "HTML" !== t.scrollParent[0].tagName && (t.overflowOffset = t.scrollParent.offset())
        },
        drag: function(t) {
            var i = e(this).data("ui-draggable"),
                s = i.options,
                a = !1;
            i.scrollParent[0] !== document && "HTML" !== i.scrollParent[0].tagName ? (s.axis && "x" === s.axis || (i.overflowOffset.top + i.scrollParent[0].offsetHeight - t.pageY < s.scrollSensitivity ? i.scrollParent[0].scrollTop = a = i.scrollParent[0].scrollTop + s.scrollSpeed : t.pageY - i.overflowOffset.top < s.scrollSensitivity && (i.scrollParent[0].scrollTop = a = i.scrollParent[0].scrollTop - s.scrollSpeed)), s.axis && "y" === s.axis || (i.overflowOffset.left + i.scrollParent[0].offsetWidth - t.pageX < s.scrollSensitivity ? i.scrollParent[0].scrollLeft = a = i.scrollParent[0].scrollLeft + s.scrollSpeed : t.pageX - i.overflowOffset.left < s.scrollSensitivity && (i.scrollParent[0].scrollLeft = a = i.scrollParent[0].scrollLeft - s.scrollSpeed))) : (s.axis && "x" === s.axis || (t.pageY - e(document).scrollTop() < s.scrollSensitivity ? a = e(document).scrollTop(e(document).scrollTop() - s.scrollSpeed) : e(window).height() - (t.pageY - e(document).scrollTop()) < s.scrollSensitivity && (a = e(document).scrollTop(e(document).scrollTop() + s.scrollSpeed))), s.axis && "y" === s.axis || (t.pageX - e(document).scrollLeft() < s.scrollSensitivity ? a = e(document).scrollLeft(e(document).scrollLeft() - s.scrollSpeed) : e(window).width() - (t.pageX - e(document).scrollLeft()) < s.scrollSensitivity && (a = e(document).scrollLeft(e(document).scrollLeft() + s.scrollSpeed)))), a !== !1 && e.ui.ddmanager && !s.dropBehaviour && e.ui.ddmanager.prepareOffsets(i, t)
        }
    }), e.ui.plugin.add("draggable", "snap", {
        start: function() {
            var t = e(this).data("ui-draggable"),
                i = t.options;
            t.snapElements = [], e(i.snap.constructor !== String ? i.snap.items || ":data(ui-draggable)" : i.snap).each(function() {
                var i = e(this),
                    s = i.offset();
                this !== t.element[0] && t.snapElements.push({
                    item: this,
                    width: i.outerWidth(),
                    height: i.outerHeight(),
                    top: s.top,
                    left: s.left
                })
            })
        },
        drag: function(t, i) {
            var s, a, n, r, o, h, l, u, d, c, p = e(this).data("ui-draggable"),
                m = p.options,
                f = m.snapTolerance,
                g = i.offset.left,
                v = g + p.helperProportions.width,
                y = i.offset.top,
                b = y + p.helperProportions.height;
            for (d = p.snapElements.length - 1; d >= 0; d--) o = p.snapElements[d].left, h = o + p.snapElements[d].width, l = p.snapElements[d].top, u = l + p.snapElements[d].height, o - f > v || g > h + f || l - f > b || y > u + f || !e.contains(p.snapElements[d].item.ownerDocument, p.snapElements[d].item) ? (p.snapElements[d].snapping && p.options.snap.release && p.options.snap.release.call(p.element, t, e.extend(p._uiHash(), {
                snapItem: p.snapElements[d].item
            })), p.snapElements[d].snapping = !1) : ("inner" !== m.snapMode && (s = f >= Math.abs(l - b), a = f >= Math.abs(u - y), n = f >= Math.abs(o - v), r = f >= Math.abs(h - g), s && (i.position.top = p._convertPositionTo("relative", {
                top: l - p.helperProportions.height,
                left: 0
            }).top - p.margins.top), a && (i.position.top = p._convertPositionTo("relative", {
                top: u,
                left: 0
            }).top - p.margins.top), n && (i.position.left = p._convertPositionTo("relative", {
                top: 0,
                left: o - p.helperProportions.width
            }).left - p.margins.left), r && (i.position.left = p._convertPositionTo("relative", {
                top: 0,
                left: h
            }).left - p.margins.left)), c = s || a || n || r, "outer" !== m.snapMode && (s = f >= Math.abs(l - y), a = f >= Math.abs(u - b), n = f >= Math.abs(o - g), r = f >= Math.abs(h - v), s && (i.position.top = p._convertPositionTo("relative", {
                top: l,
                left: 0
            }).top - p.margins.top), a && (i.position.top = p._convertPositionTo("relative", {
                top: u - p.helperProportions.height,
                left: 0
            }).top - p.margins.top), n && (i.position.left = p._convertPositionTo("relative", {
                top: 0,
                left: o
            }).left - p.margins.left), r && (i.position.left = p._convertPositionTo("relative", {
                top: 0,
                left: h - p.helperProportions.width
            }).left - p.margins.left)), !p.snapElements[d].snapping && (s || a || n || r || c) && p.options.snap.snap && p.options.snap.snap.call(p.element, t, e.extend(p._uiHash(), {
                snapItem: p.snapElements[d].item
            })), p.snapElements[d].snapping = s || a || n || r || c)
        }
    }), e.ui.plugin.add("draggable", "stack", {
        start: function() {
            var t, i = this.data("ui-draggable").options,
                s = e.makeArray(e(i.stack)).sort(function(t, i) {
                    return (parseInt(e(t).css("zIndex"), 10) || 0) - (parseInt(e(i).css("zIndex"), 10) || 0)
                });
            s.length && (t = parseInt(e(s[0]).css("zIndex"), 10) || 0, e(s).each(function(i) {
                e(this).css("zIndex", t + i)
            }), this.css("zIndex", t + s.length))
        }
    }), e.ui.plugin.add("draggable", "zIndex", {
        start: function(t, i) {
            var s = e(i.helper),
                a = e(this).data("ui-draggable").options;
            s.css("zIndex") && (a._zIndex = s.css("zIndex")), s.css("zIndex", a.zIndex)
        },
        stop: function(t, i) {
            var s = e(this).data("ui-draggable").options;
            s._zIndex && e(i.helper).css("zIndex", s._zIndex)
        }
    })
})(jQuery);
(function(e) {
    function t(e, t, i) {
        return e > t && t + i > e
    }
    e.widget("ui.droppable", {
        version: "1.10.4",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function() {
            var t, i = this.options,
                s = i.accept;
            this.isover = !1, this.isout = !0, this.accept = e.isFunction(s) ? s : function(e) {
                return e.is(s)
            }, this.proportions = function() {
                return arguments.length ? (t = arguments[0], undefined) : t ? t : t = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }
            }, e.ui.ddmanager.droppables[i.scope] = e.ui.ddmanager.droppables[i.scope] || [], e.ui.ddmanager.droppables[i.scope].push(this), i.addClasses && this.element.addClass("ui-droppable")
        },
        _destroy: function() {
            for (var t = 0, i = e.ui.ddmanager.droppables[this.options.scope]; i.length > t; t++) i[t] === this && i.splice(t, 1);
            this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption: function(t, i) {
            "accept" === t && (this.accept = e.isFunction(i) ? i : function(e) {
                return e.is(i)
            }), e.Widget.prototype._setOption.apply(this, arguments)
        },
        _activate: function(t) {
            var i = e.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", t, this.ui(i))
        },
        _deactivate: function(t) {
            var i = e.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), i && this._trigger("deactivate", t, this.ui(i))
        },
        _over: function(t) {
            var i = e.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", t, this.ui(i)))
        },
        _out: function(t) {
            var i = e.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", t, this.ui(i)))
        },
        _drop: function(t, i) {
            var s = i || e.ui.ddmanager.current,
                a = !1;
            return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                var t = e.data(this, "ui-droppable");
                return t.options.greedy && !t.options.disabled && t.options.scope === s.options.scope && t.accept.call(t.element[0], s.currentItem || s.element) && e.ui.intersect(s, e.extend(t, {
                    offset: t.element.offset()
                }), t.options.tolerance) ? (a = !0, !1) : undefined
            }), a ? !1 : this.accept.call(this.element[0], s.currentItem || s.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", t, this.ui(s)), this.element) : !1) : !1
        },
        ui: function(e) {
            return {
                draggable: e.currentItem || e.element,
                helper: e.helper,
                position: e.position,
                offset: e.positionAbs
            }
        }
    }), e.ui.intersect = function(e, i, s) {
        if (!i.offset) return !1;
        var a, n, r = (e.positionAbs || e.position.absolute).left,
            o = (e.positionAbs || e.position.absolute).top,
            l = r + e.helperProportions.width,
            h = o + e.helperProportions.height,
            u = i.offset.left,
            d = i.offset.top,
            c = u + i.proportions().width,
            p = d + i.proportions().height;
        switch (s) {
            case "fit":
                return r >= u && c >= l && o >= d && p >= h;
            case "intersect":
                return r + e.helperProportions.width / 2 > u && c > l - e.helperProportions.width / 2 && o + e.helperProportions.height / 2 > d && p > h - e.helperProportions.height / 2;
            case "pointer":
                return a = (e.positionAbs || e.position.absolute).left + (e.clickOffset || e.offset.click).left, n = (e.positionAbs || e.position.absolute).top + (e.clickOffset || e.offset.click).top, t(n, d, i.proportions().height) && t(a, u, i.proportions().width);
            case "touch":
                return (o >= d && p >= o || h >= d && p >= h || d > o && h > p) && (r >= u && c >= r || l >= u && c >= l || u > r && l > c);
            default:
                return !1
        }
    }, e.ui.ddmanager = {
        current: null,
        droppables: {
            "default": []
        },
        prepareOffsets: function(t, i) {
            var s, a, n = e.ui.ddmanager.droppables[t.options.scope] || [],
                r = i ? i.type : null,
                o = (t.currentItem || t.element).find(":data(ui-droppable)").addBack();
            e: for (s = 0; n.length > s; s++)
                if (!(n[s].options.disabled || t && !n[s].accept.call(n[s].element[0], t.currentItem || t.element))) {
                    for (a = 0; o.length > a; a++)
                        if (o[a] === n[s].element[0]) {
                            n[s].proportions().height = 0;
                            continue e
                        }
                    n[s].visible = "none" !== n[s].element.css("display"), n[s].visible && ("mousedown" === r && n[s]._activate.call(n[s], i), n[s].offset = n[s].element.offset(), n[s].proportions({
                        width: n[s].element[0].offsetWidth,
                        height: n[s].element[0].offsetHeight
                    }))
                }
        },
        drop: function(t, i) {
            var s = !1;
            return e.each((e.ui.ddmanager.droppables[t.options.scope] || []).slice(), function() {
                this.options && (!this.options.disabled && this.visible && e.ui.intersect(t, this, this.options.tolerance) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], t.currentItem || t.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))
            }), s
        },
        dragStart: function(t, i) {
            t.element.parentsUntil("body").bind("scroll.droppable", function() {
                t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, i)
            })
        },
        drag: function(t, i) {
            t.options.refreshPositions && e.ui.ddmanager.prepareOffsets(t, i), e.each(e.ui.ddmanager.droppables[t.options.scope] || [], function() {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var s, a, n, r = e.ui.intersect(t, this, this.options.tolerance),
                        o = !r && this.isover ? "isout" : r && !this.isover ? "isover" : null;
                    o && (this.options.greedy && (a = this.options.scope, n = this.element.parents(":data(ui-droppable)").filter(function() {
                        return e.data(this, "ui-droppable").options.scope === a
                    }), n.length && (s = e.data(n[0], "ui-droppable"), s.greedyChild = "isover" === o)), s && "isover" === o && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[o] = !0, this["isout" === o ? "isover" : "isout"] = !1, this["isover" === o ? "_over" : "_out"].call(this, i), s && "isout" === o && (s.isout = !1, s.isover = !0, s._over.call(s, i)))
                }
            })
        },
        dragStop: function(t, i) {
            t.element.parentsUntil("body").unbind("scroll.droppable"), t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, i)
        }
    }
})(jQuery);
(function(e) {
    function t(e, t, i) {
        return e > t && t + i > e
    }

    function i(e) {
        return /left|right/.test(e.css("float")) || /inline|table-cell/.test(e.css("display"))
    }
    e.widget("ui.sortable", e.ui.mouse, {
        version: "1.10.4",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _create: function() {
            var e = this.options;
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.floating = this.items.length ? "x" === e.axis || i(this.items[0].item) : !1, this.offset = this.element.offset(), this._mouseInit(), this.ready = !0
        },
        _destroy: function() {
            this.element.removeClass("ui-sortable ui-sortable-disabled"), this._mouseDestroy();
            for (var e = this.items.length - 1; e >= 0; e--) this.items[e].item.removeData(this.widgetName + "-item");
            return this
        },
        _setOption: function(t, i) {
            "disabled" === t ? (this.options[t] = i, this.widget().toggleClass("ui-sortable-disabled", !!i)) : e.Widget.prototype._setOption.apply(this, arguments)
        },
        _mouseCapture: function(t, i) {
            var s = null,
                a = !1,
                n = this;
            return this.reverting ? !1 : this.options.disabled || "static" === this.options.type ? !1 : (this._refreshItems(t), e(t.target).parents().each(function() {
                return e.data(this, n.widgetName + "-item") === n ? (s = e(this), !1) : undefined
            }), e.data(t.target, n.widgetName + "-item") === n && (s = e(t.target)), s ? !this.options.handle || i || (e(this.options.handle, s).find("*").addBack().each(function() {
                this === t.target && (a = !0)
            }), a) ? (this.currentItem = s, this._removeCurrentsFromItems(), !0) : !1 : !1)
        },
        _mouseStart: function(t, i, s) {
            var a, n, r = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(t), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left
                }, e.extend(this.offset, {
                    click: {
                        left: t.pageX - this.offset.left,
                        top: t.pageY - this.offset.top
                    },
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()
                }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(t), this.originalPageX = t.pageX, this.originalPageY = t.pageY, r.cursorAt && this._adjustOffsetFromHelper(r.cursorAt), this.domPosition = {
                    prev: this.currentItem.prev()[0],
                    parent: this.currentItem.parent()[0]
                }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), r.containment && this._setContainment(), r.cursor && "auto" !== r.cursor && (n = this.document.find("body"), this.storedCursor = n.css("cursor"), n.css("cursor", r.cursor), this.storedStylesheet = e("<style>*{ cursor: " + r.cursor + " !important; }</style>").appendTo(n)), r.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", r.opacity)), r.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", r.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", t, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s)
                for (a = this.containers.length - 1; a >= 0; a--) this.containers[a]._trigger("activate", t, this._uiHash(this));
            return e.ui.ddmanager && (e.ui.ddmanager.current = this), e.ui.ddmanager && !r.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(t), !0
        },
        _mouseDrag: function(t) {
            var i, s, a, n, r = this.options,
                o = !1;
            for (this.position = this._generatePosition(t), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - t.pageY < r.scrollSensitivity ? this.scrollParent[0].scrollTop = o = this.scrollParent[0].scrollTop + r.scrollSpeed : t.pageY - this.overflowOffset.top < r.scrollSensitivity && (this.scrollParent[0].scrollTop = o = this.scrollParent[0].scrollTop - r.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - t.pageX < r.scrollSensitivity ? this.scrollParent[0].scrollLeft = o = this.scrollParent[0].scrollLeft + r.scrollSpeed : t.pageX - this.overflowOffset.left < r.scrollSensitivity && (this.scrollParent[0].scrollLeft = o = this.scrollParent[0].scrollLeft - r.scrollSpeed)) : (t.pageY - e(document).scrollTop() < r.scrollSensitivity ? o = e(document).scrollTop(e(document).scrollTop() - r.scrollSpeed) : e(window).height() - (t.pageY - e(document).scrollTop()) < r.scrollSensitivity && (o = e(document).scrollTop(e(document).scrollTop() + r.scrollSpeed)), t.pageX - e(document).scrollLeft() < r.scrollSensitivity ? o = e(document).scrollLeft(e(document).scrollLeft() - r.scrollSpeed) : e(window).width() - (t.pageX - e(document).scrollLeft()) < r.scrollSensitivity && (o = e(document).scrollLeft(e(document).scrollLeft() + r.scrollSpeed))), o !== !1 && e.ui.ddmanager && !r.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--)
                if (s = this.items[i], a = s.item[0], n = this._intersectsWithPointer(s), n && s.instance === this.currentContainer && a !== this.currentItem[0] && this.placeholder[1 === n ? "next" : "prev"]()[0] !== a && !e.contains(this.placeholder[0], a) && ("semi-dynamic" === this.options.type ? !e.contains(this.element[0], a) : !0)) {
                    if (this.direction = 1 === n ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
                    this._rearrange(t, s), this._trigger("change", t, this._uiHash());
                    break
                }
            return this._contactContainers(t), e.ui.ddmanager && e.ui.ddmanager.drag(this, t), this._trigger("sort", t, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function(t, i) {
            if (t) {
                if (e.ui.ddmanager && !this.options.dropBehaviour && e.ui.ddmanager.drop(this, t), this.options.revert) {
                    var s = this,
                        a = this.placeholder.offset(),
                        n = this.options.axis,
                        r = {};
                    n && "x" !== n || (r.left = a.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)), n && "y" !== n || (r.top = a.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, e(this.helper).animate(r, parseInt(this.options.revert, 10) || 500, function() {
                        s._clear(t)
                    })
                } else this._clear(t, i);
                return !1
            }
        },
        cancel: function() {
            if (this.dragging) {
                this._mouseUp({
                    target: null
                }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var t = this.containers.length - 1; t >= 0; t--) this.containers[t]._trigger("deactivate", null, this._uiHash(this)), this.containers[t].containerCache.over && (this.containers[t]._trigger("out", null, this._uiHash(this)), this.containers[t].containerCache.over = 0)
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), e.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? e(this.domPosition.prev).after(this.currentItem) : e(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function(t) {
            var i = this._getItemsAsjQuery(t && t.connected),
                s = [];
            return t = t || {}, e(i).each(function() {
                var i = (e(t.item || this).attr(t.attribute || "id") || "").match(t.expression || /(.+)[\-=_](.+)/);
                i && s.push((t.key || i[1] + "[]") + "=" + (t.key && t.expression ? i[1] : i[2]))
            }), !s.length && t.key && s.push(t.key + "="), s.join("&")
        },
        toArray: function(t) {
            var i = this._getItemsAsjQuery(t && t.connected),
                s = [];
            return t = t || {}, i.each(function() {
                s.push(e(t.item || this).attr(t.attribute || "id") || "")
            }), s
        },
        _intersectsWith: function(e) {
            var t = this.positionAbs.left,
                i = t + this.helperProportions.width,
                s = this.positionAbs.top,
                a = s + this.helperProportions.height,
                n = e.left,
                r = n + e.width,
                o = e.top,
                h = o + e.height,
                l = this.offset.click.top,
                u = this.offset.click.left,
                d = "x" === this.options.axis || s + l > o && h > s + l,
                c = "y" === this.options.axis || t + u > n && r > t + u,
                p = d && c;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > e[this.floating ? "width" : "height"] ? p : t + this.helperProportions.width / 2 > n && r > i - this.helperProportions.width / 2 && s + this.helperProportions.height / 2 > o && h > a - this.helperProportions.height / 2
        },
        _intersectsWithPointer: function(e) {
            var i = "x" === this.options.axis || t(this.positionAbs.top + this.offset.click.top, e.top, e.height),
                s = "y" === this.options.axis || t(this.positionAbs.left + this.offset.click.left, e.left, e.width),
                a = i && s,
                n = this._getDragVerticalDirection(),
                r = this._getDragHorizontalDirection();
            return a ? this.floating ? r && "right" === r || "down" === n ? 2 : 1 : n && ("down" === n ? 2 : 1) : !1
        },
        _intersectsWithSides: function(e) {
            var i = t(this.positionAbs.top + this.offset.click.top, e.top + e.height / 2, e.height),
                s = t(this.positionAbs.left + this.offset.click.left, e.left + e.width / 2, e.width),
                a = this._getDragVerticalDirection(),
                n = this._getDragHorizontalDirection();
            return this.floating && n ? "right" === n && s || "left" === n && !s : a && ("down" === a && i || "up" === a && !i)
        },
        _getDragVerticalDirection: function() {
            var e = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== e && (e > 0 ? "down" : "up")
        },
        _getDragHorizontalDirection: function() {
            var e = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== e && (e > 0 ? "right" : "left")
        },
        refresh: function(e) {
            return this._refreshItems(e), this.refreshPositions(), this
        },
        _connectWith: function() {
            var e = this.options;
            return e.connectWith.constructor === String ? [e.connectWith] : e.connectWith
        },
        _getItemsAsjQuery: function(t) {
            function i() {
                o.push(this)
            }
            var s, a, n, r, o = [],
                h = [],
                l = this._connectWith();
            if (l && t)
                for (s = l.length - 1; s >= 0; s--)
                    for (n = e(l[s]), a = n.length - 1; a >= 0; a--) r = e.data(n[a], this.widgetFullName), r && r !== this && !r.options.disabled && h.push([e.isFunction(r.options.items) ? r.options.items.call(r.element) : e(r.options.items, r.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), r]);
            for (h.push([e.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                    options: this.options,
                    item: this.currentItem
                }) : e(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), s = h.length - 1; s >= 0; s--) h[s][0].each(i);
            return e(o)
        },
        _removeCurrentsFromItems: function() {
            var t = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = e.grep(this.items, function(e) {
                for (var i = 0; t.length > i; i++)
                    if (t[i] === e.item[0]) return !1;
                return !0
            })
        },
        _refreshItems: function(t) {
            this.items = [], this.containers = [this];
            var i, s, a, n, r, o, h, l, u = this.items,
                d = [
                    [e.isFunction(this.options.items) ? this.options.items.call(this.element[0], t, {
                        item: this.currentItem
                    }) : e(this.options.items, this.element), this]
                ],
                c = this._connectWith();
            if (c && this.ready)
                for (i = c.length - 1; i >= 0; i--)
                    for (a = e(c[i]), s = a.length - 1; s >= 0; s--) n = e.data(a[s], this.widgetFullName), n && n !== this && !n.options.disabled && (d.push([e.isFunction(n.options.items) ? n.options.items.call(n.element[0], t, {
                        item: this.currentItem
                    }) : e(n.options.items, n.element), n]), this.containers.push(n));
            for (i = d.length - 1; i >= 0; i--)
                for (r = d[i][1], o = d[i][0], s = 0, l = o.length; l > s; s++) h = e(o[s]), h.data(this.widgetName + "-item", r), u.push({
                    item: h,
                    instance: r,
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0
                })
        },
        refreshPositions: function(t) {
            this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var i, s, a, n;
            for (i = this.items.length - 1; i >= 0; i--) s = this.items[i], s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (a = this.options.toleranceElement ? e(this.options.toleranceElement, s.item) : s.item, t || (s.width = a.outerWidth(), s.height = a.outerHeight()), n = a.offset(), s.left = n.left, s.top = n.top);
            if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
            else
                for (i = this.containers.length - 1; i >= 0; i--) n = this.containers[i].element.offset(), this.containers[i].containerCache.left = n.left, this.containers[i].containerCache.top = n.top, this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
            return this
        },
        _createPlaceholder: function(t) {
            t = t || this;
            var i, s = t.options;
            s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
                element: function() {
                    var s = t.currentItem[0].nodeName.toLowerCase(),
                        a = e("<" + s + ">", t.document[0]).addClass(i || t.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tr" === s ? t.currentItem.children().each(function() {
                        e("<td>&#160;</td>", t.document[0]).attr("colspan", e(this).attr("colspan") || 1).appendTo(a)
                    }) : "img" === s && a.attr("src", t.currentItem.attr("src")), i || a.css("visibility", "hidden"), a
                },
                update: function(e, a) {
                    (!i || s.forcePlaceholderSize) && (a.height() || a.height(t.currentItem.innerHeight() - parseInt(t.currentItem.css("paddingTop") || 0, 10) - parseInt(t.currentItem.css("paddingBottom") || 0, 10)), a.width() || a.width(t.currentItem.innerWidth() - parseInt(t.currentItem.css("paddingLeft") || 0, 10) - parseInt(t.currentItem.css("paddingRight") || 0, 10)))
                }
            }), t.placeholder = e(s.placeholder.element.call(t.element, t.currentItem)), t.currentItem.after(t.placeholder), s.placeholder.update(t, t.placeholder)
        },
        _contactContainers: function(s) {
            var a, n, r, o, h, l, u, d, c, p, f = null,
                m = null;
            for (a = this.containers.length - 1; a >= 0; a--)
                if (!e.contains(this.currentItem[0], this.containers[a].element[0]))
                    if (this._intersectsWith(this.containers[a].containerCache)) {
                        if (f && e.contains(this.containers[a].element[0], f.element[0])) continue;
                        f = this.containers[a], m = a
                    } else this.containers[a].containerCache.over && (this.containers[a]._trigger("out", s, this._uiHash(this)), this.containers[a].containerCache.over = 0);
            if (f)
                if (1 === this.containers.length) this.containers[m].containerCache.over || (this.containers[m]._trigger("over", s, this._uiHash(this)), this.containers[m].containerCache.over = 1);
                else {
                    for (r = 1e4, o = null, p = f.floating || i(this.currentItem), h = p ? "left" : "top", l = p ? "width" : "height", u = this.positionAbs[h] + this.offset.click[h], n = this.items.length - 1; n >= 0; n--) e.contains(this.containers[m].element[0], this.items[n].item[0]) && this.items[n].item[0] !== this.currentItem[0] && (!p || t(this.positionAbs.top + this.offset.click.top, this.items[n].top, this.items[n].height)) && (d = this.items[n].item.offset()[h], c = !1, Math.abs(d - u) > Math.abs(d + this.items[n][l] - u) && (c = !0, d += this.items[n][l]), r > Math.abs(d - u) && (r = Math.abs(d - u), o = this.items[n], this.direction = c ? "up" : "down"));
                    if (!o && !this.options.dropOnEmpty) return;
                    if (this.currentContainer === this.containers[m]) return;
                    o ? this._rearrange(s, o, null, !0) : this._rearrange(s, null, this.containers[m].element, !0), this._trigger("change", s, this._uiHash()), this.containers[m]._trigger("change", s, this._uiHash(this)), this.currentContainer = this.containers[m], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[m]._trigger("over", s, this._uiHash(this)), this.containers[m].containerCache.over = 1
                }
        },
        _createHelper: function(t) {
            var i = this.options,
                s = e.isFunction(i.helper) ? e(i.helper.apply(this.element[0], [t, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
            return s.parents("body").length || e("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), s[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), (!s[0].style.width || i.forceHelperSize) && s.width(this.currentItem.width()), (!s[0].style.height || i.forceHelperSize) && s.height(this.currentItem.height()), s
        },
        _adjustOffsetFromHelper: function(t) {
            "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = {
                left: +t[0],
                top: +t[1] || 0
            }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top)
        },
        _getParentOffset: function() {
            this.offsetParent = this.helper.offsetParent();
            var t = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && e.ui.ie) && (t = {
                top: 0,
                left: 0
            }), {
                top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" === this.cssPosition) {
                var e = this.currentItem.position();
                return {
                    top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {
                top: 0,
                left: 0
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var t, i, s, a = this.options;
            "parent" === a.containment && (a.containment = this.helper[0].parentNode), ("document" === a.containment || "window" === a.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, e("document" === a.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (e("document" === a.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(a.containment) || (t = e(a.containment)[0], i = e(a.containment).offset(), s = "hidden" !== e(t).css("overflow"), this.containment = [i.left + (parseInt(e(t).css("borderLeftWidth"), 10) || 0) + (parseInt(e(t).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(e(t).css("borderTopWidth"), 10) || 0) + (parseInt(e(t).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(t.scrollWidth, t.offsetWidth) : t.offsetWidth) - (parseInt(e(t).css("borderLeftWidth"), 10) || 0) - (parseInt(e(t).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(t.scrollHeight, t.offsetHeight) : t.offsetHeight) - (parseInt(e(t).css("borderTopWidth"), 10) || 0) - (parseInt(e(t).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function(t, i) {
            i || (i = this.position);
            var s = "absolute" === t ? 1 : -1,
                a = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                n = /(html|body)/i.test(a[0].tagName);
            return {
                top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : n ? 0 : a.scrollTop()) * s,
                left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : n ? 0 : a.scrollLeft()) * s
            }
        },
        _generatePosition: function(t) {
            var i, s, a = this.options,
                n = t.pageX,
                r = t.pageY,
                o = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                h = /(html|body)/i.test(o[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (t.pageX - this.offset.click.left < this.containment[0] && (n = this.containment[0] + this.offset.click.left), t.pageY - this.offset.click.top < this.containment[1] && (r = this.containment[1] + this.offset.click.top), t.pageX - this.offset.click.left > this.containment[2] && (n = this.containment[2] + this.offset.click.left), t.pageY - this.offset.click.top > this.containment[3] && (r = this.containment[3] + this.offset.click.top)), a.grid && (i = this.originalPageY + Math.round((r - this.originalPageY) / a.grid[1]) * a.grid[1], r = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - a.grid[1] : i + a.grid[1] : i, s = this.originalPageX + Math.round((n - this.originalPageX) / a.grid[0]) * a.grid[0], n = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - a.grid[0] : s + a.grid[0] : s)), {
                top: r - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : h ? 0 : o.scrollTop()),
                left: n - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : h ? 0 : o.scrollLeft())
            }
        },
        _rearrange: function(e, t, i, s) {
            i ? i[0].appendChild(this.placeholder[0]) : t.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? t.item[0] : t.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var a = this.counter;
            this._delay(function() {
                a === this.counter && this.refreshPositions(!s)
            })
        },
        _clear: function(e, t) {
            function i(e, t, i) {
                return function(s) {
                    i._trigger(e, s, t._uiHash(t))
                }
            }
            this.reverting = !1;
            var s, a = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (s in this._storedCSS)("auto" === this._storedCSS[s] || "static" === this._storedCSS[s]) && (this._storedCSS[s] = "");
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            } else this.currentItem.show();
            for (this.fromOutside && !t && a.push(function(e) {
                    this._trigger("receive", e, this._uiHash(this.fromOutside))
                }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || t || a.push(function(e) {
                    this._trigger("update", e, this._uiHash())
                }), this !== this.currentContainer && (t || (a.push(function(e) {
                    this._trigger("remove", e, this._uiHash())
                }), a.push(function(e) {
                    return function(t) {
                        e._trigger("receive", t, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)), a.push(function(e) {
                    return function(t) {
                        e._trigger("update", t, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) t || a.push(i("deactivate", this, this.containers[s])), this.containers[s].containerCache.over && (a.push(i("out", this, this.containers[s])), this.containers[s].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, this.cancelHelperRemoval) {
                if (!t) {
                    for (this._trigger("beforeStop", e, this._uiHash()), s = 0; a.length > s; s++) a[s].call(this, e);
                    this._trigger("stop", e, this._uiHash())
                }
                return this.fromOutside = !1, !1
            }
            if (t || this._trigger("beforeStop", e, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null, !t) {
                for (s = 0; a.length > s; s++) a[s].call(this, e);
                this._trigger("stop", e, this._uiHash())
            }
            return this.fromOutside = !1, !0
        },
        _trigger: function() {
            e.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()
        },
        _uiHash: function(t) {
            var i = t || this;
            return {
                helper: i.helper,
                placeholder: i.placeholder || e([]),
                position: i.position,
                originalPosition: i.originalPosition,
                offset: i.positionAbs,
                item: i.currentItem,
                sender: t ? t.element : null
            }
        }
    })
})(jQuery);
(function(e, t) {
    var i = "ui-effects-";
    e.effects = {
            effect: {}
        },
        function(e, t) {
            function i(e, t, i) {
                var s = d[t.type] || {};
                return null == e ? i || !t.def ? null : t.def : (e = s.floor ? ~~e : parseFloat(e), isNaN(e) ? t.def : s.mod ? (e + s.mod) % s.mod : 0 > e ? 0 : e > s.max ? s.max : e)
            }

            function s(i) {
                var s = l(),
                    a = s._rgba = [];
                return i = i.toLowerCase(), f(h, function(e, n) {
                    var r, o = n.re.exec(i),
                        h = o && n.parse(o),
                        l = n.space || "rgba";
                    return h ? (r = s[l](h), s[u[l].cache] = r[u[l].cache], a = s._rgba = r._rgba, !1) : t
                }), a.length ? ("0,0,0,0" === a.join() && e.extend(a, n.transparent), s) : n[i]
            }

            function a(e, t, i) {
                return i = (i + 1) % 1, 1 > 6 * i ? e + 6 * (t - e) * i : 1 > 2 * i ? t : 2 > 3 * i ? e + 6 * (t - e) * (2 / 3 - i) : e
            }
            var n, r = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
                o = /^([\-+])=\s*(\d+\.?\d*)/,
                h = [{
                    re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                    parse: function(e) {
                        return [e[1], e[2], e[3], e[4]]
                    }
                }, {
                    re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                    parse: function(e) {
                        return [2.55 * e[1], 2.55 * e[2], 2.55 * e[3], e[4]]
                    }
                }, {
                    re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
                    parse: function(e) {
                        return [parseInt(e[1], 16), parseInt(e[2], 16), parseInt(e[3], 16)]
                    }
                }, {
                    re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
                    parse: function(e) {
                        return [parseInt(e[1] + e[1], 16), parseInt(e[2] + e[2], 16), parseInt(e[3] + e[3], 16)]
                    }
                }, {
                    re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                    space: "hsla",
                    parse: function(e) {
                        return [e[1], e[2] / 100, e[3] / 100, e[4]]
                    }
                }],
                l = e.Color = function(t, i, s, a) {
                    return new e.Color.fn.parse(t, i, s, a)
                },
                u = {
                    rgba: {
                        props: {
                            red: {
                                idx: 0,
                                type: "byte"
                            },
                            green: {
                                idx: 1,
                                type: "byte"
                            },
                            blue: {
                                idx: 2,
                                type: "byte"
                            }
                        }
                    },
                    hsla: {
                        props: {
                            hue: {
                                idx: 0,
                                type: "degrees"
                            },
                            saturation: {
                                idx: 1,
                                type: "percent"
                            },
                            lightness: {
                                idx: 2,
                                type: "percent"
                            }
                        }
                    }
                },
                d = {
                    "byte": {
                        floor: !0,
                        max: 255
                    },
                    percent: {
                        max: 1
                    },
                    degrees: {
                        mod: 360,
                        floor: !0
                    }
                },
                c = l.support = {},
                p = e("<p>")[0],
                f = e.each;
            p.style.cssText = "background-color:rgba(1,1,1,.5)", c.rgba = p.style.backgroundColor.indexOf("rgba") > -1, f(u, function(e, t) {
                t.cache = "_" + e, t.props.alpha = {
                    idx: 3,
                    type: "percent",
                    def: 1
                }
            }), l.fn = e.extend(l.prototype, {
                parse: function(a, r, o, h) {
                    if (a === t) return this._rgba = [null, null, null, null], this;
                    (a.jquery || a.nodeType) && (a = e(a).css(r), r = t);
                    var d = this,
                        c = e.type(a),
                        p = this._rgba = [];
                    return r !== t && (a = [a, r, o, h], c = "array"), "string" === c ? this.parse(s(a) || n._default) : "array" === c ? (f(u.rgba.props, function(e, t) {
                        p[t.idx] = i(a[t.idx], t)
                    }), this) : "object" === c ? (a instanceof l ? f(u, function(e, t) {
                        a[t.cache] && (d[t.cache] = a[t.cache].slice())
                    }) : f(u, function(t, s) {
                        var n = s.cache;
                        f(s.props, function(e, t) {
                            if (!d[n] && s.to) {
                                if ("alpha" === e || null == a[e]) return;
                                d[n] = s.to(d._rgba)
                            }
                            d[n][t.idx] = i(a[e], t, !0)
                        }), d[n] && 0 > e.inArray(null, d[n].slice(0, 3)) && (d[n][3] = 1, s.from && (d._rgba = s.from(d[n])))
                    }), this) : t
                },
                is: function(e) {
                    var i = l(e),
                        s = !0,
                        a = this;
                    return f(u, function(e, n) {
                        var r, o = i[n.cache];
                        return o && (r = a[n.cache] || n.to && n.to(a._rgba) || [], f(n.props, function(e, i) {
                            return null != o[i.idx] ? s = o[i.idx] === r[i.idx] : t
                        })), s
                    }), s
                },
                _space: function() {
                    var e = [],
                        t = this;
                    return f(u, function(i, s) {
                        t[s.cache] && e.push(i)
                    }), e.pop()
                },
                transition: function(e, t) {
                    var s = l(e),
                        a = s._space(),
                        n = u[a],
                        r = 0 === this.alpha() ? l("transparent") : this,
                        o = r[n.cache] || n.to(r._rgba),
                        h = o.slice();
                    return s = s[n.cache], f(n.props, function(e, a) {
                        var n = a.idx,
                            r = o[n],
                            l = s[n],
                            u = d[a.type] || {};
                        null !== l && (null === r ? h[n] = l : (u.mod && (l - r > u.mod / 2 ? r += u.mod : r - l > u.mod / 2 && (r -= u.mod)), h[n] = i((l - r) * t + r, a)))
                    }), this[a](h)
                },
                blend: function(t) {
                    if (1 === this._rgba[3]) return this;
                    var i = this._rgba.slice(),
                        s = i.pop(),
                        a = l(t)._rgba;
                    return l(e.map(i, function(e, t) {
                        return (1 - s) * a[t] + s * e
                    }))
                },
                toRgbaString: function() {
                    var t = "rgba(",
                        i = e.map(this._rgba, function(e, t) {
                            return null == e ? t > 2 ? 1 : 0 : e
                        });
                    return 1 === i[3] && (i.pop(), t = "rgb("), t + i.join() + ")"
                },
                toHslaString: function() {
                    var t = "hsla(",
                        i = e.map(this.hsla(), function(e, t) {
                            return null == e && (e = t > 2 ? 1 : 0), t && 3 > t && (e = Math.round(100 * e) + "%"), e
                        });
                    return 1 === i[3] && (i.pop(), t = "hsl("), t + i.join() + ")"
                },
                toHexString: function(t) {
                    var i = this._rgba.slice(),
                        s = i.pop();
                    return t && i.push(~~(255 * s)), "#" + e.map(i, function(e) {
                        return e = (e || 0).toString(16), 1 === e.length ? "0" + e : e
                    }).join("")
                },
                toString: function() {
                    return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
                }
            }), l.fn.parse.prototype = l.fn, u.hsla.to = function(e) {
                if (null == e[0] || null == e[1] || null == e[2]) return [null, null, null, e[3]];
                var t, i, s = e[0] / 255,
                    a = e[1] / 255,
                    n = e[2] / 255,
                    r = e[3],
                    o = Math.max(s, a, n),
                    h = Math.min(s, a, n),
                    l = o - h,
                    u = o + h,
                    d = .5 * u;
                return t = h === o ? 0 : s === o ? 60 * (a - n) / l + 360 : a === o ? 60 * (n - s) / l + 120 : 60 * (s - a) / l + 240, i = 0 === l ? 0 : .5 >= d ? l / u : l / (2 - u), [Math.round(t) % 360, i, d, null == r ? 1 : r]
            }, u.hsla.from = function(e) {
                if (null == e[0] || null == e[1] || null == e[2]) return [null, null, null, e[3]];
                var t = e[0] / 360,
                    i = e[1],
                    s = e[2],
                    n = e[3],
                    r = .5 >= s ? s * (1 + i) : s + i - s * i,
                    o = 2 * s - r;
                return [Math.round(255 * a(o, r, t + 1 / 3)), Math.round(255 * a(o, r, t)), Math.round(255 * a(o, r, t - 1 / 3)), n]
            }, f(u, function(s, a) {
                var n = a.props,
                    r = a.cache,
                    h = a.to,
                    u = a.from;
                l.fn[s] = function(s) {
                    if (h && !this[r] && (this[r] = h(this._rgba)), s === t) return this[r].slice();
                    var a, o = e.type(s),
                        d = "array" === o || "object" === o ? s : arguments,
                        c = this[r].slice();
                    return f(n, function(e, t) {
                        var s = d["object" === o ? e : t.idx];
                        null == s && (s = c[t.idx]), c[t.idx] = i(s, t)
                    }), u ? (a = l(u(c)), a[r] = c, a) : l(c)
                }, f(n, function(t, i) {
                    l.fn[t] || (l.fn[t] = function(a) {
                        var n, r = e.type(a),
                            h = "alpha" === t ? this._hsla ? "hsla" : "rgba" : s,
                            l = this[h](),
                            u = l[i.idx];
                        return "undefined" === r ? u : ("function" === r && (a = a.call(this, u), r = e.type(a)), null == a && i.empty ? this : ("string" === r && (n = o.exec(a), n && (a = u + parseFloat(n[2]) * ("+" === n[1] ? 1 : -1))), l[i.idx] = a, this[h](l)))
                    })
                })
            }), l.hook = function(t) {
                var i = t.split(" ");
                f(i, function(t, i) {
                    e.cssHooks[i] = {
                        set: function(t, a) {
                            var n, r, o = "";
                            if ("transparent" !== a && ("string" !== e.type(a) || (n = s(a)))) {
                                if (a = l(n || a), !c.rgba && 1 !== a._rgba[3]) {
                                    for (r = "backgroundColor" === i ? t.parentNode : t;
                                        ("" === o || "transparent" === o) && r && r.style;) try {
                                        o = e.css(r, "backgroundColor"), r = r.parentNode
                                    } catch (h) {}
                                    a = a.blend(o && "transparent" !== o ? o : "_default")
                                }
                                a = a.toRgbaString()
                            }
                            try {
                                t.style[i] = a
                            } catch (h) {}
                        }
                    }, e.fx.step[i] = function(t) {
                        t.colorInit || (t.start = l(t.elem, i), t.end = l(t.end), t.colorInit = !0), e.cssHooks[i].set(t.elem, t.start.transition(t.end, t.pos))
                    }
                })
            }, l.hook(r), e.cssHooks.borderColor = {
                expand: function(e) {
                    var t = {};
                    return f(["Top", "Right", "Bottom", "Left"], function(i, s) {
                        t["border" + s + "Color"] = e
                    }), t
                }
            }, n = e.Color.names = {
                aqua: "#00ffff",
                black: "#000000",
                blue: "#0000ff",
                fuchsia: "#ff00ff",
                gray: "#808080",
                green: "#008000",
                lime: "#00ff00",
                maroon: "#800000",
                navy: "#000080",
                olive: "#808000",
                purple: "#800080",
                red: "#ff0000",
                silver: "#c0c0c0",
                teal: "#008080",
                white: "#ffffff",
                yellow: "#ffff00",
                transparent: [null, null, null, 0],
                _default: "#ffffff"
            }
        }(jQuery),
        function() {
            function i(t) {
                var i, s, a = t.ownerDocument.defaultView ? t.ownerDocument.defaultView.getComputedStyle(t, null) : t.currentStyle,
                    n = {};
                if (a && a.length && a[0] && a[a[0]])
                    for (s = a.length; s--;) i = a[s], "string" == typeof a[i] && (n[e.camelCase(i)] = a[i]);
                else
                    for (i in a) "string" == typeof a[i] && (n[i] = a[i]);
                return n
            }

            function s(t, i) {
                var s, a, r = {};
                for (s in i) a = i[s], t[s] !== a && (n[s] || (e.fx.step[s] || !isNaN(parseFloat(a))) && (r[s] = a));
                return r
            }
            var a = ["add", "remove", "toggle"],
                n = {
                    border: 1,
                    borderBottom: 1,
                    borderColor: 1,
                    borderLeft: 1,
                    borderRight: 1,
                    borderTop: 1,
                    borderWidth: 1,
                    margin: 1,
                    padding: 1
                };
            e.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function(t, i) {
                e.fx.step[i] = function(e) {
                    ("none" !== e.end && !e.setAttr || 1 === e.pos && !e.setAttr) && (jQuery.style(e.elem, i, e.end), e.setAttr = !0)
                }
            }), e.fn.addBack || (e.fn.addBack = function(e) {
                return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
            }), e.effects.animateClass = function(t, n, r, o) {
                var h = e.speed(n, r, o);
                return this.queue(function() {
                    var n, r = e(this),
                        o = r.attr("class") || "",
                        l = h.children ? r.find("*").addBack() : r;
                    l = l.map(function() {
                        var t = e(this);
                        return {
                            el: t,
                            start: i(this)
                        }
                    }), n = function() {
                        e.each(a, function(e, i) {
                            t[i] && r[i + "Class"](t[i])
                        })
                    }, n(), l = l.map(function() {
                        return this.end = i(this.el[0]), this.diff = s(this.start, this.end), this
                    }), r.attr("class", o), l = l.map(function() {
                        var t = this,
                            i = e.Deferred(),
                            s = e.extend({}, h, {
                                queue: !1,
                                complete: function() {
                                    i.resolve(t)
                                }
                            });
                        return this.el.animate(this.diff, s), i.promise()
                    }), e.when.apply(e, l.get()).done(function() {
                        n(), e.each(arguments, function() {
                            var t = this.el;
                            e.each(this.diff, function(e) {
                                t.css(e, "")
                            })
                        }), h.complete.call(r[0])
                    })
                })
            }, e.fn.extend({
                addClass: function(t) {
                    return function(i, s, a, n) {
                        return s ? e.effects.animateClass.call(this, {
                            add: i
                        }, s, a, n) : t.apply(this, arguments)
                    }
                }(e.fn.addClass),
                removeClass: function(t) {
                    return function(i, s, a, n) {
                        return arguments.length > 1 ? e.effects.animateClass.call(this, {
                            remove: i
                        }, s, a, n) : t.apply(this, arguments)
                    }
                }(e.fn.removeClass),
                toggleClass: function(i) {
                    return function(s, a, n, r, o) {
                        return "boolean" == typeof a || a === t ? n ? e.effects.animateClass.call(this, a ? {
                            add: s
                        } : {
                            remove: s
                        }, n, r, o) : i.apply(this, arguments) : e.effects.animateClass.call(this, {
                            toggle: s
                        }, a, n, r)
                    }
                }(e.fn.toggleClass),
                switchClass: function(t, i, s, a, n) {
                    return e.effects.animateClass.call(this, {
                        add: i,
                        remove: t
                    }, s, a, n)
                }
            })
        }(),
        function() {
            function s(t, i, s, a) {
                return e.isPlainObject(t) && (i = t, t = t.effect), t = {
                    effect: t
                }, null == i && (i = {}), e.isFunction(i) && (a = i, s = null, i = {}), ("number" == typeof i || e.fx.speeds[i]) && (a = s, s = i, i = {}), e.isFunction(s) && (a = s, s = null), i && e.extend(t, i), s = s || i.duration, t.duration = e.fx.off ? 0 : "number" == typeof s ? s : s in e.fx.speeds ? e.fx.speeds[s] : e.fx.speeds._default, t.complete = a || i.complete, t
            }

            function a(t) {
                return !t || "number" == typeof t || e.fx.speeds[t] ? !0 : "string" != typeof t || e.effects.effect[t] ? e.isFunction(t) ? !0 : "object" != typeof t || t.effect ? !1 : !0 : !0
            }
            e.extend(e.effects, {
                version: "1.10.4",
                save: function(e, t) {
                    for (var s = 0; t.length > s; s++) null !== t[s] && e.data(i + t[s], e[0].style[t[s]])
                },
                restore: function(e, s) {
                    var a, n;
                    for (n = 0; s.length > n; n++) null !== s[n] && (a = e.data(i + s[n]), a === t && (a = ""), e.css(s[n], a))
                },
                setMode: function(e, t) {
                    return "toggle" === t && (t = e.is(":hidden") ? "show" : "hide"), t
                },
                getBaseline: function(e, t) {
                    var i, s;
                    switch (e[0]) {
                        case "top":
                            i = 0;
                            break;
                        case "middle":
                            i = .5;
                            break;
                        case "bottom":
                            i = 1;
                            break;
                        default:
                            i = e[0] / t.height
                    }
                    switch (e[1]) {
                        case "left":
                            s = 0;
                            break;
                        case "center":
                            s = .5;
                            break;
                        case "right":
                            s = 1;
                            break;
                        default:
                            s = e[1] / t.width
                    }
                    return {
                        x: s,
                        y: i
                    }
                },
                createWrapper: function(t) {
                    if (t.parent().is(".ui-effects-wrapper")) return t.parent();
                    var i = {
                            width: t.outerWidth(!0),
                            height: t.outerHeight(!0),
                            "float": t.css("float")
                        },
                        s = e("<div></div>").addClass("ui-effects-wrapper").css({
                            fontSize: "100%",
                            background: "transparent",
                            border: "none",
                            margin: 0,
                            padding: 0
                        }),
                        a = {
                            width: t.width(),
                            height: t.height()
                        },
                        n = document.activeElement;
                    try {
                        n.id
                    } catch (r) {
                        n = document.body
                    }
                    return t.wrap(s), (t[0] === n || e.contains(t[0], n)) && e(n).focus(), s = t.parent(), "static" === t.css("position") ? (s.css({
                        position: "relative"
                    }), t.css({
                        position: "relative"
                    })) : (e.extend(i, {
                        position: t.css("position"),
                        zIndex: t.css("z-index")
                    }), e.each(["top", "left", "bottom", "right"], function(e, s) {
                        i[s] = t.css(s), isNaN(parseInt(i[s], 10)) && (i[s] = "auto")
                    }), t.css({
                        position: "relative",
                        top: 0,
                        left: 0,
                        right: "auto",
                        bottom: "auto"
                    })), t.css(a), s.css(i).show()
                },
                removeWrapper: function(t) {
                    var i = document.activeElement;
                    return t.parent().is(".ui-effects-wrapper") && (t.parent().replaceWith(t), (t[0] === i || e.contains(t[0], i)) && e(i).focus()), t
                },
                setTransition: function(t, i, s, a) {
                    return a = a || {}, e.each(i, function(e, i) {
                        var n = t.cssUnit(i);
                        n[0] > 0 && (a[i] = n[0] * s + n[1])
                    }), a
                }
            }), e.fn.extend({
                effect: function() {
                    function t(t) {
                        function s() {
                            e.isFunction(n) && n.call(a[0]), e.isFunction(t) && t()
                        }
                        var a = e(this),
                            n = i.complete,
                            o = i.mode;
                        (a.is(":hidden") ? "hide" === o : "show" === o) ? (a[o](), s()) : r.call(a[0], i, s)
                    }
                    var i = s.apply(this, arguments),
                        a = i.mode,
                        n = i.queue,
                        r = e.effects.effect[i.effect];
                    return e.fx.off || !r ? a ? this[a](i.duration, i.complete) : this.each(function() {
                        i.complete && i.complete.call(this)
                    }) : n === !1 ? this.each(t) : this.queue(n || "fx", t)
                },
                show: function(e) {
                    return function(t) {
                        if (a(t)) return e.apply(this, arguments);
                        var i = s.apply(this, arguments);
                        return i.mode = "show", this.effect.call(this, i)
                    }
                }(e.fn.show),
                hide: function(e) {
                    return function(t) {
                        if (a(t)) return e.apply(this, arguments);
                        var i = s.apply(this, arguments);
                        return i.mode = "hide", this.effect.call(this, i)
                    }
                }(e.fn.hide),
                toggle: function(e) {
                    return function(t) {
                        if (a(t) || "boolean" == typeof t) return e.apply(this, arguments);
                        var i = s.apply(this, arguments);
                        return i.mode = "toggle", this.effect.call(this, i)
                    }
                }(e.fn.toggle),
                cssUnit: function(t) {
                    var i = this.css(t),
                        s = [];
                    return e.each(["em", "px", "%", "pt"], function(e, t) {
                        i.indexOf(t) > 0 && (s = [parseFloat(i), t])
                    }), s
                }
            })
        }(),
        function() {
            var t = {};
            e.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function(e, i) {
                t[i] = function(t) {
                    return Math.pow(t, e + 2)
                }
            }), e.extend(t, {
                Sine: function(e) {
                    return 1 - Math.cos(e * Math.PI / 2)
                },
                Circ: function(e) {
                    return 1 - Math.sqrt(1 - e * e)
                },
                Elastic: function(e) {
                    return 0 === e || 1 === e ? e : -Math.pow(2, 8 * (e - 1)) * Math.sin((80 * (e - 1) - 7.5) * Math.PI / 15)
                },
                Back: function(e) {
                    return e * e * (3 * e - 2)
                },
                Bounce: function(e) {
                    for (var t, i = 4;
                        ((t = Math.pow(2, --i)) - 1) / 11 > e;);
                    return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * t - 2) / 22 - e, 2)
                }
            }), e.each(t, function(t, i) {
                e.easing["easeIn" + t] = i, e.easing["easeOut" + t] = function(e) {
                    return 1 - i(1 - e)
                }, e.easing["easeInOut" + t] = function(e) {
                    return .5 > e ? i(2 * e) / 2 : 1 - i(-2 * e + 2) / 2
                }
            })
        }()
})(jQuery);
(function(e) {
    e.effects.effect.bounce = function(t, i) {
        var s, a, n, r = e(this),
            o = ["position", "top", "bottom", "left", "right", "height", "width"],
            l = e.effects.setMode(r, t.mode || "effect"),
            h = "hide" === l,
            u = "show" === l,
            d = t.direction || "up",
            c = t.distance,
            p = t.times || 5,
            m = 2 * p + (u || h ? 1 : 0),
            f = t.duration / m,
            g = t.easing,
            v = "up" === d || "down" === d ? "top" : "left",
            y = "up" === d || "left" === d,
            b = r.queue(),
            _ = b.length;
        for ((u || h) && o.push("opacity"), e.effects.save(r, o), r.show(), e.effects.createWrapper(r), c || (c = r["top" === v ? "outerHeight" : "outerWidth"]() / 3), u && (n = {
                opacity: 1
            }, n[v] = 0, r.css("opacity", 0).css(v, y ? 2 * -c : 2 * c).animate(n, f, g)), h && (c /= Math.pow(2, p - 1)), n = {}, n[v] = 0, s = 0; p > s; s++) a = {}, a[v] = (y ? "-=" : "+=") + c, r.animate(a, f, g).animate(n, f, g), c = h ? 2 * c : c / 2;
        h && (a = {
            opacity: 0
        }, a[v] = (y ? "-=" : "+=") + c, r.animate(a, f, g)), r.queue(function() {
            h && r.hide(), e.effects.restore(r, o), e.effects.removeWrapper(r), i()
        }), _ > 1 && b.splice.apply(b, [1, 0].concat(b.splice(_, m + 1))), r.dequeue()
    }
})(jQuery);
(function(e) {
    e.effects.effect.drop = function(t, i) {
        var s, a = e(this),
            n = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
            r = e.effects.setMode(a, t.mode || "hide"),
            o = "show" === r,
            h = t.direction || "left",
            l = "up" === h || "down" === h ? "top" : "left",
            u = "up" === h || "left" === h ? "pos" : "neg",
            d = {
                opacity: o ? 1 : 0
            };
        e.effects.save(a, n), a.show(), e.effects.createWrapper(a), s = t.distance || a["top" === l ? "outerHeight" : "outerWidth"](!0) / 2, o && a.css("opacity", 0).css(l, "pos" === u ? -s : s), d[l] = (o ? "pos" === u ? "+=" : "-=" : "pos" === u ? "-=" : "+=") + s, a.animate(d, {
            queue: !1,
            duration: t.duration,
            easing: t.easing,
            complete: function() {
                "hide" === r && a.hide(), e.effects.restore(a, n), e.effects.removeWrapper(a), i()
            }
        })
    }
})(jQuery);
(function(e) {
    e.effects.effect.shake = function(t, i) {
        var s, a = e(this),
            n = ["position", "top", "bottom", "left", "right", "height", "width"],
            r = e.effects.setMode(a, t.mode || "effect"),
            o = t.direction || "left",
            h = t.distance || 20,
            l = t.times || 3,
            u = 2 * l + 1,
            d = Math.round(t.duration / u),
            c = "up" === o || "down" === o ? "top" : "left",
            p = "up" === o || "left" === o,
            f = {},
            m = {},
            g = {},
            v = a.queue(),
            y = v.length;
        for (e.effects.save(a, n), a.show(), e.effects.createWrapper(a), f[c] = (p ? "-=" : "+=") + h, m[c] = (p ? "+=" : "-=") + 2 * h, g[c] = (p ? "-=" : "+=") + 2 * h, a.animate(f, d, t.easing), s = 1; l > s; s++) a.animate(m, d, t.easing).animate(g, d, t.easing);
        a.animate(m, d, t.easing).animate(f, d / 2, t.easing).queue(function() {
            "hide" === r && a.hide(), e.effects.restore(a, n), e.effects.removeWrapper(a), i()
        }), y > 1 && v.splice.apply(v, [1, 0].concat(v.splice(y, u + 1))), a.dequeue()
    }
})(jQuery);;
(function(f) {
    function C(a, c, d) {
        var b = a[0],
            e = /er/.test(d) ? k : /bl/.test(d) ? u : j;
        active = d == E ? {
            checked: b[j],
            disabled: b[u],
            indeterminate: "true" == a.attr(k) || "false" == a.attr(v)
        } : b[e];
        if (/^(ch|di|in)/.test(d) && !active) p(a, e);
        else if (/^(un|en|de)/.test(d) && active) w(a, e);
        else if (d == E)
            for (var e in active) active[e] ? p(a, e, !0) : w(a, e, !0);
        else if (!c || "toggle" == d) {
            if (!c) a[r]("ifClicked");
            active ? b[l] !== x && w(a, e) : p(a, e)
        }
    }

    function p(a, c, d) {
        var b = a[0],
            e = a.parent(),
            g = c == j,
            H = c == k,
            m = H ? v : g ? I : "enabled",
            r = h(b, m + y(b[l])),
            L = h(b,
                c + y(b[l]));
        if (!0 !== b[c]) {
            if (!d && c == j && b[l] == x && b.name) {
                var p = a.closest("form"),
                    s = 'input[name="' + b.name + '"]',
                    s = p.length ? p.find(s) : f(s);
                s.each(function() {
                    this !== b && f.data(this, n) && w(f(this), c)
                })
            }
            H ? (b[c] = !0, b[j] && w(a, j, "force")) : (d || (b[c] = !0), g && b[k] && w(a, k, !1));
            J(a, g, c, d)
        }
        b[u] && h(b, z, !0) && e.find("." + F).css(z, "default");
        e[t](L || h(b, c));
        e[A](r || h(b, m) || "")
    }

    function w(a, c, d) {
        var b = a[0],
            e = a.parent(),
            g = c == j,
            f = c == k,
            m = f ? v : g ? I : "enabled",
            n = h(b, m + y(b[l])),
            p = h(b, c + y(b[l]));
        if (!1 !== b[c]) {
            if (f || !d || "force" == d) b[c] = !1;
            J(a, g, m, d)
        }!b[u] && h(b, z, !0) && e.find("." + F).css(z, "pointer");
        e[A](p || h(b, c) || "");
        e[t](n || h(b, m))
    }

    function K(a, c) {
        if (f.data(a, n)) {
            var d = f(a);
            d.parent().html(d.attr("style", f.data(a, n).s || "")[r](c || ""));
            d.off(".i").unwrap();
            f(D + '[for="' + a.id + '"]').add(d.closest(D)).off(".i")
        }
    }

    function h(a, c, d) {
        if (f.data(a, n)) return f.data(a, n).o[c + (d ? "" : "Class")]
    }

    function y(a) {
        return a.charAt(0).toUpperCase() + a.slice(1)
    }

    function J(a, c, d, b) {
        if (!b) {
            if (c) a[r]("ifToggled");
            a[r]("ifChanged")[r]("if" + y(d))
        }
    }
    var n = "iCheck",
        F = n + "-helper",
        x = "radio",
        j = "checked",
        I = "un" + j,
        u = "disabled",
        v = "determinate",
        k = "in" + v,
        E = "update",
        l = "type",
        t = "addClass",
        A = "removeClass",
        r = "trigger",
        D = "label",
        z = "cursor",
        G = /ipad|iphone|ipod|android|blackberry|windows phone|opera mini/i.test(navigator.userAgent);
    f.fn[n] = function(a, c) {
        var d = ":checkbox, :" + x,
            b = f(),
            e = function(a) {
                a.each(function() {
                    var a = f(this);
                    b = a.is(d) ? b.add(a) : b.add(a.find(d))
                })
            };
        if (/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a)) return a = a.toLowerCase(),
            e(this), b.each(function() {
                "destroy" == a ? K(this, "ifDestroyed") : C(f(this), !0, a);
                f.isFunction(c) && c()
            });
        if ("object" == typeof a || !a) {
            var g = f.extend({
                    checkedClass: j,
                    disabledClass: u,
                    indeterminateClass: k,
                    labelHover: !0
                }, a),
                h = g.handle,
                m = g.hoverClass || "hover",
                y = g.focusClass || "focus",
                v = g.activeClass || "active",
                z = !!g.labelHover,
                s = g.labelHoverClass || "hover",
                B = ("" + g.increaseArea).replace("%", "") | 0;
            if ("checkbox" == h || h == x) d = ":" + h; - 50 > B && (B = -50);
            e(this);
            return b.each(function() {
                K(this);
                var a = f(this),
                    b = this,
                    c = b.id,
                    d = -B + "%",
                    e = 100 + 2 * B + "%",
                    e = {
                        position: "absolute",
                        top: d,
                        left: d,
                        display: "block",
                        width: e,
                        height: e,
                        margin: 0,
                        padding: 0,
                        background: "#fff",
                        border: 0,
                        opacity: 0
                    },
                    d = G ? {
                        position: "absolute",
                        visibility: "hidden"
                    } : B ? e : {
                        position: "absolute",
                        opacity: 0
                    },
                    h = "checkbox" == b[l] ? g.checkboxClass || "icheckbox" : g.radioClass || "i" + x,
                    k = f(D + '[for="' + c + '"]').add(a.closest(D)),
                    q = a.wrap('<div class="' + h + '"/>')[r]("ifCreated").parent().append(g.insert),
                    e = f('<ins class="' + F + '"/>').css(e).appendTo(q);
                a.data(n, {
                    o: g,
                    s: a.attr("style")
                }).css(d);
                g.inheritClass && q[t](b.className);
                g.inheritID && c && q.attr("id", n + "-" + c);
                "static" == q.css("position") && q.css("position", "relative");
                C(a, !0, E);
                if (k.length) k.on("click.i mouseenter.i mouseleave.i touchbegin.i touchend.i", function(c) {
                    var d = c[l],
                        e = f(this);
                    if (!b[u])
                        if ("click" == d ? C(a, !1, !0) : z && (/ve|nd/.test(d) ? (q[A](m), e[A](s)) : (q[t](m), e[t](s))), G) c.stopPropagation();
                        else return !1
                });
                a.on("click.i focus.i blur.i keyup.i keydown.i keypress.i", function(c) {
                    var d = c[l];
                    c = c.keyCode;
                    if ("click" == d) return !1;
                    if ("keydown" ==
                        d && 32 == c) return b[l] == x && b[j] || (b[j] ? w(a, j) : p(a, j)), !1;
                    if ("keyup" == d && b[l] == x) !b[j] && p(a, j);
                    else if (/us|ur/.test(d)) q["blur" == d ? A : t](y)
                });
                e.on("click mousedown mouseup mouseover mouseout touchbegin.i touchend.i", function(d) {
                    var c = d[l],
                        e = /wn|up/.test(c) ? v : m;
                    if (!b[u]) {
                        if ("click" == c) C(a, !1, !0);
                        else {
                            if (/wn|er|in/.test(c)) q[t](e);
                            else q[A](e + " " + v);
                            if (k.length && z && e == m) k[/ut|nd/.test(c) ? A : t](s)
                        }
                        if (G) d.stopPropagation();
                        else return !1
                    }
                })
            })
        }
        return this
    }
})(jQuery);; + function(a) {
    "use strict";
    var b = function(b, c) {
        this.options = c, this.$element = a(b), this.$backdrop = this.isShown = null, this.options.remote && this.$element.load(this.options.remote)
    };
    b.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, b.prototype.toggle = function(a) {
        return this[this.isShown ? "hide" : "show"](a)
    }, b.prototype.show = function(b) {
        var c = this,
            d = a.Event("show.bs.modal", {
                relatedTarget: b
            });
        this.$element.trigger(d);
        if (this.isShown || d.isDefaultPrevented()) return;
        this.isShown = !0, this.escape(), this.$element.on("click.dismiss.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.backdrop(function() {
            var d = a.support.transition && c.$element.hasClass("fade");
            c.$element.parent().length || c.$element.appendTo(document.body), c.$element.show(), d && c.$element[0].offsetWidth, c.$element.addClass("in").attr("aria-hidden", !1), c.enforceFocus();
            var e = a.Event("shown.bs.modal", {
                relatedTarget: b
            });
            d ? c.$element.find(".modal-dialog").one(a.support.transition.end, function() {
                c.$element.focus().trigger(e)
            }).emulateTransitionEnd(300) : c.$element.focus().trigger(e)
        })
    }, b.prototype.hide = function(b) {
        b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b);
        if (!this.isShown || b.isDefaultPrevented()) return;
        this.isShown = !1, this.escape(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one(a.support.transition.end, a.proxy(this.hideModal, this)).emulateTransitionEnd(300) : this.hideModal()
    }, b.prototype.enforceFocus = function() {
        a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function(a) {
            this.$element[0] !== a.target && !this.$element.has(a.target).length && this.$element.focus()
        }, this))
    }, b.prototype.escape = function() {
        this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", a.proxy(function(a) {
            a.which == 27 && this.hide()
        }, this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal")
    }, b.prototype.hideModal = function() {
        var a = this;
        this.$element.hide(), this.backdrop(function() {
            a.removeBackdrop(), a.$element.trigger("hidden.bs.modal")
        })
    }, b.prototype.removeBackdrop = function() {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, b.prototype.backdrop = function(b) {
        var c = this,
            d = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var e = a.support.transition && d;
            this.$backdrop = a('<div class="modal-backdrop ' + d + '" />').appendTo(document.body), this.$element.on("click.dismiss.modal", a.proxy(function(a) {
                if (a.target !== a.currentTarget) return;
                this.options.backdrop == "static" ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this)
            }, this)), e && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in");
            if (!b) return;
            e ? this.$backdrop.one(a.support.transition.end, b).emulateTransitionEnd(150) : b()
        } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(a.support.transition.end, b).emulateTransitionEnd(150) : b()) : b && b()
    };
    var c = a.fn.modal;
    a.fn.modal = function(c, d) {
        return this.each(function() {
            var e = a(this),
                f = e.data("bs.modal"),
                g = a.extend({}, b.DEFAULTS, e.data(), typeof c == "object" && c);
            f || e.data("bs.modal", f = new b(this, g)), typeof c == "string" ? f[c](d) : g.show && f.show(d)
        })
    }, a.fn.modal.Constructor = b, a.fn.modal.noConflict = function() {
        return a.fn.modal = c, this
    }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(b) {
        var c = a(this),
            d = c.attr("href"),
            e = a(c.attr("data-target") || d && d.replace(/.*(?=#[^\s]+$)/, "")),
            f = e.data("modal") ? "toggle" : a.extend({
                remote: !/#/.test(d) && d
            }, e.data(), c.data());
        b.preventDefault(), e.modal(f, this).one("hide", function() {
            c.is(":visible") && c.focus()
        })
    }), a(document).on("show.bs.modal", ".modal", function() {
        a(document.body).addClass("modal-open")
    }).on("hidden.bs.modal", ".modal", function() {
        a(document.body).removeClass("modal-open")
    })
}(jQuery);
(function(t) {
    "use strict";

    function e(t, e, r) {
        return t.addEventListener ? t.addEventListener(e, r, !1) : t.attachEvent ? t.attachEvent("on" + e, r) : void 0
    }

    function r(t, e) {
        var r, n;
        for (r = 0, n = t.length; n > r; r++)
            if (t[r] === e) return !0;
        return !1
    }

    function n(t, e) {
        var r;
        t.createTextRange ? (r = t.createTextRange(), r.move("character", e), r.select()) : t.selectionStart && (t.focus(), t.setSelectionRange(e, e))
    }

    function a(t, e) {
        try {
            return t.type = e, !0
        } catch (r) {
            return !1
        }
    }
    t.Placeholders = {
        Utils: {
            addEventListener: e,
            inArray: r,
            moveCaret: n,
            changeType: a
        }
    }
})(this),
function(t) {
    "use strict";

    function e() {}

    function r() {
        try {
            return document.activeElement
        } catch (t) {}
    }

    function n(t, e) {
        var r, n, a = !!e && t.value !== e,
            u = t.value === t.getAttribute(V);
        return (a || u) && "true" === t.getAttribute(P) ? (t.removeAttribute(P), t.value = t.value.replace(t.getAttribute(V), ""), t.className = t.className.replace(R, ""), n = t.getAttribute(z), parseInt(n, 10) >= 0 && (t.setAttribute("maxLength", n), t.removeAttribute(z)), r = t.getAttribute(D), r && (t.type = r), !0) : !1
    }

    function a(t) {
        var e, r, n = t.getAttribute(V);
        return "" === t.value && n ? (t.setAttribute(P, "true"), t.value = n, t.className += " " + I, r = t.getAttribute(z), r || (t.setAttribute(z, t.maxLength), t.removeAttribute("maxLength")), e = t.getAttribute(D), e ? t.type = "text" : "password" === t.type && K.changeType(t, "text") && t.setAttribute(D, "password"), !0) : !1
    }

    function u(t, e) {
        var r, n, a, u, i, l, o;
        if (t && t.getAttribute(V)) e(t);
        else
            for (a = t ? t.getElementsByTagName("input") : f, u = t ? t.getElementsByTagName("textarea") : h, r = a ? a.length : 0, n = u ? u.length : 0, o = 0, l = r + n; l > o; o++) i = r > o ? a[o] : u[o - r], e(i)
    }

    function i(t) {
        u(t, n)
    }

    function l(t) {
        u(t, a)
    }

    function o(t) {
        return function() {
            b && t.value === t.getAttribute(V) && "true" === t.getAttribute(P) ? K.moveCaret(t, 0) : n(t)
        }
    }

    function c(t) {
        return function() {
            a(t)
        }
    }

    function s(t) {
        return function(e) {
            return A = t.value, "true" === t.getAttribute(P) && A === t.getAttribute(V) && K.inArray(C, e.keyCode) ? (e.preventDefault && e.preventDefault(), !1) : void 0
        }
    }

    function d(t) {
        return function() {
            n(t, A), "" === t.value && (t.blur(), K.moveCaret(t, 0))
        }
    }

    function v(t) {
        return function() {
            t === r() && t.value === t.getAttribute(V) && "true" === t.getAttribute(P) && K.moveCaret(t, 0)
        }
    }

    function g(t) {
        return function() {
            i(t)
        }
    }

    function p(t) {
        t.form && (T = t.form, "string" == typeof T && (T = document.getElementById(T)), T.getAttribute(U) || (K.addEventListener(T, "submit", g(T)), T.setAttribute(U, "true"))), K.addEventListener(t, "focus", o(t)), K.addEventListener(t, "blur", c(t)), b && (K.addEventListener(t, "keydown", s(t)), K.addEventListener(t, "keyup", d(t)), K.addEventListener(t, "click", v(t))), t.setAttribute(j, "true"), t.setAttribute(V, x), (b || t !== r()) && a(t)
    }
    var f, h, b, m, A, y, E, x, L, T, S, N, w, B = ["text", "search", "url", "tel", "email", "password", "number", "textarea"],
        C = [27, 33, 34, 35, 36, 37, 38, 39, 40, 8, 46],
        k = "#ccc",
        I = "placeholdersjs",
        R = RegExp("(?:^|\\s)" + I + "(?!\\S)"),
        V = "data-placeholder-value",
        P = "data-placeholder-active",
        D = "data-placeholder-type",
        U = "data-placeholder-submit",
        j = "data-placeholder-bound",
        q = "data-placeholder-focus",
        Q = "data-placeholder-live",
        z = "data-placeholder-maxlength",
        F = document.createElement("input"),
        G = document.getElementsByTagName("head")[0],
        H = document.documentElement,
        J = t.Placeholders,
        K = J.Utils;
    if (J.nativeSupport = void 0 !== F.placeholder, !J.nativeSupport) {
        for (f = document.getElementsByTagName("input"), h = document.getElementsByTagName("textarea"), b = "false" === H.getAttribute(q), m = "false" !== H.getAttribute(Q), y = document.createElement("style"), y.type = "text/css", E = document.createTextNode("." + I + " { color:" + k + "; }"), y.styleSheet ? y.styleSheet.cssText = E.nodeValue : y.appendChild(E), G.insertBefore(y, G.firstChild), w = 0, N = f.length + h.length; N > w; w++) S = f.length > w ? f[w] : h[w - f.length], x = S.attributes.placeholder, x && (x = x.nodeValue, x && K.inArray(B, S.type) && p(S));
        L = setInterval(function() {
            for (w = 0, N = f.length + h.length; N > w; w++) S = f.length > w ? f[w] : h[w - f.length], x = S.attributes.placeholder, x ? (x = x.nodeValue, x && K.inArray(B, S.type) && (S.getAttribute(j) || p(S), (x !== S.getAttribute(V) || "password" === S.type && !S.getAttribute(D)) && ("password" === S.type && !S.getAttribute(D) && K.changeType(S, "text") && S.setAttribute(D, "password"), S.value === S.getAttribute(V) && (S.value = x), S.setAttribute(V, x)))) : S.getAttribute(P) && (n(S), S.removeAttribute(V));
            m || clearInterval(L)
        }, 100)
    }
    K.addEventListener(t, "beforeunload", function() {
        J.disable()
    }), J.disable = J.nativeSupport ? e : i, J.enable = J.nativeSupport ? e : l
}(this),
function(t) {
    "use strict";
    var e = t.fn.val,
        r = t.fn.prop;
    Placeholders.nativeSupport || (t.fn.val = function(t) {
        var r = e.apply(this, arguments),
            n = this.eq(0).data("placeholder-value");
        return void 0 === t && this.eq(0).data("placeholder-active") && r === n ? "" : r
    }, t.fn.prop = function(t, e) {
        return void 0 === e && this.eq(0).data("placeholder-active") && "value" === t ? "" : r.apply(this, arguments)
    })
}(jQuery);;
! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e : e(jQuery)
}(function(e) {
    function t(t) {
        var s = t || window.event,
            a = h.call(arguments, 1),
            u = 0,
            r = 0,
            d = 0,
            f = 0;
        if (t = e.event.fix(s), t.type = "mousewheel", "detail" in s && (d = -1 * s.detail), "wheelDelta" in s && (d = s.wheelDelta), "wheelDeltaY" in s && (d = s.wheelDeltaY), "wheelDeltaX" in s && (r = -1 * s.wheelDeltaX), "axis" in s && s.axis === s.HORIZONTAL_AXIS && (r = -1 * d, d = 0), u = 0 === d ? r : d, "deltaY" in s && (d = -1 * s.deltaY, u = d), "deltaX" in s && (r = s.deltaX, 0 === d && (u = -1 * r)), 0 !== d || 0 !== r) {
            if (1 === s.deltaMode) {
                var c = e.data(this, "mousewheel-line-height");
                u *= c, d *= c, r *= c
            } else if (2 === s.deltaMode) {
                var m = e.data(this, "mousewheel-page-height");
                u *= m, d *= m, r *= m
            }
            return f = Math.max(Math.abs(d), Math.abs(r)), (!l || l > f) && (l = f, i(s, f) && (l /= 40)), i(s, f) && (u /= 40, r /= 40, d /= 40), u = Math[u >= 1 ? "floor" : "ceil"](u / l), r = Math[r >= 1 ? "floor" : "ceil"](r / l), d = Math[d >= 1 ? "floor" : "ceil"](d / l), t.deltaX = r, t.deltaY = d, t.deltaFactor = l, t.deltaMode = 0, a.unshift(t, u, r, d), o && clearTimeout(o), o = setTimeout(n, 200), (e.event.dispatch || e.event.handle).apply(this, a)
        }
    }

    function n() {
        l = null
    }

    function i(e, t) {
        return r.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 === 0
    }
    var o, l, s = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
        a = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
        h = Array.prototype.slice;
    if (e.event.fixHooks)
        for (var u = s.length; u;) e.event.fixHooks[s[--u]] = e.event.mouseHooks;
    var r = e.event.special.mousewheel = {
        version: "3.1.9",
        setup: function() {
            if (this.addEventListener)
                for (var n = a.length; n;) this.addEventListener(a[--n], t, !1);
            else this.onmousewheel = t;
            e.data(this, "mousewheel-line-height", r.getLineHeight(this)), e.data(this, "mousewheel-page-height", r.getPageHeight(this))
        },
        teardown: function() {
            if (this.removeEventListener)
                for (var e = a.length; e;) this.removeEventListener(a[--e], t, !1);
            else this.onmousewheel = null
        },
        getLineHeight: function(t) {
            return parseInt(e(t)["offsetParent" in e.fn ? "offsetParent" : "parent"]().css("fontSize"), 10)
        },
        getPageHeight: function(t) {
            return e(t).height()
        },
        settings: {
            adjustOldDeltas: !0
        }
    };
    e.fn.extend({
        mousewheel: function(e) {
            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel")
        },
        unmousewheel: function(e) {
            return this.unbind("mousewheel", e)
        }
    })
});;
(function() {
    ! function(a) {
        return a.easyPieChart = function(b, c) {
            var d, e, f, g, h, i, j, k = this;
            return this.el = b, this.$el = a(b), this.$el.data("easyPieChart", this), this.init = function() {
                var b;
                return k.options = a.extend({}, a.easyPieChart.defaultOptions, c), b = parseInt(k.$el.data("percent"), 10), k.percentage = 0, k.canvas = a("<canvas width='" + k.options.size + "' height='" + k.options.size + "'></canvas>").get(0), k.$el.append(k.canvas), "undefined" != typeof G_vmlCanvasManager && null !== G_vmlCanvasManager && G_vmlCanvasManager.initElement(k.canvas), k.ctx = k.canvas.getContext("2d"), window.devicePixelRatio > 1.5 && (a(k.canvas).css({
                    width: k.options.size,
                    height: k.options.size
                }), k.canvas.width *= 2, k.canvas.height *= 2, k.ctx.scale(2, 2)), k.ctx.translate(k.options.size / 2, k.options.size / 2), k.$el.addClass("easyPieChart"), k.$el.css({
                    width: k.options.size,
                    height: k.options.size,
                    lineHeight: "" + k.options.size + "px"
                }), k.update(b), k
            }, this.update = function(a) {
                return k.options.animate === !1 ? f(a) : e(k.percentage, a)
            }, i = function() {
                var a, b, c;
                for (k.ctx.fillStyle = k.options.scaleColor, k.ctx.lineWidth = 1, c = [], a = b = 0; 24 >= b; a = ++b) c.push(d(a));
                return c
            }, d = function(a) {
                var b;
                return b = a % 6 === 0 ? 0 : .017 * k.options.size, k.ctx.save(), k.ctx.rotate(a * Math.PI / 12), k.ctx.fillRect(k.options.size / 2 - b, 0, .05 * -k.options.size + b, 1), k.ctx.restore()
            }, j = function() {
                var a;
                return a = k.options.size / 2 - k.options.lineWidth / 2, k.options.scaleColor !== !1 && (a -= .08 * k.options.size), k.ctx.beginPath(), k.ctx.arc(0, 0, a, 0, 2 * Math.PI, !0), k.ctx.closePath(), k.ctx.strokeStyle = k.options.trackColor, k.ctx.lineWidth = k.options.lineWidth, k.ctx.stroke()
            }, h = function() {
                return k.options.scaleColor !== !1 && i(), k.options.trackColor !== !1 ? j() : void 0
            }, f = function(b) {
                var c;
                return h(), k.ctx.strokeStyle = a.isFunction(k.options.barColor) ? k.options.barColor(b) : k.options.barColor, k.ctx.lineCap = k.options.lineCap, k.ctx.lineWidth = k.options.lineWidth, c = k.options.size / 2 - k.options.lineWidth / 2, k.options.scaleColor !== !1 && (c -= .08 * k.options.size), k.ctx.save(), k.ctx.rotate(-Math.PI / 2), k.ctx.beginPath(), k.ctx.arc(0, 0, c, 0, 2 * Math.PI * b / 100, !1), k.ctx.stroke(), k.ctx.restore()
            }, e = function(a, b) {
                var c, d, e;
                return d = 30, e = d * k.options.animate / 1e3, c = 0, k.options.onStart.call(k), k.percentage = b, k.animation && (clearInterval(k.animation), k.animation = !1), k.animation = setInterval(function() {
                    return k.ctx.clearRect(-k.options.size / 2, -k.options.size / 2, k.options.size, k.options.size), h.call(k), f.call(k, [g(c, a, b - a, e)]), c++, c / e > 1 ? (clearInterval(k.animation), k.animation = !1, k.options.onStop.call(k)) : void 0
                }, 1e3 / d)
            }, g = function(a, b, c, d) {
                var e, f;
                return e = function(a) {
                    return Math.pow(a, 2)
                }, f = function(a) {
                    return 1 > a ? e(a) : 2 - e(a / 2 * -2 + 2)
                }, a /= d / 2, c / 2 * f(a) + b
            }, this.init()
        }, a.easyPieChart.defaultOptions = {
            onStart: a.noop,
            onStop: a.noop
        }, void(a.fn.easyPieChart = function(b) {
            return a.each(this, function(c, d) {
                var e;
                return e = a(d), e.data("easyPieChart") ? void 0 : e.data("easyPieChart", new a.easyPieChart(d, b))
            })
        })
    }(jQuery)
}).call(this);;
! function(a, b) {
    "use strict";
    "function" == typeof define && define.amd ? define(b) : "undefined" != typeof exports ? module.exports = b() : a.simpleStorage = b()
}(this, function() {
    "use strict";

    function a() {
        p = j(), d(), g(), b(), "addEventListener" in window && window.addEventListener("pageshow", function(a) {
            a.persisted && c()
        }, !1), p = !0
    }

    function b() {
        "addEventListener" in window ? window.addEventListener("storage", c, !1) : document.attachEvent("onstorage", c)
    }

    function c() {
        try {
            d()
        } catch (a) {
            return void(p = !1)
        }
        g()
    }

    function d() {
        var a = localStorage.getItem("simpleStorage");
        try {
            n = JSON.parse(a) || {}
        } catch (b) {
            n = {}
        }
        o = f()
    }

    function e() {
        try {
            localStorage.setItem("simpleStorage", JSON.stringify(n)), o = f()
        } catch (a) {
            return k(a)
        }
        return !0
    }

    function f() {
        var a = localStorage.getItem("simpleStorage");
        return a ? String(a).length : 0
    }

    function g() {
        var a, b, c, d, f, h = 1 / 0,
            j = 0;
        if (clearTimeout(q), n && n.__simpleStorage_meta && n.__simpleStorage_meta.TTL) {
            for (a = +new Date, f = n.__simpleStorage_meta.TTL.keys || [], d = n.__simpleStorage_meta.TTL.expire || {}, b = 0, c = f.length; c > b; b++) {
                if (!(d[f[b]] <= a)) {
                    d[f[b]] < h && (h = d[f[b]]);
                    break
                }
                j++, delete n[f[b]], delete d[f[b]]
            }
            h !== 1 / 0 && (q = setTimeout(g, Math.min(h - a, 2147483647))), j && (f.splice(0, j), i(), e())
        }
    }

    function h(a, b) {
        var c, d, e = +new Date,
            f = !1;
        if (b = Number(b) || 0, 0 !== b) {
            if (!n.hasOwnProperty(a)) return !1;
            if (n.__simpleStorage_meta || (n.__simpleStorage_meta = {}), n.__simpleStorage_meta.TTL || (n.__simpleStorage_meta.TTL = {
                    expire: {},
                    keys: []
                }), n.__simpleStorage_meta.TTL.expire[a] = e + b, n.__simpleStorage_meta.TTL.expire.hasOwnProperty(a))
                for (c = 0, d = n.__simpleStorage_meta.TTL.keys.length; d > c; c++) n.__simpleStorage_meta.TTL.keys[c] === a && n.__simpleStorage_meta.TTL.keys.splice(c);
            for (c = 0, d = n.__simpleStorage_meta.TTL.keys.length; d > c; c++)
                if (n.__simpleStorage_meta.TTL.expire[n.__simpleStorage_meta.TTL.keys[c]] > e + b) {
                    n.__simpleStorage_meta.TTL.keys.splice(c, 0, a), f = !0;
                    break
                }
            f || n.__simpleStorage_meta.TTL.keys.push(a)
        } else if (n && n.__simpleStorage_meta && n.__simpleStorage_meta.TTL) {
            if (n.__simpleStorage_meta.TTL.expire.hasOwnProperty(a))
                for (delete n.__simpleStorage_meta.TTL.expire[a], c = 0, d = n.__simpleStorage_meta.TTL.keys.length; d > c; c++)
                    if (n.__simpleStorage_meta.TTL.keys[c] === a) {
                        n.__simpleStorage_meta.TTL.keys.splice(c, 1);
                        break
                    }
            i()
        }
        return clearTimeout(q), n && n.__simpleStorage_meta && n.__simpleStorage_meta.TTL && n.__simpleStorage_meta.TTL.keys.length && (q = setTimeout(g, Math.min(Math.max(n.__simpleStorage_meta.TTL.expire[n.__simpleStorage_meta.TTL.keys[0]] - e, 0), 2147483647))), !0
    }

    function i() {
        var a, b = !1,
            c = !1;
        if (!n || !n.__simpleStorage_meta) return b;
        n.__simpleStorage_meta.TTL && !n.__simpleStorage_meta.TTL.keys.length && (delete n.__simpleStorage_meta.TTL, b = !0);
        for (a in n.__simpleStorage_meta)
            if (n.__simpleStorage_meta.hasOwnProperty(a)) {
                c = !0;
                break
            }
        return c || (delete n.__simpleStorage_meta, b = !0), b
    }

    function j() {
        var a, b = 0;
        if (null === window.localStorage || "unknown" == typeof window.localStorage) throw a = new Error("localStorage is disabled"), a.code = t, a;
        if (!window.localStorage) throw a = new Error("localStorage not supported"), a.code = s, a;
        try {
            b = window.localStorage.length
        } catch (c) {
            throw k(c)
        }
        try {
            window.localStorage.setItem("__simpleStorageInitTest", Date.now().toString(16)), window.localStorage.removeItem("__simpleStorageInitTest")
        } catch (c) {
            throw b ? k(c) : (a = new Error("localStorage is disabled"), a.code = t, a)
        }
        return !0
    }

    function k(a) {
        var b;
        return 22 === a.code || 1014 === a.code || [-2147024882, -2146828281, -21474675259].indexOf(a.number) > 0 ? (b = new Error("localStorage quota exceeded"), b.code = u, b) : 18 === a.code || 1e3 === a.code ? (b = new Error("localStorage is disabled"), b.code = t, b) : "TypeError" === a.name ? (b = new Error("localStorage is disabled"), b.code = t, b) : a
    }

    function l(a) {
        if (!a) return r = "OK", a;
        switch (a.code) {
            case s:
            case t:
            case u:
                r = a.code;
                break;
            default:
                r = a.code || a.number || a.message || a.name
        }
        return a
    }
    var m = "0.2.1",
        n = !1,
        o = 0,
        p = !1,
        q = null,
        r = "OK",
        s = "LS_NOT_AVAILABLE",
        t = "LS_DISABLED",
        u = "LS_QUOTA_EXCEEDED";
    try {
        a()
    } catch (v) {
        l(v)
    }
    return {
        version: m,
        status: r,
        canUse: function() {
            return "OK" === r && !!p
        },
        set: function(a, b, c) {
            if ("__simpleStorage_meta" === a) return !1;
            if (!n) return !1;
            if ("undefined" == typeof b) return this.deleteKey(a);
            c = c || {};
            try {
                b = JSON.parse(JSON.stringify(b))
            } catch (d) {
                return k(d)
            }
            return n[a] = b, h(a, c.TTL || 0), e()
        },
        hasKey: function(a) {
            return n && n.hasOwnProperty(a) && "__simpleStorage_meta" !== a ? !0 : !1
        },
        get: function(a) {
            return n ? n.hasOwnProperty(a) && "__simpleStorage_meta" !== a && this.getTTL(a) ? n[a] : void 0 : !1
        },
        deleteKey: function(a) {
            return n && a in n ? (delete n[a], h(a, 0), e()) : !1
        },
        setTTL: function(a, b) {
            return n ? (h(a, b), e()) : !1
        },
        getTTL: function(a) {
            var b;
            return n && n.hasOwnProperty(a) ? n.__simpleStorage_meta && n.__simpleStorage_meta.TTL && n.__simpleStorage_meta.TTL.expire && n.__simpleStorage_meta.TTL.expire.hasOwnProperty(a) ? (b = Math.max(n.__simpleStorage_meta.TTL.expire[a] - +new Date || 0, 0), b || !1) : 1 / 0 : !1
        },
        flush: function() {
            if (!n) return !1;
            n = {};
            try {
                return localStorage.removeItem("simpleStorage"), !0
            } catch (a) {
                return k(a)
            }
        },
        index: function() {
            if (!n) return !1;
            var a, b = [];
            for (a in n) n.hasOwnProperty(a) && "__simpleStorage_meta" !== a && b.push(a);
            return b
        },
        storageSize: function() {
            return o
        }
    }
});;
! function() {
    var e = function(n) {
        return e.utils.extend({}, e.plugins, (new e.Storage).init(n))
    };
    e.version = "0.4.4", e.utils = {
        extend: function() {
            for (var e = "object" == typeof arguments[0] ? arguments[0] : {}, n = 1; n < arguments.length; n++)
                if (arguments[n] && "object" == typeof arguments[n])
                    for (var t in arguments[n]) e[t] = arguments[n][t];
            return e
        },
        each: function(e, n, t) {
            if (this.isArray(e)) {
                for (var i = 0; i < e.length; i++)
                    if (n.call(t, e[i], i) === !1) return
            } else if (e)
                for (var o in e)
                    if (n.call(t, e[o], o) === !1) return
        },
        tryEach: function(e, n, t, i) {
            this.each(e, function(e, o) {
                try {
                    return n.call(i, e, o)
                } catch (r) {
                    if (this.isFunction(t)) try {
                        t.call(i, e, o, r)
                    } catch (r) {}
                }
            }, this)
        },
        registerPlugin: function(n) {
            e.plugins = this.extend(n, e.plugins)
        },
        getTypeOf: function(e) {
            return "undefined" == typeof e || null === e ? "" + e : Object.prototype.toString.call(e).replace(/^\[object\s(.*)\]$/, function(e, n) {
                return n.toLowerCase()
            })
        }
    };
    for (var n = ["Arguments", "Boolean", "Function", "String", "Array", "Number", "Date", "RegExp", "Undefined", "Null"], t = 0; t < n.length; t++) e.utils["is" + n[t]] = function(n) {
        return function(t) {
            return e.utils.getTypeOf(t) === n.toLowerCase()
        }
    }(n[t]);
    e.plugins = {}, e.options = e.utils.extend({
        namespace: "b45i1",
        storages: ["local", "cookie", "session", "memory"],
        expireDays: 365
    }, window.Basil ? window.Basil.options : {}), e.Storage = function() {
        var n = "b45i1" + (Math.random() + 1).toString(36).substring(7),
            t = {},
            i = function(n) {
                var t = e.utils.getTypeOf(n);
                return "string" === t && n || "number" === t || "boolean" === t
            },
            o = function(n) {
                return e.utils.isArray(n) ? n : e.utils.isString(n) ? [n] : []
            },
            r = function(n, t) {
                var o = "";
                return i(t) ? o += t : e.utils.isArray(t) && (t = e.utils.isFunction(t.filter) ? t.filter(i) : t, o = t.join(".")), o && i(n) ? n + "." + o : o
            },
            s = function(e, n) {
                return i(e) ? n.replace(new RegExp("^" + e + "."), "") : n
            },
            u = function(e) {
                return JSON.stringify(e)
            },
            a = function(e) {
                return e ? JSON.parse(e) : null
            },
            c = {
                engine: null,
                check: function() {
                    try {
                        window[this.engine].setItem(n, !0), window[this.engine].removeItem(n)
                    } catch (e) {
                        return !1
                    }
                    return !0
                },
                set: function(e, n, t) {
                    if (!e) throw Error("invalid key");
                    window[this.engine].setItem(e, n)
                },
                get: function(e) {
                    return window[this.engine].getItem(e)
                },
                remove: function(e) {
                    window[this.engine].removeItem(e)
                },
                reset: function(e) {
                    for (var n, t = 0; t < window[this.engine].length; t++) n = window[this.engine].key(t), e && 0 !== n.indexOf(e) || (this.remove(n), t--)
                },
                keys: function(e) {
                    for (var n, t = [], i = 0; i < window[this.engine].length; i++) n = window[this.engine].key(i), e && 0 !== n.indexOf(e) || t.push(s(e, n));
                    return t
                }
            };
        return t.local = e.utils.extend({}, c, {
            engine: "localStorage"
        }), t.session = e.utils.extend({}, c, {
            engine: "sessionStorage"
        }), t.memory = {
            _hash: {},
            check: function() {
                return !0
            },
            set: function(e, n, t) {
                if (!e) throw Error("invalid key");
                this._hash[e] = n
            },
            get: function(e) {
                return this._hash[e] || null
            },
            remove: function(e) {
                delete this._hash[e]
            },
            reset: function(e) {
                for (var n in this._hash) e && 0 !== n.indexOf(e) || this.remove(n)
            },
            keys: function(e) {
                var n = [];
                for (var t in this._hash) e && 0 !== t.indexOf(e) || n.push(s(e, t));
                return n
            }
        }, t.cookie = {
            check: function() {
                if (!navigator.cookieEnabled) return !1;
                if (window.self !== window.top) {
                    var e = "thirdparty.check=" + Math.round(1e3 * Math.random());
                    return document.cookie = e + "; path=/", -1 !== document.cookie.indexOf(e)
                }
                return !0
            },
            set: function(e, n, t) {
                if (!this.check()) throw Error("cookies are disabled");
                if (t = t || {}, !e) throw Error("invalid key");
                var i = encodeURIComponent(e) + "=" + encodeURIComponent(n);
                if (t.expireDays) {
                    var o = new Date;
                    o.setTime(o.getTime() + 24 * t.expireDays * 60 * 60 * 1e3), i += "; expires=" + o.toGMTString()
                }
                if (t.domain && t.domain !== document.domain) {
                    var r = t.domain.replace(/^\./, "");
                    if (-1 === document.domain.indexOf(r) || r.split(".").length <= 1) throw Error("invalid domain");
                    i += "; domain=" + t.domain
                }
                t.secure === !0 && (i += "; secure"), document.cookie = i + "; path=/"
            },
            get: function(e) {
                if (!this.check()) throw Error("cookies are disabled");
                for (var n, t = encodeURIComponent(e), i = document.cookie ? document.cookie.split(";") : [], o = i.length - 1; o >= 0; o--)
                    if (n = i[o].replace(/^\s*/, ""), 0 === n.indexOf(t + "=")) return decodeURIComponent(n.substring(t.length + 1, n.length));
                return null
            },
            remove: function(e) {
                this.set(e, "", {
                    expireDays: -1
                });
                for (var n = document.domain.split("."), t = n.length; t >= 0; t--) this.set(e, "", {
                    expireDays: -1,
                    domain: "." + n.slice(-t).join(".")
                })
            },
            reset: function(e) {
                for (var n, t, i = document.cookie ? document.cookie.split(";") : [], o = 0; o < i.length; o++) n = i[o].replace(/^\s*/, ""), t = n.substr(0, n.indexOf("=")), e && 0 !== t.indexOf(e) || this.remove(t)
            },
            keys: function(e) {
                if (!this.check()) throw Error("cookies are disabled");
                for (var n, t, i = [], o = document.cookie ? document.cookie.split(";") : [], r = 0; r < o.length; r++) n = o[r].replace(/^\s*/, ""), t = decodeURIComponent(n.substr(0, n.indexOf("="))), e && 0 !== t.indexOf(e) || i.push(s(e, t));
                return i
            }
        }, {
            init: function(e) {
                return this.setOptions(e), this
            },
            setOptions: function(n) {
                this.options = e.utils.extend({}, this.options || e.options, n)
            },
            support: function(e) {
                return t.hasOwnProperty(e)
            },
            check: function(e) {
                return this.support(e) ? t[e].check() : !1
            },
            set: function(n, i, s) {
                if (s = e.utils.extend({}, this.options, s), !(n = r(s.namespace, n))) return !1;
                i = s.raw === !0 ? i : u(i);
                var a = null;
                return e.utils.tryEach(o(s.storages), function(e, o) {
                    return t[e].set(n, i, s), a = e, !1
                }, null, this), a ? (e.utils.tryEach(o(s.storages), function(e, i) {
                    e !== a && t[e].remove(n)
                }, null, this), !0) : !1
            },
            get: function(n, i) {
                if (i = e.utils.extend({}, this.options, i), !(n = r(i.namespace, n))) return null;
                var s = null;
                return e.utils.tryEach(o(i.storages), function(e, o) {
                    return null !== s ? !1 : (s = t[e].get(n, i) || null, void(s = i.raw === !0 ? s : a(s)))
                }, function(e, n, t) {
                    s = null
                }, this), s
            },
            remove: function(n, i) {
                i = e.utils.extend({}, this.options, i), (n = r(i.namespace, n)) && e.utils.tryEach(o(i.storages), function(e) {
                    t[e].remove(n)
                }, null, this)
            },
            reset: function(n) {
                n = e.utils.extend({}, this.options, n), e.utils.tryEach(o(n.storages), function(e) {
                    t[e].reset(n.namespace)
                }, null, this)
            },
            keys: function(e) {
                e = e || {};
                var n = [];
                for (var t in this.keysMap(e)) n.push(t);
                return n
            },
            keysMap: function(n) {
                n = e.utils.extend({}, this.options, n);
                var i = {};
                return e.utils.tryEach(o(n.storages), function(o) {
                    e.utils.each(t[o].keys(n.namespace), function(n) {
                        i[n] = e.utils.isArray(i[n]) ? i[n] : [], i[n].push(o)
                    }, this)
                }, null, this), i
            }
        }
    }, e.memory = (new e.Storage).init({
        storages: "memory",
        namespace: null,
        raw: !0
    }), e.cookie = (new e.Storage).init({
        storages: "cookie",
        namespace: null,
        raw: !0
    }), e.localStorage = (new e.Storage).init({
        storages: "local",
        namespace: null,
        raw: !0
    }), e.sessionStorage = (new e.Storage).init({
        storages: "session",
        namespace: null,
        raw: !0
    }), window.Basil = e, "function" == typeof define && define.amd ? define(function() {
        return e
    }) : "undefined" != typeof module && module.exports && (module.exports = e)
}();;
! function(t, e) {
    "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? exports.Pusher = e() : t.Pusher = e()
}(this, function() {
    return function(t) {
        function e(i) {
            if (n[i]) return n[i].exports;
            var o = n[i] = {
                exports: {},
                id: i,
                loaded: !1
            };
            return t[i].call(o.exports, o, o.exports, e), o.loaded = !0, o.exports
        }
        var n = {};
        return e.m = t, e.c = n, e.p = "", e(0)
    }([function(t, e, n) {
        "use strict";
        var i = n(1);
        t.exports = i["default"]
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            if (null === t || void 0 === t) throw "You must pass your app key when you instantiate Pusher."
        }
        var o = n(2),
            r = n(9),
            s = n(23),
            a = n(38),
            c = n(39),
            u = n(40),
            l = n(12),
            h = n(5),
            f = n(62),
            p = n(8),
            d = n(42),
            y = function() {
                function t(e, n) {
                    var l = this;
                    i(e), n = n || {}, this.key = e, this.config = r.extend(f.getGlobalConfig(), n.cluster ? f.getClusterConfig(n.cluster) : {}, n), this.channels = d["default"].createChannels(), this.global_emitter = new s["default"], this.sessionID = Math.floor(1e9 * Math.random()), this.timeline = new a["default"](this.key, this.sessionID, {
                        cluster: this.config.cluster,
                        features: t.getClientFeatures(),
                        params: this.config.timelineParams || {},
                        limit: 50,
                        level: c["default"].INFO,
                        version: h["default"].VERSION
                    }), this.config.disableStats || (this.timelineSender = d["default"].createTimelineSender(this.timeline, {
                        host: this.config.statsHost,
                        path: "/timeline/v2/" + o["default"].TimelineTransport.name
                    }));
                    var y = function(t) {
                        var e = r.extend({}, l.config, t);
                        return u.build(o["default"].getDefaultStrategy(e), e)
                    };
                    this.connection = d["default"].createConnectionManager(this.key, r.extend({
                        getStrategy: y,
                        timeline: this.timeline,
                        activityTimeout: this.config.activity_timeout,
                        pongTimeout: this.config.pong_timeout,
                        unavailableTimeout: this.config.unavailable_timeout
                    }, this.config, {
                        encrypted: this.isEncrypted()
                    })), this.connection.bind("connected", function() {
                        l.subscribeAll(), l.timelineSender && l.timelineSender.send(l.connection.isEncrypted())
                    }), this.connection.bind("message", function(t) {
                        var e = 0 === t.event.indexOf("pusher_internal:");
                        if (t.channel) {
                            var n = l.channel(t.channel);
                            n && n.handleEvent(t.event, t.data)
                        }
                        e || l.global_emitter.emit(t.event, t.data)
                    }), this.connection.bind("disconnected", function() {
                        l.channels.disconnect()
                    }), this.connection.bind("error", function(t) {
                        p["default"].warn("Error", t)
                    }), t.instances.push(this), this.timeline.info({
                        instances: t.instances.length
                    }), t.isReady && this.connect()
                }
                return t.ready = function() {
                    t.isReady = !0;
                    for (var e = 0, n = t.instances.length; n > e; e++) t.instances[e].connect()
                }, t.log = function(e) {
                    var n = Function("return this")();
                    t.logToConsole && n.console && n.console.log && n.console.log(e)
                }, t.getClientFeatures = function() {
                    return r.keys(r.filterObject({
                        ws: o["default"].Transports.ws
                    }, function(t) {
                        return t.isSupported({})
                    }))
                }, t.prototype.channel = function(t) {
                    return this.channels.find(t)
                }, t.prototype.allChannels = function() {
                    return this.channels.all()
                }, t.prototype.connect = function() {
                    if (this.connection.connect(), this.timelineSender && !this.timelineSenderTimer) {
                        var t = this.connection.isEncrypted(),
                            e = this.timelineSender;
                        this.timelineSenderTimer = new l.PeriodicTimer(6e4, function() {
                            e.send(t)
                        })
                    }
                }, t.prototype.disconnect = function() {
                    this.connection.disconnect(), this.timelineSenderTimer && (this.timelineSenderTimer.ensureAborted(), this.timelineSenderTimer = null)
                }, t.prototype.bind = function(t, e) {
                    return this.global_emitter.bind(t, e), this
                }, t.prototype.bind_all = function(t) {
                    return this.global_emitter.bind_all(t), this
                }, t.prototype.subscribeAll = function() {
                    var t;
                    for (t in this.channels.channels) this.channels.channels.hasOwnProperty(t) && this.subscribe(t)
                }, t.prototype.subscribe = function(t) {
                    var e = this.channels.add(t, this);
                    return "connected" === this.connection.state && e.subscribe(), e
                }, t.prototype.unsubscribe = function(t) {
                    var e = this.channels.remove(t);
                    e && "connected" === this.connection.state && e.unsubscribe()
                }, t.prototype.send_event = function(t, e, n) {
                    return this.connection.send_event(t, e, n)
                }, t.prototype.isEncrypted = function() {
                    return "https:" === o["default"].getProtocol() ? !0 : Boolean(this.config.encrypted)
                }, t.instances = [], t.isReady = !1, t.logToConsole = !1, t.Runtime = o["default"], t.ScriptReceivers = o["default"].ScriptReceivers, t.DependenciesReceivers = o["default"].DependenciesReceivers, t.auth_callbacks = o["default"].auth_callbacks, t
            }();
        e.__esModule = !0, e["default"] = y, o["default"].setup(y)
    }, function(t, e, n) {
        "use strict";
        var i = n(3),
            o = n(7),
            r = n(14),
            s = n(15),
            a = n(16),
            c = n(4),
            u = n(17),
            l = n(18),
            h = n(25),
            f = n(26),
            p = n(27),
            d = n(28),
            y = {
                nextAuthCallbackID: 1,
                auth_callbacks: {},
                ScriptReceivers: c.ScriptReceivers,
                DependenciesReceivers: i.DependenciesReceivers,
                getDefaultStrategy: f["default"],
                Transports: l["default"],
                transportConnectionInitializer: p["default"],
                HTTPFactory: d["default"],
                TimelineTransport: u["default"],
                getXHRAPI: function() {
                    return window.XMLHttpRequest
                },
                getWebSocketAPI: function() {
                    return window.WebSocket || window.MozWebSocket
                },
                setup: function(t) {
                    var e = this;
                    window.Pusher = t;
                    var n = function() {
                        e.onDocumentBody(t.ready)
                    };
                    window.JSON ? n() : i.Dependencies.load("json2", {}, n)
                },
                getDocument: function() {
                    return document
                },
                getProtocol: function() {
                    return this.getDocument().location.protocol
                },
                getGlobal: function() {
                    return window
                },
                getAuthorizers: function() {
                    return {
                        ajax: o["default"],
                        jsonp: r["default"]
                    }
                },
                onDocumentBody: function(t) {
                    var e = this;
                    document.body ? t() : setTimeout(function() {
                        e.onDocumentBody(t)
                    }, 0)
                },
                createJSONPRequest: function(t, e) {
                    return new a["default"](t, e)
                },
                createScriptRequest: function(t) {
                    return new s["default"](t)
                },
                getLocalStorage: function() {
                    try {
                        return window.localStorage
                    } catch (t) {
                        return
                    }
                },
                createXHR: function() {
                    return this.getXHRAPI() ? this.createXMLHttpRequest() : this.createMicrosoftXHR()
                },
                createXMLHttpRequest: function() {
                    var t = this.getXHRAPI();
                    return new t
                },
                createMicrosoftXHR: function() {
                    return new ActiveXObject("Microsoft.XMLHTTP")
                },
                getNetwork: function() {
                    return h.Network
                },
                createWebSocket: function(t) {
                    var e = this.getWebSocketAPI();
                    return new e(t)
                },
                createSocketRequest: function(t, e) {
                    if (this.isXHRSupported()) return this.HTTPFactory.createXHR(t, e);
                    if (this.isXDRSupported(0 === e.indexOf("https:"))) return this.HTTPFactory.createXDR(t, e);
                    throw "Cross-origin HTTP requests are not supported"
                },
                isXHRSupported: function() {
                    var t = this.getXHRAPI();
                    return Boolean(t) && void 0 !== (new t).withCredentials
                },
                isXDRSupported: function(t) {
                    var e = t ? "https:" : "http:",
                        n = this.getProtocol();
                    return Boolean(window.XDomainRequest) && n === e
                },
                addUnloadListener: function(t) {
                    void 0 !== window.addEventListener ? window.addEventListener("unload", t, !1) : void 0 !== window.attachEvent && window.attachEvent("onunload", t)
                },
                removeUnloadListener: function(t) {
                    void 0 !== window.addEventListener ? window.removeEventListener("unload", t, !1) : void 0 !== window.detachEvent && window.detachEvent("onunload", t)
                }
            };
        e.__esModule = !0, e["default"] = y
    }, function(t, e, n) {
        "use strict";
        var i = n(4),
            o = n(5),
            r = n(6);
        e.DependenciesReceivers = new i.ScriptReceiverFactory("_pusher_dependencies", "Pusher.DependenciesReceivers"), e.Dependencies = new r["default"]({
            cdn_http: o["default"].cdn_http,
            cdn_https: o["default"].cdn_https,
            version: o["default"].VERSION,
            suffix: o["default"].dependency_suffix,
            receivers: e.DependenciesReceivers
        })
    }, function(t, e) {
        "use strict";
        var n = function() {
            function t(t, e) {
                this.lastId = 0, this.prefix = t, this.name = e
            }
            return t.prototype.create = function(t) {
                this.lastId++;
                var e = this.lastId,
                    n = this.prefix + e,
                    i = this.name + "[" + e + "]",
                    o = !1,
                    r = function() {
                        o || (t.apply(null, arguments), o = !0)
                    };
                return this[e] = r, {
                    number: e,
                    id: n,
                    name: i,
                    callback: r
                }
            }, t.prototype.remove = function(t) {
                delete this[t.number]
            }, t
        }();
        e.ScriptReceiverFactory = n, e.ScriptReceivers = new n("_pusher_script_", "Pusher.ScriptReceivers")
    }, function(t, e) {
        "use strict";
        var n = {
            VERSION: "3.1.0",
            PROTOCOL: 7,
            host: "ws.pusherapp.com",
            ws_port: 80,
            wss_port: 443,
            sockjs_host: "sockjs.pusher.com",
            sockjs_http_port: 80,
            sockjs_https_port: 443,
            sockjs_path: "/pusher",
            stats_host: "stats.pusher.com",
            channel_auth_endpoint: "/pusher/auth",
            channel_auth_transport: "ajax",
            activity_timeout: 12e4,
            pong_timeout: 3e4,
            unavailable_timeout: 1e4,
            cdn_http: "http://js.pusher.com",
            cdn_https: "https://js.pusher.com",
            dependency_suffix: ".min"
        };
        e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";
        var i = n(4),
            o = n(2),
            r = function() {
                function t(t) {
                    this.options = t, this.receivers = t.receivers || i.ScriptReceivers, this.loading = {}
                }
                return t.prototype.load = function(t, e, n) {
                    var i = this;
                    if (i.loading[t] && i.loading[t].length > 0) i.loading[t].push(n);
                    else {
                        i.loading[t] = [n];
                        var r = o["default"].createScriptRequest(i.getPath(t, e)),
                            s = i.receivers.create(function(e) {
                                if (i.receivers.remove(s), i.loading[t]) {
                                    var n = i.loading[t];
                                    delete i.loading[t];
                                    for (var o = function(t) {
                                            t || r.cleanup()
                                        }, a = 0; a < n.length; a++) n[a](e, o)
                                }
                            });
                        r.send(s)
                    }
                }, t.prototype.getRoot = function(t) {
                    var e, n = o["default"].getDocument().location.protocol;
                    return e = t && t.encrypted || "https:" === n ? this.options.cdn_https : this.options.cdn_http, e.replace(/\/*$/, "") + "/" + this.options.version
                }, t.prototype.getPath = function(t, e) {
                    return this.getRoot(e) + "/" + t + this.options.suffix + ".js"
                }, t
            }();
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";
        var i = n(8),
            o = n(2),
            r = function(t, e, n) {
                var r, s = this;
                r = o["default"].createXHR(), r.open("POST", s.options.authEndpoint, !0), r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                for (var a in this.authOptions.headers) r.setRequestHeader(a, this.authOptions.headers[a]);
                return r.onreadystatechange = function() {
                    if (4 === r.readyState)
                        if (200 === r.status) {
                            var t, e = !1;
                            try {
                                t = JSON.parse(r.responseText), e = !0
                            } catch (o) {
                                n(!0, "JSON returned from webapp was invalid, yet status code was 200. Data was: " + r.responseText)
                            }
                            e && n(!1, t)
                        } else i["default"].warn("Couldn't get auth info from your webapp", r.status), n(!0, r.status)
                }, r.send(this.composeQuery(e)), r
            };
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";
        var i = n(9),
            o = n(1),
            r = {
                debug: function() {
                    for (var t = [], e = 0; e < arguments.length; e++) t[e - 0] = arguments[e];
                    o["default"].log && o["default"].log(i.stringify.apply(this, arguments))
                },
                warn: function() {
                    for (var t = [], e = 0; e < arguments.length; e++) t[e - 0] = arguments[e];
                    var n = i.stringify.apply(this, arguments),
                        r = Function("return this")();
                    r.console && (r.console.warn ? r.console.warn(n) : r.console.log && r.console.log(n)), o["default"].log && o["default"].log(n)
                }
            };
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            for (var e = [], n = 1; n < arguments.length; n++) e[n - 1] = arguments[n];
            for (var o = 0; o < e.length; o++) {
                var r = e[o];
                for (var s in r) r[s] && r[s].constructor && r[s].constructor === Object ? t[s] = i(t[s] || {}, r[s]) : t[s] = r[s]
            }
            return t
        }

        function o() {
            for (var t = ["Pusher"], e = 0; e < arguments.length; e++) "string" == typeof arguments[e] ? t.push(arguments[e]) : t.push(JSON.stringify(arguments[e]));
            return t.join(" : ")
        }

        function r(t, e) {
            var n = Array.prototype.indexOf;
            if (null === t) return -1;
            if (n && t.indexOf === n) return t.indexOf(e);
            for (var i = 0, o = t.length; o > i; i++)
                if (t[i] === e) return i;
            return -1
        }

        function s(t, e) {
            for (var n in t) Object.prototype.hasOwnProperty.call(t, n) && e(t[n], n, t)
        }

        function a(t) {
            var e = [];
            return s(t, function(t, n) {
                e.push(n)
            }), e
        }

        function c(t) {
            var e = [];
            return s(t, function(t) {
                e.push(t)
            }), e
        }

        function u(t, e, n) {
            for (var i = 0; i < t.length; i++) e.call(n || w, t[i], i, t)
        }

        function l(t, e) {
            for (var n = [], i = 0; i < t.length; i++) n.push(e(t[i], i, t, n));
            return n
        }

        function h(t, e) {
            var n = {};
            return s(t, function(t, i) {
                n[i] = e(t)
            }), n
        }

        function f(t, e) {
            e = e || function(t) {
                return !!t
            };
            for (var n = [], i = 0; i < t.length; i++) e(t[i], i, t, n) && n.push(t[i]);
            return n
        }

        function p(t, e) {
            var n = {};
            return s(t, function(i, o) {
                (e && e(i, o, t, n) || Boolean(i)) && (n[o] = i)
            }), n
        }

        function d(t) {
            var e = [];
            return s(t, function(t, n) {
                e.push([n, t])
            }), e
        }

        function y(t, e) {
            for (var n = 0; n < t.length; n++)
                if (e(t[n], n, t)) return !0;
            return !1
        }

        function m(t, e) {
            for (var n = 0; n < t.length; n++)
                if (!e(t[n], n, t)) return !1;
            return !0
        }

        function v(t) {
            return h(t, function(t) {
                return "object" == typeof t && (t = JSON.stringify(t)), encodeURIComponent(b["default"](t.toString()))
            })
        }

        function g(t) {
            var e = p(t, function(t) {
                    return void 0 !== t
                }),
                n = l(d(v(e)), k["default"].method("join", "=")).join("&");
            return n
        }

        function _(t) {
            var e = [],
                n = JSON.stringify(t, function(t, n) {
                    if ("object" == typeof n && null !== n) {
                        if (-1 !== e.indexOf(n)) return;
                        e.push(n)
                    }
                    return n
                });
            return e = null, n
        }
        var b = n(10),
            k = n(11),
            w = Function("return this")();
        e.extend = i, e.stringify = o, e.arrayIndexOf = r, e.objectApply = s, e.keys = a, e.values = c, e.apply = u, e.map = l, e.mapObject = h, e.filter = f, e.filterObject = p, e.flatten = d, e.any = y, e.all = m, e.encodeParamsObject = v, e.buildQueryString = g, e.safeJSONStringify = _
    }, function(t, e) {
        "use strict";

        function n(t) {
            return f(l(t))
        }
        var i = Function("return this")();
        e.__esModule = !0, e["default"] = n;
        for (var o = String.fromCharCode, r = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", s = {}, a = 0, c = r.length; c > a; a++) s[r.charAt(a)] = a;
        var u = function(t) {
                var e = t.charCodeAt(0);
                return 128 > e ? t : 2048 > e ? o(192 | e >>> 6) + o(128 | 63 & e) : o(224 | e >>> 12 & 15) + o(128 | e >>> 6 & 63) + o(128 | 63 & e)
            },
            l = function(t) {
                return t.replace(/[^\x00-\x7F]/g, u)
            },
            h = function(t) {
                var e = [0, 2, 1][t.length % 3],
                    n = t.charCodeAt(0) << 16 | (t.length > 1 ? t.charCodeAt(1) : 0) << 8 | (t.length > 2 ? t.charCodeAt(2) : 0),
                    i = [r.charAt(n >>> 18), r.charAt(n >>> 12 & 63), e >= 2 ? "=" : r.charAt(n >>> 6 & 63), e >= 1 ? "=" : r.charAt(63 & n)];
                return i.join("")
            },
            f = i.btoa || function(t) {
                return t.replace(/[\s\S]{1,3}/g, h)
            }
    }, function(t, e, n) {
        "use strict";
        var i = n(12),
            o = {
                getGlobal: function() {
                    return Function("return this")()
                },
                now: function() {
                    return Date.now ? Date.now() : (new Date).valueOf()
                },
                defer: function(t) {
                    return new i.OneOffTimer(0, t)
                },
                method: function(t) {
                    for (var e = [], n = 1; n < arguments.length; n++) e[n - 1] = arguments[n];
                    var i = Array.prototype.slice.call(arguments, 1);
                    return function(e) {
                        return e[t].apply(e, i.concat(arguments))
                    }
                }
            };
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            a.clearTimeout(t)
        }

        function o(t) {
            a.clearInterval(t)
        }
        var r = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            s = n(13),
            a = Function("return this")(),
            c = function(t) {
                function e(e, n) {
                    t.call(this, setTimeout, i, e, function(t) {
                        return n(), null
                    })
                }
                return r(e, t), e
            }(s["default"]);
        e.OneOffTimer = c;
        var u = function(t) {
            function e(e, n) {
                t.call(this, setInterval, o, e, function(t) {
                    return n(), t
                })
            }
            return r(e, t), e
        }(s["default"]);
        e.PeriodicTimer = u
    }, function(t, e) {
        "use strict";
        var n = function() {
            function t(t, e, n, i) {
                var o = this;
                this.clear = e, this.timer = t(function() {
                    o.timer && (o.timer = i(o.timer))
                }, n)
            }
            return t.prototype.isRunning = function() {
                return null !== this.timer
            }, t.prototype.ensureAborted = function() {
                this.timer && (this.clear(this.timer), this.timer = null)
            }, t
        }();
        e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";
        var i = n(8),
            o = function(t, e, n) {
                void 0 !== this.authOptions.headers && i["default"].warn("Warn", "To send headers with the auth request, you must use AJAX, rather than JSONP.");
                var o = t.nextAuthCallbackID.toString();
                t.nextAuthCallbackID++;
                var r = t.getDocument(),
                    s = r.createElement("script");
                t.auth_callbacks[o] = function(t) {
                    n(!1, t)
                };
                var a = "Pusher.auth_callbacks['" + o + "']";
                s.src = this.options.authEndpoint + "?callback=" + encodeURIComponent(a) + "&" + this.composeQuery(e);
                var c = r.getElementsByTagName("head")[0] || r.documentElement;
                c.insertBefore(s, c.firstChild)
            };
        e.__esModule = !0, e["default"] = o
    }, function(t, e) {
        "use strict";
        var n = function() {
            function t(t) {
                this.src = t
            }
            return t.prototype.send = function(t) {
                var e = this,
                    n = "Error loading " + e.src;
                e.script = document.createElement("script"), e.script.id = t.id, e.script.src = e.src, e.script.type = "text/javascript", e.script.charset = "UTF-8", e.script.addEventListener ? (e.script.onerror = function() {
                    t.callback(n)
                }, e.script.onload = function() {
                    t.callback(null)
                }) : e.script.onreadystatechange = function() {
                    ("loaded" === e.script.readyState || "complete" === e.script.readyState) && t.callback(null)
                }, void 0 === e.script.async && document.attachEvent && /opera/i.test(navigator.userAgent) ? (e.errorScript = document.createElement("script"), e.errorScript.id = t.id + "_error", e.errorScript.text = t.name + "('" + n + "');", e.script.async = e.errorScript.async = !1) : e.script.async = !0;
                var i = document.getElementsByTagName("head")[0];
                i.insertBefore(e.script, i.firstChild), e.errorScript && i.insertBefore(e.errorScript, e.script.nextSibling)
            }, t.prototype.cleanup = function() {
                this.script && (this.script.onload = this.script.onerror = null, this.script.onreadystatechange = null), this.script && this.script.parentNode && this.script.parentNode.removeChild(this.script), this.errorScript && this.errorScript.parentNode && this.errorScript.parentNode.removeChild(this.errorScript), this.script = null, this.errorScript = null
            }, t
        }();
        e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";
        var i = n(9),
            o = n(2),
            r = function() {
                function t(t, e) {
                    this.url = t, this.data = e
                }
                return t.prototype.send = function(t) {
                    if (!this.request) {
                        var e = i.buildQueryString(this.data),
                            n = this.url + "/" + t.number + "?" + e;
                        this.request = o["default"].createScriptRequest(n), this.request.send(t)
                    }
                }, t.prototype.cleanup = function() {
                    this.request && this.request.cleanup()
                }, t
            }();
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";
        var i = n(2),
            o = n(4),
            r = function(t, e) {
                return function(n, r) {
                    var s = "http" + (e ? "s" : "") + "://",
                        a = s + (t.host || t.options.host) + t.options.path,
                        c = i["default"].createJSONPRequest(a, n),
                        u = i["default"].ScriptReceivers.create(function(e, n) {
                            o.ScriptReceivers.remove(u), c.cleanup(), n && n.host && (t.host = n.host), r && r(e, n)
                        });
                    c.send(u)
                }
            },
            s = {
                name: "jsonp",
                getAgent: r
            };
        e.__esModule = !0, e["default"] = s
    }, function(t, e, n) {
        "use strict";
        var i = n(19),
            o = n(21),
            r = n(20),
            s = n(2),
            a = n(3),
            c = n(9),
            u = new o["default"]({
                file: "sockjs",
                urls: r.sockjs,
                handlesActivityChecks: !0,
                supportsPing: !1,
                isSupported: function() {
                    return !0
                },
                isInitialized: function() {
                    return void 0 !== window.SockJS
                },
                getSocket: function(t, e) {
                    return new window.SockJS(t, null, {
                        js_path: a.Dependencies.getPath("sockjs", {
                            encrypted: e.encrypted
                        }),
                        ignore_null_origin: e.ignoreNullOrigin
                    })
                },
                beforeOpen: function(t, e) {
                    t.send(JSON.stringify({
                        path: e
                    }))
                }
            }),
            l = {
                isSupported: function(t) {
                    var e = s["default"].isXDRSupported(t.encrypted);
                    return e
                }
            },
            h = new o["default"](c.extend({}, i.streamingConfiguration, l)),
            f = new o["default"](c.extend({}, i.pollingConfiguration, l));
        i["default"].xdr_streaming = h, i["default"].xdr_polling = f, i["default"].sockjs = u, e.__esModule = !0, e["default"] = i["default"]
    }, function(t, e, n) {
        "use strict";
        var i = n(20),
            o = n(21),
            r = n(9),
            s = n(2),
            a = new o["default"]({
                urls: i.ws,
                handlesActivityChecks: !1,
                supportsPing: !1,
                isInitialized: function() {
                    return Boolean(s["default"].getWebSocketAPI())
                },
                isSupported: function() {
                    return Boolean(s["default"].getWebSocketAPI())
                },
                getSocket: function(t) {
                    return s["default"].createWebSocket(t)
                }
            }),
            c = {
                urls: i.http,
                handlesActivityChecks: !1,
                supportsPing: !0,
                isInitialized: function() {
                    return !0
                }
            };
        e.streamingConfiguration = r.extend({
            getSocket: function(t) {
                return s["default"].HTTPFactory.createStreamingSocket(t)
            }
        }, c), e.pollingConfiguration = r.extend({
            getSocket: function(t) {
                return s["default"].HTTPFactory.createPollingSocket(t)
            }
        }, c);
        var u = {
                isSupported: function() {
                    return s["default"].isXHRSupported()
                }
            },
            l = new o["default"](r.extend({}, e.streamingConfiguration, u)),
            h = new o["default"](r.extend({}, e.pollingConfiguration, u)),
            f = {
                ws: a,
                xhr_streaming: l,
                xhr_polling: h
            };
        e.__esModule = !0, e["default"] = f
    }, function(t, e, n) {
        "use strict";

        function i(t, e, n) {
            var i = t + (e.encrypted ? "s" : ""),
                o = e.encrypted ? e.hostEncrypted : e.hostUnencrypted;
            return i + "://" + o + n
        }

        function o(t, e) {
            var n = "/app/" + t,
                i = "?protocol=" + r["default"].PROTOCOL + "&client=js&version=" + r["default"].VERSION + (e ? "&" + e : "");
            return n + i
        }
        var r = n(5);
        e.ws = {
            getInitial: function(t, e) {
                return i("ws", e, o(t, "flash=false"))
            }
        }, e.http = {
            getInitial: function(t, e) {
                var n = (e.httpPath || "/pusher") + o(t);
                return i("http", e, n)
            }
        }, e.sockjs = {
            getInitial: function(t, e) {
                return i("http", e, e.httpPath || "/pusher")
            },
            getPath: function(t, e) {
                return o(t)
            }
        }
    }, function(t, e, n) {
        "use strict";
        var i = n(22),
            o = function() {
                function t(t) {
                    this.hooks = t
                }
                return t.prototype.isSupported = function(t) {
                    return this.hooks.isSupported(t)
                }, t.prototype.createConnection = function(t, e, n, o) {
                    return new i["default"](this.hooks, t, e, n, o)
                }, t
            }();
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(11),
            r = n(9),
            s = n(23),
            a = n(8),
            c = n(2),
            u = function(t) {
                function e(e, n, i, o, r) {
                    t.call(this), this.initialize = c["default"].transportConnectionInitializer, this.hooks = e, this.name = n, this.priority = i, this.key = o, this.options = r, this.state = "new", this.timeline = r.timeline, this.activityTimeout = r.activityTimeout, this.id = this.timeline.generateUniqueID()
                }
                return i(e, t), e.prototype.handlesActivityChecks = function() {
                    return Boolean(this.hooks.handlesActivityChecks)
                }, e.prototype.supportsPing = function() {
                    return Boolean(this.hooks.supportsPing)
                }, e.prototype.connect = function() {
                    var t = this;
                    if (this.socket || "initialized" !== this.state) return !1;
                    var e = this.hooks.urls.getInitial(this.key, this.options);
                    try {
                        this.socket = this.hooks.getSocket(e, this.options)
                    } catch (n) {
                        return o["default"].defer(function() {
                            t.onError(n), t.changeState("closed")
                        }), !1
                    }
                    return this.bindListeners(), a["default"].debug("Connecting", {
                        transport: this.name,
                        url: e
                    }), this.changeState("connecting"), !0
                }, e.prototype.close = function() {
                    return this.socket ? (this.socket.close(), !0) : !1
                }, e.prototype.send = function(t) {
                    var e = this;
                    return "open" === this.state ? (o["default"].defer(function() {
                        e.socket && e.socket.send(t)
                    }), !0) : !1
                }, e.prototype.ping = function() {
                    "open" === this.state && this.supportsPing() && this.socket.ping()
                }, e.prototype.onOpen = function() {
                    this.hooks.beforeOpen && this.hooks.beforeOpen(this.socket, this.hooks.urls.getPath(this.key, this.options)), this.changeState("open"), this.socket.onopen = void 0
                }, e.prototype.onError = function(t) {
                    this.emit("error", {
                        type: "WebSocketError",
                        error: t
                    }), this.timeline.error(this.buildTimelineMessage({
                        error: t.toString()
                    }))
                }, e.prototype.onClose = function(t) {
                    t ? this.changeState("closed", {
                        code: t.code,
                        reason: t.reason,
                        wasClean: t.wasClean
                    }) : this.changeState("closed"), this.unbindListeners(), this.socket = void 0
                }, e.prototype.onMessage = function(t) {
                    this.emit("message", t)
                }, e.prototype.onActivity = function() {
                    this.emit("activity")
                }, e.prototype.bindListeners = function() {
                    var t = this;
                    this.socket.onopen = function() {
                        t.onOpen()
                    }, this.socket.onerror = function(e) {
                        t.onError(e)
                    }, this.socket.onclose = function(e) {
                        t.onClose(e)
                    }, this.socket.onmessage = function(e) {
                        t.onMessage(e)
                    }, this.supportsPing() && (this.socket.onactivity = function() {
                        t.onActivity()
                    })
                }, e.prototype.unbindListeners = function() {
                    this.socket && (this.socket.onopen = void 0, this.socket.onerror = void 0, this.socket.onclose = void 0, this.socket.onmessage = void 0, this.supportsPing() && (this.socket.onactivity = void 0))
                }, e.prototype.changeState = function(t, e) {
                    this.state = t, this.timeline.info(this.buildTimelineMessage({
                        state: t,
                        params: e
                    })), this.emit(t, e)
                }, e.prototype.buildTimelineMessage = function(t) {
                    return r.extend({
                        cid: this.id
                    }, t)
                }, e
            }(s["default"]);
        e.__esModule = !0, e["default"] = u
    }, function(t, e, n) {
        "use strict";
        var i = n(24),
            o = Function("return this")(),
            r = function() {
                function t(t) {
                    this.callbacks = new i["default"], this.global_callbacks = [], this.failThrough = t
                }
                return t.prototype.bind = function(t, e, n) {
                    return this.callbacks.add(t, e, n), this
                }, t.prototype.bind_all = function(t) {
                    return this.global_callbacks.push(t), this
                }, t.prototype.unbind = function(t, e, n) {
                    return this.callbacks.remove(t, e, n), this
                }, t.prototype.unbind_all = function(t, e) {
                    return this.callbacks.remove(t, e), this
                }, t.prototype.emit = function(t, e) {
                    var n;
                    for (n = 0; n < this.global_callbacks.length; n++) this.global_callbacks[n](t, e);
                    var i = this.callbacks.get(t);
                    if (i && i.length > 0)
                        for (n = 0; n < i.length; n++) i[n].fn.call(i[n].context || o, e);
                    else this.failThrough && this.failThrough(t, e);
                    return this
                }, t
            }();
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            return "_" + t
        }
        var o = n(9),
            r = function() {
                function t() {
                    this._callbacks = {}
                }
                return t.prototype.get = function(t) {
                    return this._callbacks[i(t)]
                }, t.prototype.add = function(t, e, n) {
                    var o = i(t);
                    this._callbacks[o] = this._callbacks[o] || [], this._callbacks[o].push({
                        fn: e,
                        context: n
                    })
                }, t.prototype.remove = function(t, e, n) {
                    if (!t && !e && !n) return void(this._callbacks = {});
                    var r = t ? [i(t)] : o.keys(this._callbacks);
                    e || n ? this.removeCallback(r, e, n) : this.removeAllCallbacks(r)
                }, t.prototype.removeCallback = function(t, e, n) {
                    o.apply(t, function(t) {
                        this._callbacks[t] = o.filter(this._callbacks[t] || [], function(t) {
                            return e && e !== t.fn || n && n !== t.context
                        }), 0 === this._callbacks[t].length && delete this._callbacks[t]
                    }, this)
                }, t.prototype.removeAllCallbacks = function(t) {
                    o.apply(t, function(t) {
                        delete this._callbacks[t]
                    }, this)
                }, t
            }();
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(23),
            r = function(t) {
                function e() {
                    t.call(this);
                    var e = this;
                    void 0 !== window.addEventListener && (window.addEventListener("online", function() {
                        e.emit("online")
                    }, !1), window.addEventListener("offline", function() {
                        e.emit("offline")
                    }, !1))
                }
                return i(e, t), e.prototype.isOnline = function() {
                    return void 0 === window.navigator.onLine ? !0 : window.navigator.onLine
                }, e
            }(o["default"]);
        e.NetInfo = r, e.Network = new r
    }, function(t, e) {
        "use strict";
        var n = function(t) {
            var e;
            return e = t.encrypted ? [":best_connected_ever", ":ws_loop", [":delayed", 2e3, [":http_fallback_loop"]]] : [":best_connected_ever", ":ws_loop", [":delayed", 2e3, [":wss_loop"]],
                [":delayed", 5e3, [":http_fallback_loop"]]
            ], [
                [":def", "ws_options", {
                    hostUnencrypted: t.wsHost + ":" + t.wsPort,
                    hostEncrypted: t.wsHost + ":" + t.wssPort
                }],
                [":def", "wss_options", [":extend", ":ws_options", {
                    encrypted: !0
                }]],
                [":def", "sockjs_options", {
                    hostUnencrypted: t.httpHost + ":" + t.httpPort,
                    hostEncrypted: t.httpHost + ":" + t.httpsPort,
                    httpPath: t.httpPath
                }],
                [":def", "timeouts", {
                    loop: !0,
                    timeout: 15e3,
                    timeoutLimit: 6e4
                }],
                [":def", "ws_manager", [":transport_manager", {
                    lives: 2,
                    minPingDelay: 1e4,
                    maxPingDelay: t.activity_timeout
                }]],
                [":def", "streaming_manager", [":transport_manager", {
                    lives: 2,
                    minPingDelay: 1e4,
                    maxPingDelay: t.activity_timeout
                }]],
                [":def_transport", "ws", "ws", 3, ":ws_options", ":ws_manager"],
                [":def_transport", "wss", "ws", 3, ":wss_options", ":ws_manager"],
                [":def_transport", "sockjs", "sockjs", 1, ":sockjs_options"],
                [":def_transport", "xhr_streaming", "xhr_streaming", 1, ":sockjs_options", ":streaming_manager"],
                [":def_transport", "xdr_streaming", "xdr_streaming", 1, ":sockjs_options", ":streaming_manager"],
                [":def_transport", "xhr_polling", "xhr_polling", 1, ":sockjs_options"],
                [":def_transport", "xdr_polling", "xdr_polling", 1, ":sockjs_options"],
                [":def", "ws_loop", [":sequential", ":timeouts", ":ws"]],
                [":def", "wss_loop", [":sequential", ":timeouts", ":wss"]],
                [":def", "sockjs_loop", [":sequential", ":timeouts", ":sockjs"]],
                [":def", "streaming_loop", [":sequential", ":timeouts", [":if", [":is_supported", ":xhr_streaming"], ":xhr_streaming", ":xdr_streaming"]]],
                [":def", "polling_loop", [":sequential", ":timeouts", [":if", [":is_supported", ":xhr_polling"], ":xhr_polling", ":xdr_polling"]]],
                [":def", "http_loop", [":if", [":is_supported", ":streaming_loop"],
                    [":best_connected_ever", ":streaming_loop", [":delayed", 4e3, [":polling_loop"]]],
                    [":polling_loop"]
                ]],
                [":def", "http_fallback_loop", [":if", [":is_supported", ":http_loop"],
                    [":http_loop"],
                    [":sockjs_loop"]
                ]],
                [":def", "strategy", [":cached", 18e5, [":first_connected", [":if", [":is_supported", ":ws"], e, ":http_fallback_loop"]]]]
            ]
        };
        e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";

        function i() {
            var t = this;
            t.timeline.info(t.buildTimelineMessage({
                transport: t.name + (t.options.encrypted ? "s" : "")
            })), t.hooks.isInitialized() ? t.changeState("initialized") : t.hooks.file ? (t.changeState("initializing"), o.Dependencies.load(t.hooks.file, {
                encrypted: t.options.encrypted
            }, function(e, n) {
                t.hooks.isInitialized() ? (t.changeState("initialized"), n(!0)) : (e && t.onError(e), t.onClose(), n(!1))
            })) : t.onClose()
        }
        var o = n(3);
        e.__esModule = !0, e["default"] = i
    }, function(t, e, n) {
        "use strict";
        var i = n(29),
            o = n(31);
        o["default"].createXDR = function(t, e) {
            return this.createRequest(i["default"], t, e)
        }, e.__esModule = !0, e["default"] = o["default"]
    }, function(t, e, n) {
        "use strict";
        var i = n(30),
            o = {
                getRequest: function(t) {
                    var e = new window.XDomainRequest;
                    return e.ontimeout = function() {
                        t.emit("error", new i.RequestTimedOut), t.close()
                    }, e.onerror = function(e) {
                        t.emit("error", e), t.close()
                    }, e.onprogress = function() {
                        e.responseText && e.responseText.length > 0 && t.onChunk(200, e.responseText)
                    }, e.onload = function() {
                        e.responseText && e.responseText.length > 0 && t.onChunk(200, e.responseText), t.emit("finished", 200), t.close()
                    }, e
                },
                abortRequest: function(t) {
                    t.ontimeout = t.onerror = t.onprogress = t.onload = null, t.abort()
                }
            };
        e.__esModule = !0, e["default"] = o
    }, function(t, e) {
        "use strict";
        var n = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            i = function(t) {
                function e() {
                    t.apply(this, arguments)
                }
                return n(e, t), e
            }(Error);
        e.BadEventName = i;
        var o = function(t) {
            function e() {
                t.apply(this, arguments)
            }
            return n(e, t), e
        }(Error);
        e.RequestTimedOut = o;
        var r = function(t) {
            function e() {
                t.apply(this, arguments)
            }
            return n(e, t), e
        }(Error);
        e.TransportPriorityTooLow = r;
        var s = function(t) {
            function e() {
                t.apply(this, arguments)
            }
            return n(e, t), e
        }(Error);
        e.TransportClosed = s;
        var a = function(t) {
            function e() {
                t.apply(this, arguments)
            }
            return n(e, t), e
        }(Error);
        e.UnsupportedTransport = a;
        var c = function(t) {
            function e() {
                t.apply(this, arguments)
            }
            return n(e, t), e
        }(Error);
        e.UnsupportedStrategy = c
    }, function(t, e, n) {
        "use strict";
        var i = n(32),
            o = n(33),
            r = n(35),
            s = n(36),
            a = n(37),
            c = {
                createStreamingSocket: function(t) {
                    return this.createSocket(r["default"], t)
                },
                createPollingSocket: function(t) {
                    return this.createSocket(s["default"], t)
                },
                createSocket: function(t, e) {
                    return new o["default"](t, e)
                },
                createXHR: function(t, e) {
                    return this.createRequest(a["default"], t, e)
                },
                createRequest: function(t, e, n) {
                    return new i["default"](t, e, n)
                }
            };
        e.__esModule = !0, e["default"] = c
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(2),
            r = n(23),
            s = 262144,
            a = function(t) {
                function e(e, n, i) {
                    t.call(this), this.hooks = e, this.method = n, this.url = i
                }
                return i(e, t), e.prototype.start = function(t) {
                    var e = this;
                    this.position = 0, this.xhr = this.hooks.getRequest(this), this.unloader = function() {
                        e.close()
                    }, o["default"].addUnloadListener(this.unloader), this.xhr.open(this.method, this.url, !0), this.xhr.setRequestHeader && this.xhr.setRequestHeader("Content-Type", "application/json"), this.xhr.send(t)
                }, e.prototype.close = function() {
                    this.unloader && (o["default"].removeUnloadListener(this.unloader), this.unloader = null), this.xhr && (this.hooks.abortRequest(this.xhr), this.xhr = null)
                }, e.prototype.onChunk = function(t, e) {
                    for (;;) {
                        var n = this.advanceBuffer(e);
                        if (!n) break;
                        this.emit("chunk", {
                            status: t,
                            data: n
                        })
                    }
                    this.isBufferTooLong(e) && this.emit("buffer_too_long")
                }, e.prototype.advanceBuffer = function(t) {
                    var e = t.slice(this.position),
                        n = e.indexOf("\n");
                    return -1 !== n ? (this.position += n + 1, e.slice(0, n)) : null
                }, e.prototype.isBufferTooLong = function(t) {
                    return this.position === t.length && t.length > s
                }, e
            }(r["default"]);
        e.__esModule = !0, e["default"] = a
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            var e = /([^\?]*)\/*(\??.*)/.exec(t);
            return {
                base: e[1],
                queryString: e[2]
            }
        }

        function o(t, e) {
            return t.base + "/" + e + "/xhr_send"
        }

        function r(t) {
            var e = -1 === t.indexOf("?") ? "?" : "&";
            return t + e + "t=" + +new Date + "&n=" + f++
        }

        function s(t, e) {
            var n = /(https?:\/\/)([^\/:]+)((\/|:)?.*)/.exec(t);
            return n[1] + e + n[3]
        }

        function a(t) {
            return Math.floor(Math.random() * t)
        }

        function c(t) {
            for (var e = [], n = 0; t > n; n++) e.push(a(32).toString(32));
            return e.join("")
        }
        var u = n(34),
            l = n(11),
            h = n(2),
            f = 1,
            p = function() {
                function t(t, e) {
                    this.hooks = t, this.session = a(1e3) + "/" + c(8), this.location = i(e), this.readyState = u["default"].CONNECTING, this.openStream()
                }
                return t.prototype.send = function(t) {
                    return this.sendRaw(JSON.stringify([t]))
                }, t.prototype.ping = function() {
                    this.hooks.sendHeartbeat(this)
                }, t.prototype.close = function(t, e) {
                    this.onClose(t, e, !0)
                }, t.prototype.sendRaw = function(t) {
                    if (this.readyState !== u["default"].OPEN) return !1;
                    try {
                        return h["default"].createSocketRequest("POST", r(o(this.location, this.session))).start(t), !0
                    } catch (e) {
                        return !1
                    }
                }, t.prototype.reconnect = function() {
                    this.closeStream(), this.openStream()
                }, t.prototype.onClose = function(t, e, n) {
                    this.closeStream(), this.readyState = u["default"].CLOSED, this.onclose && this.onclose({
                        code: t,
                        reason: e,
                        wasClean: n
                    })
                }, t.prototype.onChunk = function(t) {
                    if (200 === t.status) {
                        this.readyState === u["default"].OPEN && this.onActivity();
                        var e, n = t.data.slice(0, 1);
                        switch (n) {
                            case "o":
                                e = JSON.parse(t.data.slice(1) || "{}"),
                                    this.onOpen(e);
                                break;
                            case "a":
                                e = JSON.parse(t.data.slice(1) || "[]");
                                for (var i = 0; i < e.length; i++) this.onEvent(e[i]);
                                break;
                            case "m":
                                e = JSON.parse(t.data.slice(1) || "null"), this.onEvent(e);
                                break;
                            case "h":
                                this.hooks.onHeartbeat(this);
                                break;
                            case "c":
                                e = JSON.parse(t.data.slice(1) || "[]"), this.onClose(e[0], e[1], !0)
                        }
                    }
                }, t.prototype.onOpen = function(t) {
                    this.readyState === u["default"].CONNECTING ? (t && t.hostname && (this.location.base = s(this.location.base, t.hostname)), this.readyState = u["default"].OPEN, this.onopen && this.onopen()) : this.onClose(1006, "Server lost session", !0)
                }, t.prototype.onEvent = function(t) {
                    this.readyState === u["default"].OPEN && this.onmessage && this.onmessage({
                        data: t
                    })
                }, t.prototype.onActivity = function() {
                    this.onactivity && this.onactivity()
                }, t.prototype.onError = function(t) {
                    this.onerror && this.onerror(t)
                }, t.prototype.openStream = function() {
                    var t = this;
                    this.stream = h["default"].createSocketRequest("POST", r(this.hooks.getReceiveURL(this.location, this.session))), this.stream.bind("chunk", function(e) {
                        t.onChunk(e)
                    }), this.stream.bind("finished", function(e) {
                        t.hooks.onFinished(t, e)
                    }), this.stream.bind("buffer_too_long", function() {
                        t.reconnect()
                    });
                    try {
                        this.stream.start()
                    } catch (e) {
                        l["default"].defer(function() {
                            t.onError(e), t.onClose(1006, "Could not start streaming", !1)
                        })
                    }
                }, t.prototype.closeStream = function() {
                    this.stream && (this.stream.unbind_all(), this.stream.close(), this.stream = null)
                }, t
            }();
        e.__esModule = !0, e["default"] = p
    }, function(t, e) {
        "use strict";
        var n;
        ! function(t) {
            t[t.CONNECTING = 0] = "CONNECTING", t[t.OPEN = 1] = "OPEN", t[t.CLOSED = 3] = "CLOSED"
        }(n || (n = {})), e.__esModule = !0, e["default"] = n
    }, function(t, e) {
        "use strict";
        var n = {
            getReceiveURL: function(t, e) {
                return t.base + "/" + e + "/xhr_streaming" + t.queryString
            },
            onHeartbeat: function(t) {
                t.sendRaw("[]")
            },
            sendHeartbeat: function(t) {
                t.sendRaw("[]")
            },
            onFinished: function(t, e) {
                t.onClose(1006, "Connection interrupted (" + e + ")", !1)
            }
        };
        e.__esModule = !0, e["default"] = n
    }, function(t, e) {
        "use strict";
        var n = {
            getReceiveURL: function(t, e) {
                return t.base + "/" + e + "/xhr" + t.queryString
            },
            onHeartbeat: function() {},
            sendHeartbeat: function(t) {
                t.sendRaw("[]")
            },
            onFinished: function(t, e) {
                200 === e ? t.reconnect() : t.onClose(1006, "Connection interrupted (" + e + ")", !1)
            }
        };
        e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";
        var i = n(2),
            o = {
                getRequest: function(t) {
                    var e = i["default"].getXHRAPI(),
                        n = new e;
                    return n.onreadystatechange = n.onprogress = function() {
                        switch (n.readyState) {
                            case 3:
                                n.responseText && n.responseText.length > 0 && t.onChunk(n.status, n.responseText);
                                break;
                            case 4:
                                n.responseText && n.responseText.length > 0 && t.onChunk(n.status, n.responseText), t.emit("finished", n.status), t.close()
                        }
                    }, n
                },
                abortRequest: function(t) {
                    t.onreadystatechange = null, t.abort()
                }
            };
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";
        var i = n(9),
            o = n(11),
            r = n(39),
            s = function() {
                function t(t, e, n) {
                    this.key = t, this.session = e, this.events = [], this.options = n || {}, this.sent = 0, this.uniqueID = 0
                }
                return t.prototype.log = function(t, e) {
                    t <= this.options.level && (this.events.push(i.extend({}, e, {
                        timestamp: o["default"].now()
                    })), this.options.limit && this.events.length > this.options.limit && this.events.shift())
                }, t.prototype.error = function(t) {
                    this.log(r["default"].ERROR, t)
                }, t.prototype.info = function(t) {
                    this.log(r["default"].INFO, t)
                }, t.prototype.debug = function(t) {
                    this.log(r["default"].DEBUG, t)
                }, t.prototype.isEmpty = function() {
                    return 0 === this.events.length
                }, t.prototype.send = function(t, e) {
                    var n = this,
                        o = i.extend({
                            session: this.session,
                            bundle: this.sent + 1,
                            key: this.key,
                            lib: "js",
                            version: this.options.version,
                            cluster: this.options.cluster,
                            features: this.options.features,
                            timeline: this.events
                        }, this.options.params);
                    return this.events = [], t(o, function(t, i) {
                        t || n.sent++, e && e(t, i)
                    }), !0
                }, t.prototype.generateUniqueID = function() {
                    return this.uniqueID++, this.uniqueID
                }, t
            }();
        e.__esModule = !0, e["default"] = s
    }, function(t, e) {
        "use strict";
        var n;
        ! function(t) {
            t[t.ERROR = 3] = "ERROR", t[t.INFO = 6] = "INFO", t[t.DEBUG = 7] = "DEBUG"
        }(n || (n = {})), e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            return function(e) {
                return [t.apply(this, arguments), e]
            }
        }

        function o(t) {
            return "string" == typeof t && ":" === t.charAt(0)
        }

        function r(t, e) {
            return e[t.slice(1)]
        }

        function s(t, e) {
            if (0 === t.length) return [
                [], e
            ];
            var n = u(t[0], e),
                i = s(t.slice(1), n[1]);
            return [
                [n[0]].concat(i[0]), i[1]
            ]
        }

        function a(t, e) {
            if (!o(t)) return [t, e];
            var n = r(t, e);
            if (void 0 === n) throw "Undefined symbol " + t;
            return [n, e]
        }

        function c(t, e) {
            if (o(t[0])) {
                var n = r(t[0], e);
                if (t.length > 1) {
                    if ("function" != typeof n) throw "Calling non-function " + t[0];
                    var i = [l.extend({}, e)].concat(l.map(t.slice(1), function(t) {
                        return u(t, l.extend({}, e))[0]
                    }));
                    return n.apply(this, i)
                }
                return [n, e]
            }
            return s(t, e)
        }

        function u(t, e) {
            return "string" == typeof t ? a(t, e) : "object" == typeof t && t instanceof Array && t.length > 0 ? c(t, e) : [t, e]
        }
        var l = n(9),
            h = n(11),
            f = n(41),
            p = n(30),
            d = n(55),
            y = n(56),
            m = n(57),
            v = n(58),
            g = n(59),
            _ = n(60),
            b = n(61),
            k = n(2),
            w = k["default"].Transports;
        e.build = function(t, e) {
            var n = l.extend({}, C, e);
            return u(t, n)[1].strategy
        };
        var S = {
                isSupported: function() {
                    return !1
                },
                connect: function(t, e) {
                    var n = h["default"].defer(function() {
                        e(new p.UnsupportedStrategy)
                    });
                    return {
                        abort: function() {
                            n.ensureAborted()
                        },
                        forceMinPriority: function() {}
                    }
                }
            },
            C = {
                extend: function(t, e, n) {
                    return [l.extend({}, e, n), t]
                },
                def: function(t, e, n) {
                    if (void 0 !== t[e]) throw "Redefining symbol " + e;
                    return t[e] = n, [void 0, t]
                },
                def_transport: function(t, e, n, i, o, r) {
                    var s = w[n];
                    if (!s) throw new p.UnsupportedTransport(n);
                    var a, c = !(t.enabledTransports && -1 === l.arrayIndexOf(t.enabledTransports, e) || t.disabledTransports && -1 !== l.arrayIndexOf(t.disabledTransports, e));
                    a = c ? new d["default"](e, i, r ? r.getAssistant(s) : s, l.extend({
                        key: t.key,
                        encrypted: t.encrypted,
                        timeline: t.timeline,
                        ignoreNullOrigin: t.ignoreNullOrigin
                    }, o)) : S;
                    var u = t.def(t, e, a)[1];
                    return u.Transports = t.Transports || {}, u.Transports[e] = a, [void 0, u]
                },
                transport_manager: i(function(t, e) {
                    return new f["default"](e)
                }),
                sequential: i(function(t, e) {
                    var n = Array.prototype.slice.call(arguments, 2);
                    return new y["default"](n, e)
                }),
                cached: i(function(t, e, n) {
                    return new v["default"](n, t.Transports, {
                        ttl: e,
                        timeline: t.timeline,
                        encrypted: t.encrypted
                    })
                }),
                first_connected: i(function(t, e) {
                    return new b["default"](e)
                }),
                best_connected_ever: i(function() {
                    var t = Array.prototype.slice.call(arguments, 1);
                    return new m["default"](t)
                }),
                delayed: i(function(t, e, n) {
                    return new g["default"](n, {
                        delay: e
                    })
                }),
                "if": i(function(t, e, n, i) {
                    return new _["default"](e, n, i)
                }),
                is_supported: i(function(t, e) {
                    return function() {
                        return e.isSupported()
                    }
                })
            }
    }, function(t, e, n) {
        "use strict";
        var i = n(42),
            o = function() {
                function t(t) {
                    this.options = t || {}, this.livesLeft = this.options.lives || 1 / 0
                }
                return t.prototype.getAssistant = function(t) {
                    return i["default"].createAssistantToTheTransportManager(this, t, {
                        minPingDelay: this.options.minPingDelay,
                        maxPingDelay: this.options.maxPingDelay
                    })
                }, t.prototype.isAlive = function() {
                    return this.livesLeft > 0
                }, t.prototype.reportDeath = function() {
                    this.livesLeft -= 1
                }, t
            }();
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";
        var i = n(43),
            o = n(44),
            r = n(47),
            s = n(48),
            a = n(49),
            c = n(50),
            u = n(51),
            l = n(53),
            h = n(54),
            f = {
                createChannels: function() {
                    return new h["default"]
                },
                createConnectionManager: function(t, e) {
                    return new l["default"](t, e)
                },
                createChannel: function(t, e) {
                    return new u["default"](t, e)
                },
                createPrivateChannel: function(t, e) {
                    return new c["default"](t, e)
                },
                createPresenceChannel: function(t, e) {
                    return new a["default"](t, e)
                },
                createTimelineSender: function(t, e) {
                    return new s["default"](t, e)
                },
                createAuthorizer: function(t, e) {
                    return new r["default"](t, e)
                },
                createHandshake: function(t, e) {
                    return new o["default"](t, e)
                },
                createAssistantToTheTransportManager: function(t, e, n) {
                    return new i["default"](t, e, n)
                }
            };
        e.__esModule = !0, e["default"] = f
    }, function(t, e, n) {
        "use strict";
        var i = n(11),
            o = n(9),
            r = function() {
                function t(t, e, n) {
                    this.manager = t, this.transport = e, this.minPingDelay = n.minPingDelay, this.maxPingDelay = n.maxPingDelay, this.pingDelay = void 0
                }
                return t.prototype.createConnection = function(t, e, n, r) {
                    var s = this;
                    r = o.extend({}, r, {
                        activityTimeout: this.pingDelay
                    });
                    var a = this.transport.createConnection(t, e, n, r),
                        c = null,
                        u = function() {
                            a.unbind("open", u), a.bind("closed", l), c = i["default"].now()
                        },
                        l = function(t) {
                            if (a.unbind("closed", l), 1002 === t.code || 1003 === t.code) s.manager.reportDeath();
                            else if (!t.wasClean && c) {
                                var e = i["default"].now() - c;
                                e < 2 * s.maxPingDelay && (s.manager.reportDeath(), s.pingDelay = Math.max(e / 2, s.minPingDelay))
                            }
                        };
                    return a.bind("open", u), a
                }, t.prototype.isSupported = function(t) {
                    return this.manager.isAlive() && this.transport.isSupported(t)
                }, t
            }();
        e.__esModule = !0, e["default"] = r
    }, function(t, e, n) {
        "use strict";
        var i = n(9),
            o = n(45),
            r = n(46),
            s = function() {
                function t(t, e) {
                    this.transport = t, this.callback = e, this.bindListeners()
                }
                return t.prototype.close = function() {
                    this.unbindListeners(), this.transport.close()
                }, t.prototype.bindListeners = function() {
                    var t = this;
                    this.onMessage = function(e) {
                        t.unbindListeners();
                        var n;
                        try {
                            n = o.processHandshake(e)
                        } catch (i) {
                            return t.finish("error", {
                                error: i
                            }), void t.transport.close()
                        }
                        "connected" === n.action ? t.finish("connected", {
                            connection: new r["default"](n.id, t.transport),
                            activityTimeout: n.activityTimeout
                        }) : (t.finish(n.action, {
                            error: n.error
                        }), t.transport.close())
                    }, this.onClosed = function(e) {
                        t.unbindListeners();
                        var n = o.getCloseAction(e) || "backoff",
                            i = o.getCloseError(e);
                        t.finish(n, {
                            error: i
                        })
                    }, this.transport.bind("message", this.onMessage), this.transport.bind("closed", this.onClosed)
                }, t.prototype.unbindListeners = function() {
                    this.transport.unbind("message", this.onMessage), this.transport.unbind("closed", this.onClosed)
                }, t.prototype.finish = function(t, e) {
                    this.callback(i.extend({
                        transport: this.transport,
                        action: t
                    }, e))
                }, t
            }();
        e.__esModule = !0, e["default"] = s
    }, function(t, e) {
        "use strict";
        e.decodeMessage = function(t) {
            try {
                var e = JSON.parse(t.data);
                if ("string" == typeof e.data) try {
                    e.data = JSON.parse(e.data)
                } catch (n) {
                    if (!(n instanceof SyntaxError)) throw n
                }
                return e
            } catch (n) {
                throw {
                    type: "MessageParseError",
                    error: n,
                    data: t.data
                }
            }
        }, e.encodeMessage = function(t) {
            return JSON.stringify(t)
        }, e.processHandshake = function(t) {
            if (t = e.decodeMessage(t), "pusher:connection_established" === t.event) {
                if (!t.data.activity_timeout) throw "No activity timeout specified in handshake";
                return {
                    action: "connected",
                    id: t.data.socket_id,
                    activityTimeout: 1e3 * t.data.activity_timeout
                }
            }
            if ("pusher:error" === t.event) return {
                action: this.getCloseAction(t.data),
                error: this.getCloseError(t.data)
            };
            throw "Invalid handshake"
        }, e.getCloseAction = function(t) {
            return t.code < 4e3 ? t.code >= 1002 && t.code <= 1004 ? "backoff" : null : 4e3 === t.code ? "ssl_only" : t.code < 4100 ? "refused" : t.code < 4200 ? "backoff" : t.code < 4300 ? "retry" : "refused"
        }, e.getCloseError = function(t) {
            return 1e3 !== t.code && 1001 !== t.code ? {
                type: "PusherError",
                data: {
                    code: t.code,
                    message: t.reason || t.message
                }
            } : null
        }
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(9),
            r = n(23),
            s = n(45),
            a = n(8),
            c = function(t) {
                function e(e, n) {
                    t.call(this), this.id = e, this.transport = n, this.activityTimeout = n.activityTimeout, this.bindListeners()
                }
                return i(e, t), e.prototype.handlesActivityChecks = function() {
                    return this.transport.handlesActivityChecks()
                }, e.prototype.send = function(t) {
                    return this.transport.send(t)
                }, e.prototype.send_event = function(t, e, n) {
                    var i = {
                        event: t,
                        data: e
                    };
                    return n && (i.channel = n), a["default"].debug("Event sent", i), this.send(s.encodeMessage(i))
                }, e.prototype.ping = function() {
                    this.transport.supportsPing() ? this.transport.ping() : this.send_event("pusher:ping", {})
                }, e.prototype.close = function() {
                    this.transport.close()
                }, e.prototype.bindListeners = function() {
                    var t = this,
                        e = {
                            message: function(e) {
                                var n;
                                try {
                                    n = s.decodeMessage(e)
                                } catch (i) {
                                    t.emit("error", {
                                        type: "MessageParseError",
                                        error: i,
                                        data: e.data
                                    })
                                }
                                if (void 0 !== n) {
                                    switch (a["default"].debug("Event recd", n), n.event) {
                                        case "pusher:error":
                                            t.emit("error", {
                                                type: "PusherError",
                                                data: n.data
                                            });
                                            break;
                                        case "pusher:ping":
                                            t.emit("ping");
                                            break;
                                        case "pusher:pong":
                                            t.emit("pong")
                                    }
                                    t.emit("message", n)
                                }
                            },
                            activity: function() {
                                t.emit("activity")
                            },
                            error: function(e) {
                                t.emit("error", {
                                    type: "WebSocketError",
                                    error: e
                                })
                            },
                            closed: function(e) {
                                n(), e && e.code && t.handleCloseEvent(e), t.transport = null, t.emit("closed")
                            }
                        },
                        n = function() {
                            o.objectApply(e, function(e, n) {
                                t.transport.unbind(n, e)
                            })
                        };
                    o.objectApply(e, function(e, n) {
                        t.transport.bind(n, e)
                    })
                }, e.prototype.handleCloseEvent = function(t) {
                    var e = s.getCloseAction(t),
                        n = s.getCloseError(t);
                    n && this.emit("error", n), e && this.emit(e)
                }, e
            }(r["default"]);
        e.__esModule = !0, e["default"] = c
    }, function(t, e, n) {
        "use strict";
        var i = n(2),
            o = function() {
                function t(t, e) {
                    this.channel = t;
                    var n = e.authTransport;
                    if ("undefined" == typeof i["default"].getAuthorizers()[n]) throw "'" + n + "' is not a recognized auth transport";
                    this.type = n, this.options = e, this.authOptions = (e || {}).auth || {}
                }
                return t.prototype.composeQuery = function(t) {
                    var e = "socket_id=" + encodeURIComponent(t) + "&channel_name=" + encodeURIComponent(this.channel.name);
                    for (var n in this.authOptions.params) e += "&" + encodeURIComponent(n) + "=" + encodeURIComponent(this.authOptions.params[n]);
                    return e
                }, t.prototype.authorize = function(e, n) {
                    return t.authorizers = t.authorizers || i["default"].getAuthorizers(), t.authorizers[this.type].call(this, i["default"], e, n)
                }, t
            }();
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";
        var i = n(2),
            o = function() {
                function t(t, e) {
                    this.timeline = t, this.options = e || {}
                }
                return t.prototype.send = function(t, e) {
                    this.timeline.isEmpty() || this.timeline.send(i["default"].TimelineTransport.getAgent(this, t), e)
                }, t
            }();
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(50),
            r = n(8),
            s = n(52),
            a = function(t) {
                function e(e, n) {
                    t.call(this, e, n), this.members = new s["default"]
                }
                return i(e, t), e.prototype.authorize = function(e, n) {
                    var i = this;
                    t.prototype.authorize.call(this, e, function(t, e) {
                        if (!t) {
                            if (void 0 === e.channel_data) return r["default"].warn("Invalid auth response for channel '" + i.name + "', expected 'channel_data' field"), void n("Invalid auth response");
                            var o = JSON.parse(e.channel_data);
                            i.members.setMyID(o.user_id)
                        }
                        n(t, e)
                    })
                }, e.prototype.handleEvent = function(t, e) {
                    switch (t) {
                        case "pusher_internal:subscription_succeeded":
                            this.members.onSubscription(e), this.subscribed = !0, this.emit("pusher:subscription_succeeded", this.members);
                            break;
                        case "pusher_internal:member_added":
                            var n = this.members.addMember(e);
                            this.emit("pusher:member_added", n);
                            break;
                        case "pusher_internal:member_removed":
                            var i = this.members.removeMember(e);
                            i && this.emit("pusher:member_removed", i);
                            break;
                        default:
                            o["default"].prototype.handleEvent.call(this, t, e)
                    }
                }, e.prototype.disconnect = function() {
                    this.members.reset(), t.prototype.disconnect.call(this)
                }, e
            }(o["default"]);
        e.__esModule = !0, e["default"] = a
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(42),
            r = n(51),
            s = function(t) {
                function e() {
                    t.apply(this, arguments)
                }
                return i(e, t), e.prototype.authorize = function(t, e) {
                    var n = o["default"].createAuthorizer(this, this.pusher.config);
                    return n.authorize(t, e)
                }, e
            }(r["default"]);
        e.__esModule = !0, e["default"] = s
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(23),
            r = n(30),
            s = n(8),
            a = function(t) {
                function e(e, n) {
                    t.call(this, function(t, n) {
                        s["default"].debug("No callbacks on " + e + " for " + t)
                    }), this.name = e, this.pusher = n, this.subscribed = !1
                }
                return i(e, t), e.prototype.authorize = function(t, e) {
                    return e(!1, {})
                }, e.prototype.trigger = function(t, e) {
                    if (0 !== t.indexOf("client-")) throw new r.BadEventName("Event '" + t + "' does not start with 'client-'");
                    return this.pusher.send_event(t, e, this.name)
                }, e.prototype.disconnect = function() {
                    this.subscribed = !1
                }, e.prototype.handleEvent = function(t, e) {
                    0 === t.indexOf("pusher_internal:") ? "pusher_internal:subscription_succeeded" === t && (this.subscribed = !0, this.emit("pusher:subscription_succeeded", e)) : this.emit(t, e)
                }, e.prototype.subscribe = function() {
                    var t = this;
                    this.authorize(this.pusher.connection.socket_id, function(e, n) {
                        e ? t.handleEvent("pusher:subscription_error", n) : t.pusher.send_event("pusher:subscribe", {
                            auth: n.auth,
                            channel_data: n.channel_data,
                            channel: t.name
                        })
                    })
                }, e.prototype.unsubscribe = function() {
                    this.pusher.send_event("pusher:unsubscribe", {
                        channel: this.name
                    })
                }, e
            }(o["default"]);
        e.__esModule = !0, e["default"] = a
    }, function(t, e, n) {
        "use strict";
        var i = n(9),
            o = function() {
                function t() {
                    this.reset()
                }
                return t.prototype.get = function(t) {
                    return Object.prototype.hasOwnProperty.call(this.members, t) ? {
                        id: t,
                        info: this.members[t]
                    } : null
                }, t.prototype.each = function(t) {
                    var e = this;
                    i.objectApply(this.members, function(n, i) {
                        t(e.get(i))
                    })
                }, t.prototype.setMyID = function(t) {
                    this.myID = t
                }, t.prototype.onSubscription = function(t) {
                    this.members = t.presence.hash, this.count = t.presence.count, this.me = this.get(this.myID)
                }, t.prototype.addMember = function(t) {
                    return null === this.get(t.user_id) && this.count++, this.members[t.user_id] = t.user_info, this.get(t.user_id)
                }, t.prototype.removeMember = function(t) {
                    var e = this.get(t.user_id);
                    return e && (delete this.members[t.user_id], this.count--), e
                }, t.prototype.reset = function() {
                    this.members = {}, this.count = 0, this.myID = null, this.me = null
                }, t
            }();
        e.__esModule = !0, e["default"] = o
    }, function(t, e, n) {
        "use strict";
        var i = this && this.__extends || function(t, e) {
                function n() {
                    this.constructor = t
                }
                for (var i in e) e.hasOwnProperty(i) && (t[i] = e[i]);
                t.prototype = null === e ? Object.create(e) : (n.prototype = e.prototype, new n)
            },
            o = n(23),
            r = n(12),
            s = n(8),
            a = n(9),
            c = n(2),
            u = function(t) {
                function e(e, n) {
                    var i = this;
                    t.call(this), this.key = e, this.options = n || {}, this.state = "initialized", this.connection = null, this.encrypted = !!n.encrypted, this.timeline = this.options.timeline, this.connectionCallbacks = this.buildConnectionCallbacks(), this.errorCallbacks = this.buildErrorCallbacks(), this.handshakeCallbacks = this.buildHandshakeCallbacks(this.errorCallbacks);
                    var o = c["default"].getNetwork();
                    o.bind("online", function() {
                        i.timeline.info({
                            netinfo: "online"
                        }), ("connecting" === i.state || "unavailable" === i.state) && i.retryIn(0)
                    }), o.bind("offline", function() {
                        i.timeline.info({
                            netinfo: "offline"
                        }), i.connection && i.sendActivityCheck()
                    }), this.updateStrategy()
                }
                return i(e, t), e.prototype.connect = function() {
                    if (!this.connection && !this.runner) {
                        if (!this.strategy.isSupported()) return void this.updateState("failed");
                        this.updateState("connecting"), this.startConnecting(), this.setUnavailableTimer()
                    }
                }, e.prototype.send = function(t) {
                    return this.connection ? this.connection.send(t) : !1
                }, e.prototype.send_event = function(t, e, n) {
                    return this.connection ? this.connection.send_event(t, e, n) : !1
                }, e.prototype.disconnect = function() {
                    this.disconnectInternally(), this.updateState("disconnected")
                }, e.prototype.isEncrypted = function() {
                    return this.encrypted
                }, e.prototype.startConnecting = function() {
                    var t = this,
                        e = function(n, i) {
                            n ? t.runner = t.strategy.connect(0, e) : "error" === i.action ? (t.emit("error", {
                                type: "HandshakeError",
                                error: i.error
                            }), t.timeline.error({
                                handshakeError: i.error
                            })) : (t.abortConnecting(), t.handshakeCallbacks[i.action](i))
                        };
                    this.runner = this.strategy.connect(0, e)
                }, e.prototype.abortConnecting = function() {
                    this.runner && (this.runner.abort(), this.runner = null)
                }, e.prototype.disconnectInternally = function() {
                    if (this.abortConnecting(), this.clearRetryTimer(), this.clearUnavailableTimer(), this.connection) {
                        var t = this.abandonConnection();
                        t.close()
                    }
                }, e.prototype.updateStrategy = function() {
                    this.strategy = this.options.getStrategy({
                        key: this.key,
                        timeline: this.timeline,
                        encrypted: this.encrypted
                    })
                }, e.prototype.retryIn = function(t) {
                    var e = this;
                    this.timeline.info({
                        action: "retry",
                        delay: t
                    }), t > 0 && this.emit("connecting_in", Math.round(t / 1e3)), this.retryTimer = new r.OneOffTimer(t || 0, function() {
                        e.disconnectInternally(), e.connect()
                    })
                }, e.prototype.clearRetryTimer = function() {
                    this.retryTimer && (this.retryTimer.ensureAborted(), this.retryTimer = null)
                }, e.prototype.setUnavailableTimer = function() {
                    var t = this;
                    this.unavailableTimer = new r.OneOffTimer(this.options.unavailableTimeout, function() {
                        t.updateState("unavailable")
                    })
                }, e.prototype.clearUnavailableTimer = function() {
                    this.unavailableTimer && this.unavailableTimer.ensureAborted()
                }, e.prototype.sendActivityCheck = function() {
                    var t = this;
                    this.stopActivityCheck(), this.connection.ping(), this.activityTimer = new r.OneOffTimer(this.options.pongTimeout, function() {
                        t.timeline.error({
                            pong_timed_out: t.options.pongTimeout
                        }), t.retryIn(0)
                    })
                }, e.prototype.resetActivityCheck = function() {
                    var t = this;
                    this.stopActivityCheck(), this.connection.handlesActivityChecks() || (this.activityTimer = new r.OneOffTimer(this.activityTimeout, function() {
                        t.sendActivityCheck()
                    }))
                }, e.prototype.stopActivityCheck = function() {
                    this.activityTimer && this.activityTimer.ensureAborted()
                }, e.prototype.buildConnectionCallbacks = function() {
                    var t = this;
                    return {
                        message: function(e) {
                            t.resetActivityCheck(), t.emit("message", e)
                        },
                        ping: function() {
                            t.send_event("pusher:pong", {})
                        },
                        activity: function() {
                            t.resetActivityCheck()
                        },
                        error: function(e) {
                            t.emit("error", {
                                type: "WebSocketError",
                                error: e
                            })
                        },
                        closed: function() {
                            t.abandonConnection(), t.shouldRetry() && t.retryIn(1e3)
                        }
                    }
                }, e.prototype.buildHandshakeCallbacks = function(t) {
                    var e = this;
                    return a.extend({}, t, {
                        connected: function(t) {
                            e.activityTimeout = Math.min(e.options.activityTimeout, t.activityTimeout, t.connection.activityTimeout || 1 / 0), e.clearUnavailableTimer(), e.setConnection(t.connection), e.socket_id = e.connection.id, e.updateState("connected", {
                                socket_id: e.socket_id
                            })
                        }
                    })
                }, e.prototype.buildErrorCallbacks = function() {
                    var t = this,
                        e = function(e) {
                            return function(n) {
                                n.error && t.emit("error", {
                                    type: "WebSocketError",
                                    error: n.error
                                }), e(n)
                            }
                        };
                    return {
                        ssl_only: e(function() {
                            t.encrypted = !0, t.updateStrategy(), t.retryIn(0)
                        }),
                        refused: e(function() {
                            t.disconnect()
                        }),
                        backoff: e(function() {
                            t.retryIn(1e3)
                        }),
                        retry: e(function() {
                            t.retryIn(0)
                        })
                    }
                }, e.prototype.setConnection = function(t) {
                    this.connection = t;
                    for (var e in this.connectionCallbacks) this.connection.bind(e, this.connectionCallbacks[e]);
                    this.resetActivityCheck()
                }, e.prototype.abandonConnection = function() {
                    if (this.connection) {
                        this.stopActivityCheck();
                        for (var t in this.connectionCallbacks) this.connection.unbind(t, this.connectionCallbacks[t]);
                        var e = this.connection;
                        return this.connection = null, e
                    }
                }, e.prototype.updateState = function(t, e) {
                    var n = this.state;
                    if (this.state = t, n !== t) {
                        var i = t;
                        "connected" === i && (i += " with new socket ID " + e.socket_id), s["default"].debug("State changed", n + " -> " + i), this.timeline.info({
                            state: t,
                            params: e
                        }), this.emit("state_change", {
                            previous: n,
                            current: t
                        }), this.emit(t, e)
                    }
                }, e.prototype.shouldRetry = function() {
                    return "connecting" === this.state || "connected" === this.state
                }, e
            }(o["default"]);
        e.__esModule = !0, e["default"] = u
    }, function(t, e, n) {
        "use strict";

        function i(t, e) {
            return 0 === t.indexOf("private-") ? r["default"].createPrivateChannel(t, e) : 0 === t.indexOf("presence-") ? r["default"].createPresenceChannel(t, e) : r["default"].createChannel(t, e)
        }
        var o = n(9),
            r = n(42),
            s = function() {
                function t() {
                    this.channels = {}
                }
                return t.prototype.add = function(t, e) {
                    return this.channels[t] || (this.channels[t] = i(t, e)), this.channels[t]
                }, t.prototype.all = function() {
                    return o.values(this.channels)
                }, t.prototype.find = function(t) {
                    return this.channels[t]
                }, t.prototype.remove = function(t) {
                    var e = this.channels[t];
                    return delete this.channels[t], e
                }, t.prototype.disconnect = function() {
                    o.objectApply(this.channels, function(t) {
                        t.disconnect()
                    })
                }, t
            }();
        e.__esModule = !0, e["default"] = s
    }, function(t, e, n) {
        "use strict";

        function i(t, e) {
            return r["default"].defer(function() {
                e(t)
            }), {
                abort: function() {},
                forceMinPriority: function() {}
            }
        }
        var o = n(42),
            r = n(11),
            s = n(30),
            a = n(9),
            c = function() {
                function t(t, e, n, i) {
                    this.name = t, this.priority = e, this.transport = n, this.options = i || {}
                }
                return t.prototype.isSupported = function() {
                    return this.transport.isSupported({
                        encrypted: this.options.encrypted
                    })
                }, t.prototype.connect = function(t, e) {
                    var n = this;
                    if (!this.isSupported()) return i(new s.UnsupportedStrategy, e);
                    if (this.priority < t) return i(new s.TransportPriorityTooLow, e);
                    var r = !1,
                        c = this.transport.createConnection(this.name, this.priority, this.options.key, this.options),
                        u = null,
                        l = function() {
                            c.unbind("initialized", l), c.connect()
                        },
                        h = function() {
                            u = o["default"].createHandshake(c, function(t) {
                                r = !0, d(), e(null, t)
                            })
                        },
                        f = function(t) {
                            d(), e(t)
                        },
                        p = function() {
                            d();
                            var t;
                            try {
                                t = JSON.stringify(c)
                            } catch (n) {
                                t = a.safeJSONStringify(c)
                            }
                            e(new s.TransportClosed(t))
                        },
                        d = function() {
                            c.unbind("initialized", l), c.unbind("open", h), c.unbind("error", f), c.unbind("closed", p)
                        };
                    return c.bind("initialized", l), c.bind("open", h), c.bind("error", f), c.bind("closed", p), c.initialize(), {
                        abort: function() {
                            r || (d(), u ? u.close() : c.close())
                        },
                        forceMinPriority: function(t) {
                            r || n.priority < t && (u ? u.close() : c.close())
                        }
                    }
                }, t
            }();
        e.__esModule = !0, e["default"] = c
    }, function(t, e, n) {
        "use strict";
        var i = n(9),
            o = n(11),
            r = n(12),
            s = function() {
                function t(t, e) {
                    this.strategies = t, this.loop = Boolean(e.loop), this.failFast = Boolean(e.failFast), this.timeout = e.timeout, this.timeoutLimit = e.timeoutLimit
                }
                return t.prototype.isSupported = function() {
                    return i.any(this.strategies, o["default"].method("isSupported"))
                }, t.prototype.connect = function(t, e) {
                    var n = this,
                        i = this.strategies,
                        o = 0,
                        r = this.timeout,
                        s = null,
                        a = function(c, u) {
                            u ? e(null, u) : (o += 1, n.loop && (o %= i.length), o < i.length ? (r && (r = 2 * r, n.timeoutLimit && (r = Math.min(r, n.timeoutLimit))), s = n.tryStrategy(i[o], t, {
                                timeout: r,
                                failFast: n.failFast
                            }, a)) : e(!0))
                        };
                    return s = this.tryStrategy(i[o], t, {
                        timeout: r,
                        failFast: this.failFast
                    }, a), {
                        abort: function() {
                            s.abort()
                        },
                        forceMinPriority: function(e) {
                            t = e, s && s.forceMinPriority(e)
                        }
                    }
                }, t.prototype.tryStrategy = function(t, e, n, i) {
                    var o = null,
                        s = null;
                    return n.timeout > 0 && (o = new r.OneOffTimer(n.timeout, function() {
                        s.abort(), i(!0)
                    })), s = t.connect(e, function(t, e) {
                        t && o && o.isRunning() && !n.failFast || (o && o.ensureAborted(), i(t, e))
                    }), {
                        abort: function() {
                            o && o.ensureAborted(), s.abort()
                        },
                        forceMinPriority: function(t) {
                            s.forceMinPriority(t)
                        }
                    }
                }, t
            }();
        e.__esModule = !0, e["default"] = s
    }, function(t, e, n) {
        "use strict";

        function i(t, e, n) {
            var i = s.map(t, function(t, i, o, r) {
                return t.connect(e, n(i, r))
            });
            return {
                abort: function() {
                    s.apply(i, r)
                },
                forceMinPriority: function(t) {
                    s.apply(i, function(e) {
                        e.forceMinPriority(t)
                    })
                }
            }
        }

        function o(t) {
            return s.all(t, function(t) {
                return Boolean(t.error)
            })
        }

        function r(t) {
            t.error || t.aborted || (t.abort(), t.aborted = !0)
        }
        var s = n(9),
            a = n(11),
            c = function() {
                function t(t) {
                    this.strategies = t
                }
                return t.prototype.isSupported = function() {
                    return s.any(this.strategies, a["default"].method("isSupported"))
                }, t.prototype.connect = function(t, e) {
                    return i(this.strategies, t, function(t, n) {
                        return function(i, r) {
                            return n[t].error = i, i ? void(o(n) && e(!0)) : (s.apply(n, function(t) {
                                t.forceMinPriority(r.transport.priority)
                            }), void e(null, r))
                        }
                    })
                }, t
            }();
        e.__esModule = !0, e["default"] = c
    }, function(t, e, n) {
        "use strict";

        function i(t) {
            return "pusherTransport" + (t ? "Encrypted" : "Unencrypted")
        }

        function o(t) {
            var e = c["default"].getLocalStorage();
            if (e) try {
                var n = e[i(t)];
                if (n) return JSON.parse(n)
            } catch (o) {
                s(t)
            }
            return null
        }

        function r(t, e, n) {
            var o = c["default"].getLocalStorage();
            if (o) try {
                o[i(t)] = JSON.stringify({
                    timestamp: a["default"].now(),
                    transport: e,
                    latency: n
                })
            } catch (r) {}
        }

        function s(t) {
            var e = c["default"].getLocalStorage();
            if (e) try {
                delete e[i(t)]
            } catch (n) {}
        }
        var a = n(11),
            c = n(2),
            u = n(56),
            l = function() {
                function t(t, e, n) {
                    this.strategy = t, this.transports = e, this.ttl = n.ttl || 18e5, this.encrypted = n.encrypted, this.timeline = n.timeline
                }
                return t.prototype.isSupported = function() {
                    return this.strategy.isSupported()
                }, t.prototype.connect = function(t, e) {
                    var n = this.encrypted,
                        i = o(n),
                        c = [this.strategy];
                    if (i && i.timestamp + this.ttl >= a["default"].now()) {
                        var l = this.transports[i.transport];
                        l && (this.timeline.info({
                            cached: !0,
                            transport: i.transport,
                            latency: i.latency
                        }), c.push(new u["default"]([l], {
                            timeout: 2 * i.latency + 1e3,
                            failFast: !0
                        })))
                    }
                    var h = a["default"].now(),
                        f = c.pop().connect(t, function p(i, o) {
                            i ? (s(n), c.length > 0 ? (h = a["default"].now(), f = c.pop().connect(t, p)) : e(i)) : (r(n, o.transport.name, a["default"].now() - h), e(null, o))
                        });
                    return {
                        abort: function() {
                            f.abort()
                        },
                        forceMinPriority: function(e) {
                            t = e, f && f.forceMinPriority(e)
                        }
                    }
                }, t
            }();
        e.__esModule = !0, e["default"] = l
    }, function(t, e, n) {
        "use strict";
        var i = n(12),
            o = function() {
                function t(t, e) {
                    var n = e.delay;
                    this.strategy = t, this.options = {
                        delay: n
                    }
                }
                return t.prototype.isSupported = function() {
                    return this.strategy.isSupported()
                }, t.prototype.connect = function(t, e) {
                    var n, o = this.strategy,
                        r = new i.OneOffTimer(this.options.delay, function() {
                            n = o.connect(t, e)
                        });
                    return {
                        abort: function() {
                            r.ensureAborted(), n && n.abort()
                        },
                        forceMinPriority: function(e) {
                            t = e, n && n.forceMinPriority(e)
                        }
                    }
                }, t
            }();
        e.__esModule = !0, e["default"] = o
    }, function(t, e) {
        "use strict";
        var n = function() {
            function t(t, e, n) {
                this.test = t, this.trueBranch = e, this.falseBranch = n
            }
            return t.prototype.isSupported = function() {
                var t = this.test() ? this.trueBranch : this.falseBranch;
                return t.isSupported()
            }, t.prototype.connect = function(t, e) {
                var n = this.test() ? this.trueBranch : this.falseBranch;
                return n.connect(t, e)
            }, t
        }();
        e.__esModule = !0, e["default"] = n
    }, function(t, e) {
        "use strict";
        var n = function() {
            function t(t) {
                this.strategy = t
            }
            return t.prototype.isSupported = function() {
                return this.strategy.isSupported()
            }, t.prototype.connect = function(t, e) {
                var n = this.strategy.connect(t, function(t, i) {
                    i && n.abort(), e(t, i)
                });
                return n
            }, t
        }();
        e.__esModule = !0, e["default"] = n
    }, function(t, e, n) {
        "use strict";
        var i = n(5);
        e.getGlobalConfig = function() {
            return {
                wsHost: i["default"].host,
                wsPort: i["default"].ws_port,
                wssPort: i["default"].wss_port,
                httpHost: i["default"].sockjs_host,
                httpPort: i["default"].sockjs_http_port,
                httpsPort: i["default"].sockjs_https_port,
                httpPath: i["default"].sockjs_path,
                statsHost: i["default"].stats_host,
                authEndpoint: i["default"].channel_auth_endpoint,
                authTransport: i["default"].channel_auth_transport,
                activity_timeout: i["default"].activity_timeout,
                pong_timeout: i["default"].pong_timeout,
                unavailable_timeout: i["default"].unavailable_timeout
            }
        }, e.getClusterConfig = function(t) {
            return {
                wsHost: "ws-" + t + ".pusher.com",
                httpHost: "sockjs-" + t + ".pusher.com"
            }
        }
    }])
});;
! function(e, t) {
    "function" == typeof define && define.amd ? define(t) : "object" == typeof exports && "string" != typeof exports.nodeName ? module.exports = t() : e.Croppie = t()
}("undefined" != typeof self ? self : this, function() {
    "function" != typeof Promise && function(e) {
        function t(e, t) {
            return function() {
                e.apply(t, arguments)
            }
        }

        function i(e) {
            if ("object" != typeof this) throw new TypeError("Promises must be constructed via new");
            if ("function" != typeof e) throw new TypeError("not a function");
            this._state = null, this._value = null, this._deferreds = [], a(e, t(o, this), t(r, this))
        }

        function n(e) {
            var t = this;
            return null === this._state ? void this._deferreds.push(e) : void h(function() {
                var i = t._state ? e.onFulfilled : e.onRejected;
                if (null !== i) {
                    var n;
                    try {
                        n = i(t._value)
                    } catch (t) {
                        return void e.reject(t)
                    }
                    e.resolve(n)
                } else(t._state ? e.resolve : e.reject)(t._value)
            })
        }

        function o(e) {
            try {
                if (e === this) throw new TypeError("A promise cannot be resolved with itself.");
                if (e && ("object" == typeof e || "function" == typeof e)) {
                    var i = e.then;
                    if ("function" == typeof i) return void a(t(i, e), t(o, this), t(r, this))
                }
                this._state = !0, this._value = e, s.call(this)
            } catch (e) {
                r.call(this, e)
            }
        }

        function r(e) {
            this._state = !1, this._value = e, s.call(this)
        }

        function s() {
            for (var e = 0, t = this._deferreds.length; t > e; e++) n.call(this, this._deferreds[e]);
            this._deferreds = null
        }

        function a(e, t, i) {
            var n = !1;
            try {
                e(function(e) {
                    n || (n = !0, t(e))
                }, function(e) {
                    n || (n = !0, i(e))
                })
            } catch (e) {
                if (n) return;
                n = !0, i(e)
            }
        }
        var l = setTimeout,
            h = "function" == typeof setImmediate && setImmediate || function(e) {
                l(e, 1)
            },
            u = Array.isArray || function(e) {
                return "[object Array]" === Object.prototype.toString.call(e)
            };
        i.prototype.catch = function(e) {
            return this.then(null, e)
        }, i.prototype.then = function(e, t) {
            var o = this;
            return new i(function(i, r) {
                n.call(o, new function(e, t, i, n) {
                    this.onFulfilled = "function" == typeof e ? e : null, this.onRejected = "function" == typeof t ? t : null, this.resolve = i, this.reject = n
                }(e, t, i, r))
            })
        }, i.all = function() {
            var e = Array.prototype.slice.call(1 === arguments.length && u(arguments[0]) ? arguments[0] : arguments);
            return new i(function(t, i) {
                function n(r, s) {
                    try {
                        if (s && ("object" == typeof s || "function" == typeof s)) {
                            var a = s.then;
                            if ("function" == typeof a) return void a.call(s, function(e) {
                                n(r, e)
                            }, i)
                        }
                        e[r] = s, 0 == --o && t(e)
                    } catch (e) {
                        i(e)
                    }
                }
                if (0 === e.length) return t([]);
                for (var o = e.length, r = 0; r < e.length; r++) n(r, e[r])
            })
        }, i.resolve = function(e) {
            return e && "object" == typeof e && e.constructor === i ? e : new i(function(t) {
                t(e)
            })
        }, i.reject = function(e) {
            return new i(function(t, i) {
                i(e)
            })
        }, i.race = function(e) {
            return new i(function(t, i) {
                for (var n = 0, o = e.length; o > n; n++) e[n].then(t, i)
            })
        }, i._setImmediateFn = function(e) {
            h = e
        }, "undefined" != typeof module && module.exports ? module.exports = i : e.Promise || (e.Promise = i)
    }(this), "function" != typeof window.CustomEvent && function() {
        function e(e, t) {
            t = t || {
                bubbles: !1,
                cancelable: !1,
                detail: void 0
            };
            var i = document.createEvent("CustomEvent");
            return i.initCustomEvent(e, t.bubbles, t.cancelable, t.detail), i
        }
        e.prototype = window.Event.prototype, window.CustomEvent = e
    }(), HTMLCanvasElement.prototype.toBlob || Object.defineProperty(HTMLCanvasElement.prototype, "toBlob", {
        value: function(e, t, i) {
            for (var n = atob(this.toDataURL(t, i).split(",")[1]), o = n.length, r = new Uint8Array(o), s = 0; s < o; s++) r[s] = n.charCodeAt(s);
            e(new Blob([r], {
                type: t || "image/png"
            }))
        }
    });
    var e, t, i, n = ["Webkit", "Moz", "ms"],
        o = document.createElement("div").style,
        r = [1, 8, 3, 6],
        s = [2, 7, 4, 5];

    function a(e) {
        if (e in o) return e;
        for (var t = e[0].toUpperCase() + e.slice(1), i = n.length; i--;)
            if ((e = n[i] + t) in o) return e
    }

    function l(e, t) {
        e = e || {};
        for (var i in t) t[i] && t[i].constructor && t[i].constructor === Object ? (e[i] = e[i] || {}, l(e[i], t[i])) : e[i] = t[i];
        return e
    }

    function h(e) {
        return l({}, e)
    }

    function u(e) {
        if ("createEvent" in document) {
            var t = document.createEvent("HTMLEvents");
            t.initEvent("change", !1, !0), e.dispatchEvent(t)
        } else e.fireEvent("onchange")
    }

    function c(e, t, i) {
        if ("string" == typeof t) {
            var n = t;
            (t = {})[n] = i
        }
        for (var o in t) e.style[o] = t[o]
    }

    function p(e, t) {
        e.classList ? e.classList.add(t) : e.className += " " + t
    }

    function d(e, t) {
        for (var i in t) e.setAttribute(i, t[i])
    }

    function m(e) {
        return parseInt(e, 10)
    }

    function f(e, t) {
        var i = e.naturalWidth,
            n = e.naturalHeight,
            o = t || y(e);
        if (o && o >= 5) {
            var r = i;
            i = n, n = r
        }
        return {
            width: i,
            height: n
        }
    }
    t = a("transform"), e = a("transformOrigin"), i = a("userSelect");
    var v = {
            translate3d: {
                suffix: ", 0px"
            },
            translate: {
                suffix: ""
            }
        },
        g = function(e, t, i) {
            this.x = parseFloat(e), this.y = parseFloat(t), this.scale = parseFloat(i)
        };
    g.parse = function(e) {
        return e.style ? g.parse(e.style[t]) : e.indexOf("matrix") > -1 || e.indexOf("none") > -1 ? g.fromMatrix(e) : g.fromString(e)
    }, g.fromMatrix = function(e) {
        var t = e.substring(7).split(",");
        return t.length && "none" !== e || (t = [1, 0, 0, 1, 0, 0]), new g(m(t[4]), m(t[5]), parseFloat(t[0]))
    }, g.fromString = function(e) {
        var t = e.split(") "),
            i = t[0].substring(T.globals.translate.length + 1).split(","),
            n = t.length > 1 ? t[1].substring(6) : 1,
            o = i.length > 1 ? i[0] : 0,
            r = i.length > 1 ? i[1] : 0;
        return new g(o, r, n)
    }, g.prototype.toString = function() {
        var e = v[T.globals.translate].suffix || "";
        return T.globals.translate + "(" + this.x + "px, " + this.y + "px" + e + ") scale(" + this.scale + ")"
    };
    var w = function(t) {
        if (!t || !t.style[e]) return this.x = 0, void(this.y = 0);
        var i = t.style[e].split(" ");
        this.x = parseFloat(i[0]), this.y = parseFloat(i[1])
    };

    function y(e) {
        return e.exifdata && e.exifdata.Orientation ? m(e.exifdata.Orientation) : 1
    }

    function b(e, t, i) {
        var n = t.width,
            o = t.height,
            r = e.getContext("2d");
        switch (e.width = t.width, e.height = t.height, r.save(), i) {
            case 2:
                r.translate(n, 0), r.scale(-1, 1);
                break;
            case 3:
                r.translate(n, o), r.rotate(180 * Math.PI / 180);
                break;
            case 4:
                r.translate(0, o), r.scale(1, -1);
                break;
            case 5:
                e.width = o, e.height = n, r.rotate(90 * Math.PI / 180), r.scale(1, -1);
                break;
            case 6:
                e.width = o, e.height = n, r.rotate(90 * Math.PI / 180), r.translate(0, -o);
                break;
            case 7:
                e.width = o, e.height = n, r.rotate(-90 * Math.PI / 180), r.translate(-n, o), r.scale(1, -1);
                break;
            case 8:
                e.width = o, e.height = n, r.translate(0, n), r.rotate(-90 * Math.PI / 180)
        }
        r.drawImage(t, 0, 0, n, o), r.restore()
    }

    function x() {
        var n, o, r, s, a, l, h = this.options.viewport.type ? "cr-vp-" + this.options.viewport.type : null;
        this.options.useCanvas = this.options.enableOrientation || C.call(this), this.data = {}, this.elements = {}, n = this.elements.boundary = document.createElement("div"), r = this.elements.viewport = document.createElement("div"), o = this.elements.img = document.createElement("img"), s = this.elements.overlay = document.createElement("div"), this.options.useCanvas ? (this.elements.canvas = document.createElement("canvas"), this.elements.preview = this.elements.canvas) : this.elements.preview = o, p(n, "cr-boundary"), n.setAttribute("aria-dropeffect", "none"), a = this.options.boundary.width, l = this.options.boundary.height, c(n, {
                width: a + (isNaN(a) ? "" : "px"),
                height: l + (isNaN(l) ? "" : "px")
            }), p(r, "cr-viewport"), h && p(r, h), c(r, {
                width: this.options.viewport.width + "px",
                height: this.options.viewport.height + "px"
            }), r.setAttribute("tabindex", 0), p(this.elements.preview, "cr-image"), d(this.elements.preview, {
                alt: "preview",
                "aria-grabbed": "false"
            }), p(s, "cr-overlay"), this.element.appendChild(n), n.appendChild(this.elements.preview), n.appendChild(r), n.appendChild(s), p(this.element, "croppie-container"), this.options.customClass && p(this.element, this.options.customClass),
            function() {
                var e, n, o, r, s, a = this,
                    l = !1;

                function h(e, t) {
                    var i = a.elements.preview.getBoundingClientRect(),
                        n = s.y + t,
                        o = s.x + e;
                    a.options.enforceBoundary ? (r.top > i.top + t && r.bottom < i.bottom + t && (s.y = n), r.left > i.left + e && r.right < i.right + e && (s.x = o)) : (s.y = n, s.x = o)
                }

                function p(e) {
                    a.elements.preview.setAttribute("aria-grabbed", e), a.elements.boundary.setAttribute("aria-dropeffect", e ? "move" : "none")
                }

                function d(t) {
                    if ((void 0 === t.button || 0 === t.button) && (t.preventDefault(), !l)) {
                        if (l = !0, e = t.pageX, n = t.pageY, t.touches) {
                            var o = t.touches[0];
                            e = o.pageX, n = o.pageY
                        }
                        p(l), s = g.parse(a.elements.preview), window.addEventListener("mousemove", m), window.addEventListener("touchmove", m), window.addEventListener("mouseup", f), window.addEventListener("touchend", f), document.body.style[i] = "none", r = a.elements.viewport.getBoundingClientRect()
                    }
                }

                function m(i) {
                    i.preventDefault();
                    var r = i.pageX,
                        l = i.pageY;
                    if (i.touches) {
                        var p = i.touches[0];
                        r = p.pageX, l = p.pageY
                    }
                    var d = r - e,
                        m = l - n,
                        f = {};
                    if ("touchmove" === i.type && i.touches.length > 1) {
                        var v = i.touches[0],
                            g = i.touches[1],
                            w = Math.sqrt((v.pageX - g.pageX) * (v.pageX - g.pageX) + (v.pageY - g.pageY) * (v.pageY - g.pageY));
                        o || (o = w / a._currentZoom);
                        var y = w / o;
                        return E.call(a, y), void u(a.elements.zoomer)
                    }
                    h(d, m), f[t] = s.toString(), c(a.elements.preview, f), _.call(a), n = l, e = r
                }

                function f() {
                    p(l = !1), window.removeEventListener("mousemove", m), window.removeEventListener("touchmove", m), window.removeEventListener("mouseup", f), window.removeEventListener("touchend", f), document.body.style[i] = "", L.call(a), H.call(a), o = 0
                }
                a.elements.overlay.addEventListener("mousedown", d), a.elements.viewport.addEventListener("keydown", function(e) {
                    var n = 37,
                        l = 38,
                        u = 39,
                        p = 40;
                    if (!e.shiftKey || e.keyCode !== l && e.keyCode !== p) {
                        if (a.options.enableKeyMovement && e.keyCode >= 37 && e.keyCode <= 40) {
                            e.preventDefault();
                            var d = function(e) {
                                switch (e) {
                                    case n:
                                        return [1, 0];
                                    case l:
                                        return [0, 1];
                                    case u:
                                        return [-1, 0];
                                    case p:
                                        return [0, -1]
                                }
                            }(e.keyCode);
                            s = g.parse(a.elements.preview), document.body.style[i] = "none", r = a.elements.viewport.getBoundingClientRect(),
                                function(e) {
                                    var n = e[0],
                                        r = e[1],
                                        l = {};
                                    h(n, r), l[t] = s.toString(), c(a.elements.preview, l), _.call(a), document.body.style[i] = "", L.call(a), H.call(a), o = 0
                                }(d)
                        }
                    } else {
                        var m;
                        m = e.keyCode === l ? parseFloat(a.elements.zoomer.value) + parseFloat(a.elements.zoomer.step) : parseFloat(a.elements.zoomer.value) - parseFloat(a.elements.zoomer.step), a.setZoom(m)
                    }
                }), a.elements.overlay.addEventListener("touchstart", d)
            }.call(this), this.options.enableZoom && function() {
                var i = this,
                    n = i.elements.zoomerWrap = document.createElement("div"),
                    o = i.elements.zoomer = document.createElement("input");

                function r() {
                    (function(i) {
                        var n = this,
                            o = i ? i.transform : g.parse(n.elements.preview),
                            r = i ? i.viewportRect : n.elements.viewport.getBoundingClientRect(),
                            s = i ? i.origin : new w(n.elements.preview);

                        function a() {
                            var i = {};
                            i[t] = o.toString(), i[e] = s.toString(), c(n.elements.preview, i)
                        }
                        if (n._currentZoom = i ? i.value : n._currentZoom, o.scale = n._currentZoom, n.elements.zoomer.setAttribute("aria-valuenow", n._currentZoom), a(), n.options.enforceBoundary) {
                            var l = function(e) {
                                    var t = this._currentZoom,
                                        i = e.width,
                                        n = e.height,
                                        o = this.elements.boundary.clientWidth / 2,
                                        r = this.elements.boundary.clientHeight / 2,
                                        s = this.elements.preview.getBoundingClientRect(),
                                        a = s.width,
                                        l = s.height,
                                        h = i / 2,
                                        u = n / 2,
                                        c = -1 * (h / t - o),
                                        p = -1 * (u / t - r),
                                        d = 1 / t * h,
                                        m = 1 / t * u;
                                    return {
                                        translate: {
                                            maxX: c,
                                            minX: c - (a * (1 / t) - i * (1 / t)),
                                            maxY: p,
                                            minY: p - (l * (1 / t) - n * (1 / t))
                                        },
                                        origin: {
                                            maxX: a * (1 / t) - d,
                                            minX: d,
                                            maxY: l * (1 / t) - m,
                                            minY: m
                                        }
                                    }
                                }.call(n, r),
                                h = l.translate,
                                u = l.origin;
                            o.x >= h.maxX && (s.x = u.minX, o.x = h.maxX), o.x <= h.minX && (s.x = u.maxX, o.x = h.minX), o.y >= h.maxY && (s.y = u.minY, o.y = h.maxY), o.y <= h.minY && (s.y = u.maxY, o.y = h.minY)
                        }
                        a(), z.call(n), H.call(n)
                    }).call(i, {
                        value: parseFloat(o.value),
                        origin: new w(i.elements.preview),
                        viewportRect: i.elements.viewport.getBoundingClientRect(),
                        transform: g.parse(i.elements.preview)
                    })
                }

                function s(e) {
                    var t, n;
                    if ("ctrl" === i.options.mouseWheelZoom && !0 !== e.ctrlKey) return 0;
                    t = e.wheelDelta ? e.wheelDelta / 1200 : e.deltaY ? e.deltaY / 1060 : e.detail ? e.detail / -60 : 0, n = i._currentZoom + t * i._currentZoom, e.preventDefault(), E.call(i, n), r.call(i)
                }
                p(n, "cr-slider-wrap"), p(o, "cr-slider"), o.type = "range", o.step = "0.0001", o.value = "1", o.style.display = i.options.showZoomer ? "" : "none", o.setAttribute("aria-label", "zoom"), i.element.appendChild(n), n.appendChild(o), i._currentZoom = 1, i.elements.zoomer.addEventListener("input", r), i.elements.zoomer.addEventListener("change", r), i.options.mouseWheelZoom && (i.elements.boundary.addEventListener("mousewheel", s), i.elements.boundary.addEventListener("DOMMouseScroll", s))
            }.call(this), this.options.enableResize && function() {
                var e, t, n, o, r, s, a, l = this,
                    h = document.createElement("div"),
                    u = !1,
                    d = 50;
                p(h, "cr-resizer"), c(h, {
                    width: this.options.viewport.width + "px",
                    height: this.options.viewport.height + "px"
                }), this.options.resizeControls.height && (p(s = document.createElement("div"), "cr-resizer-vertical"), h.appendChild(s));
                this.options.resizeControls.width && (p(a = document.createElement("div"), "cr-resizer-horisontal"), h.appendChild(a));

                function m(s) {
                    if ((void 0 === s.button || 0 === s.button) && (s.preventDefault(), !u)) {
                        var a = l.elements.overlay.getBoundingClientRect();
                        if (u = !0, t = s.pageX, n = s.pageY, e = -1 !== s.currentTarget.className.indexOf("vertical") ? "v" : "h", o = a.width, r = a.height, s.touches) {
                            var h = s.touches[0];
                            t = h.pageX, n = h.pageY
                        }
                        window.addEventListener("mousemove", f), window.addEventListener("touchmove", f), window.addEventListener("mouseup", v), window.addEventListener("touchend", v), document.body.style[i] = "none"
                    }
                }

                function f(i) {
                    var s = i.pageX,
                        a = i.pageY;
                    if (i.preventDefault(), i.touches) {
                        var u = i.touches[0];
                        s = u.pageX, a = u.pageY
                    }
                    var p = s - t,
                        m = a - n,
                        f = l.options.viewport.height + m,
                        v = l.options.viewport.width + p;
                    "v" === e && f >= d && f <= r ? (c(h, {
                        height: f + "px"
                    }), l.options.boundary.height += m, c(l.elements.boundary, {
                        height: l.options.boundary.height + "px"
                    }), l.options.viewport.height += m, c(l.elements.viewport, {
                        height: l.options.viewport.height + "px"
                    })) : "h" === e && v >= d && v <= o && (c(h, {
                        width: v + "px"
                    }), l.options.boundary.width += p, c(l.elements.boundary, {
                        width: l.options.boundary.width + "px"
                    }), l.options.viewport.width += p, c(l.elements.viewport, {
                        width: l.options.viewport.width + "px"
                    })), _.call(l), F.call(l), L.call(l), H.call(l), n = a, t = s
                }

                function v() {
                    u = !1, window.removeEventListener("mousemove", f), window.removeEventListener("touchmove", f), window.removeEventListener("mouseup", v), window.removeEventListener("touchend", v), document.body.style[i] = ""
                }
                s && (s.addEventListener("mousedown", m), s.addEventListener("touchstart", m));
                a && (a.addEventListener("mousedown", m), a.addEventListener("touchstart", m));
                this.elements.boundary.appendChild(h)
            }.call(this)
    }

    function C() {
        return this.options.enableExif && window.EXIF
    }

    function E(e) {
        if (this.options.enableZoom) {
            var t = this.elements.zoomer,
                i = O(e, 4);
            t.value = Math.max(parseFloat(t.min), Math.min(parseFloat(t.max), i)).toString()
        }
    }

    function L(i) {
        var n = this._currentZoom,
            o = this.elements.preview.getBoundingClientRect(),
            r = this.elements.viewport.getBoundingClientRect(),
            s = g.parse(this.elements.preview.style[t]),
            a = new w(this.elements.preview),
            l = r.top - o.top + r.height / 2,
            h = r.left - o.left + r.width / 2,
            u = {},
            p = {};
        if (i) {
            var d = a.x,
                m = a.y,
                f = s.x,
                v = s.y;
            u.y = d, u.x = m, s.y = f, s.x = v
        } else u.y = l / n, u.x = h / n, p.y = (u.y - a.y) * (1 - n), p.x = (u.x - a.x) * (1 - n), s.x -= p.x, s.y -= p.y;
        var y = {};
        y[e] = u.x + "px " + u.y + "px", y[t] = s.toString(), c(this.elements.preview, y)
    }

    function _() {
        if (this.elements) {
            var e = this.elements.boundary.getBoundingClientRect(),
                t = this.elements.preview.getBoundingClientRect();
            c(this.elements.overlay, {
                width: t.width + "px",
                height: t.height + "px",
                top: t.top - e.top + "px",
                left: t.left - e.left + "px"
            })
        }
    }
    w.prototype.toString = function() {
        return this.x + "px " + this.y + "px"
    };
    var R, B, Z, W, z = (R = _, B = 500, function() {
        var e = this,
            t = arguments,
            i = Z && !W;
        clearTimeout(W), W = setTimeout(function() {
            W = null, Z || R.apply(e, t)
        }, B), i && R.apply(e, t)
    });

    function H() {
        var e, t = this.get();
        M.call(this) && (this.options.update.call(this, t), this.$ && "undefined" == typeof Prototype ? this.$(this.element).trigger("update.croppie", t) : (window.CustomEvent ? e = new CustomEvent("update", {
            detail: t
        }) : (e = document.createEvent("CustomEvent")).initCustomEvent("update", !0, !0, t), this.element.dispatchEvent(e)))
    }

    function M() {
        return this.elements.preview.offsetHeight > 0 && this.elements.preview.offsetWidth > 0
    }

    function I() {
        var i, n = {},
            o = this.elements.preview,
            r = new g(0, 0, 1),
            s = new w;
        M.call(this) && !this.data.bound && (this.data.bound = !0, n[t] = r.toString(), n[e] = s.toString(), n.opacity = 1, c(o, n), i = this.elements.preview.getBoundingClientRect(), this._originalImageWidth = i.width, this._originalImageHeight = i.height, this.data.orientation = y(this.elements.img), this.options.enableZoom ? F.call(this, !0) : this._currentZoom = 1, r.scale = this._currentZoom, n[t] = r.toString(), c(o, n), this.data.points.length ? function(i) {
            if (4 !== i.length) throw "Croppie - Invalid number of points supplied: " + i;
            var n = i[2] - i[0],
                o = this.elements.viewport.getBoundingClientRect(),
                r = this.elements.boundary.getBoundingClientRect(),
                s = {
                    left: o.left - r.left,
                    top: o.top - r.top
                },
                a = o.width / n,
                l = i[1],
                h = i[0],
                u = -1 * i[1] + s.top,
                p = -1 * i[0] + s.left,
                d = {};
            d[e] = h + "px " + l + "px", d[t] = new g(p, u, a).toString(), c(this.elements.preview, d), E.call(this, a), this._currentZoom = a
        }.call(this, this.data.points) : function() {
            var e = this.elements.preview.getBoundingClientRect(),
                i = this.elements.viewport.getBoundingClientRect(),
                n = this.elements.boundary.getBoundingClientRect(),
                o = i.left - n.left,
                r = i.top - n.top,
                s = o - (e.width - i.width) / 2,
                a = r - (e.height - i.height) / 2,
                l = new g(s, a, this._currentZoom);
            c(this.elements.preview, t, l.toString())
        }.call(this), L.call(this), _.call(this))
    }

    function F(e) {
        var t, i, n, o, r = Math.max(this.options.minZoom, 0) || 0,
            s = this.options.maxZoom || 1.5,
            a = this.elements.zoomer,
            l = parseFloat(a.value),
            h = this.elements.boundary.getBoundingClientRect(),
            c = f(this.elements.img, this.data.orientation),
            p = this.elements.viewport.getBoundingClientRect();
        this.options.enforceBoundary && (n = p.width / c.width, o = p.height / c.height, r = Math.max(n, o)), r >= s && (s = r + 1), a.min = O(r, 4), a.max = O(s, 4), !e && (l < a.min || l > a.max) ? E.call(this, l < a.min ? a.min : a.max) : e && (i = Math.max(h.width / c.width, h.height / c.height), t = null !== this.data.boundZoom ? this.data.boundZoom : i, E.call(this, t)), u(a)
    }

    function X(e) {
        var t = e.points,
            i = m(t[0]),
            n = m(t[1]),
            o = m(t[2]) - i,
            r = m(t[3]) - n,
            s = e.circle,
            a = document.createElement("canvas"),
            l = a.getContext("2d"),
            h = e.outputWidth || o,
            u = e.outputHeight || r;
        return a.width = h, a.height = u, e.backgroundColor && (l.fillStyle = e.backgroundColor, l.fillRect(0, 0, h, u)), sx = i, sy = n, sWidth = o, sHeight = r, dx = 0, dy = 0, dWidth = h, dHeight = u, i < 0 && (sx = 0, dx = Math.abs(i) / o * h), sWidth + sx > this._originalImageWidth && (sWidth = this._originalImageWidth - sx, dWidth = sWidth / o * h), n < 0 && (sy = 0, dy = Math.abs(n) / r * u), sHeight + sy > this._originalImageHeight && (sHeight = this._originalImageHeight - sy, dHeight = sHeight / r * u), l.drawImage(this.elements.preview, sx, sy, sWidth, sHeight, dx, dy, dWidth, dHeight), s && (l.fillStyle = "#fff", l.globalCompositeOperation = "destination-in", l.beginPath(), l.arc(a.width / 2, a.height / 2, a.width / 2, 0, 2 * Math.PI, !0), l.closePath(), l.fill()), a
    }

    function Y(e, t) {
        var i, n, o, r, s = this,
            a = [],
            l = null,
            h = C.call(s);
        if ("string" == typeof e) i = e, e = {};
        else if (Array.isArray(e)) a = e.slice();
        else {
            if (void 0 === e && s.data.url) return I.call(s), H.call(s), null;
            i = e.url, a = e.points || [], l = void 0 === e.zoom ? null : e.zoom
        }
        return s.data.bound = !1, s.data.url = i || s.data.url, s.data.boundZoom = l, (n = i, o = h, r = new Image, r.style.opacity = "0", new Promise(function(e, t) {
            function i() {
                r.style.opacity = "1", setTimeout(function() {
                    e(r)
                }, 1)
            }
            r.removeAttribute("crossOrigin"), n.match(/^https?:\/\/|^\/\//) && r.setAttribute("crossOrigin", "anonymous"), r.onload = function() {
                o ? EXIF.getData(r, function() {
                    i()
                }) : i()
            }, r.onerror = function(e) {
                r.style.opacity = 1, setTimeout(function() {
                    t(e)
                }, 1)
            }, r.src = n
        })).then(function(i) {
            if (function(e) {
                    this.elements.img.parentNode && (Array.prototype.forEach.call(this.elements.img.classList, function(t) {
                        e.classList.add(t)
                    }), this.elements.img.parentNode.replaceChild(e, this.elements.img), this.elements.preview = e), this.elements.img = e
                }.call(s, i), a.length) s.options.relative && (a = [a[0] * i.naturalWidth / 100, a[1] * i.naturalHeight / 100, a[2] * i.naturalWidth / 100, a[3] * i.naturalHeight / 100]);
            else {
                var n, o, r = f(i),
                    l = s.elements.viewport.getBoundingClientRect(),
                    h = l.width / l.height;
                r.width / r.height > h ? n = (o = r.height) * h : (n = r.width, o = r.height / h);
                var u = (r.width - n) / 2,
                    c = (r.height - o) / 2,
                    p = u + n,
                    d = c + o;
                s.data.points = [u, c, p, d]
            }
            s.data.points = a.map(function(e) {
                return parseFloat(e)
            }), s.options.useCanvas && function(e) {
                var t = this.elements.canvas,
                    i = this.elements.img;
                t.getContext("2d").clearRect(0, 0, t.width, t.height), t.width = i.width, t.height = i.height, b(t, i, this.options.enableOrientation && e || y(i))
            }.call(s, e.orientation), I.call(s), H.call(s), t && t()
        })
    }

    function O(e, t) {
        return parseFloat(e).toFixed(t || 0)
    }

    function k() {
        var e = this.elements.preview.getBoundingClientRect(),
            t = this.elements.viewport.getBoundingClientRect(),
            i = t.left - e.left,
            n = t.top - e.top,
            o = (t.width - this.elements.viewport.offsetWidth) / 2,
            r = (t.height - this.elements.viewport.offsetHeight) / 2,
            s = i + this.elements.viewport.offsetWidth + o,
            a = n + this.elements.viewport.offsetHeight + r,
            l = this._currentZoom;
        (l === 1 / 0 || isNaN(l)) && (l = 1);
        var h = this.options.enforceBoundary ? 0 : Number.NEGATIVE_INFINITY;
        return i = Math.max(h, i / l), n = Math.max(h, n / l), s = Math.max(h, s / l), a = Math.max(h, a / l), {
            points: [O(i), O(n), O(s), O(a)],
            zoom: l,
            orientation: this.data.orientation
        }
    }
    var A = {
            type: "canvas",
            format: "png",
            quality: 1
        },
        j = ["jpeg", "webp", "png"];

    function N(e) {
        var t = this,
            i = k.call(t),
            n = l(h(A), h(e)),
            o = "string" == typeof e ? e : n.type || "base64",
            r = n.size || "viewport",
            s = n.format,
            a = n.quality,
            u = n.backgroundColor,
            d = "boolean" == typeof n.circle ? n.circle : "circle" === t.options.viewport.type,
            m = t.elements.viewport.getBoundingClientRect(),
            f = m.width / m.height;
        return "viewport" === r ? (i.outputWidth = m.width, i.outputHeight = m.height) : "object" == typeof r && (r.width && r.height ? (i.outputWidth = r.width, i.outputHeight = r.height) : r.width ? (i.outputWidth = r.width, i.outputHeight = r.width / f) : r.height && (i.outputWidth = r.height * f, i.outputHeight = r.height)), j.indexOf(s) > -1 && (i.format = "image/" + s, i.quality = a), i.circle = d, i.url = t.data.url, i.backgroundColor = u, new Promise(function(e) {
            switch (o.toLowerCase()) {
                case "rawcanvas":
                    e(X.call(t, i));
                    break;
                case "canvas":
                case "base64":
                    e(function(e) {
                        return X.call(this, e).toDataURL(e.format, e.quality)
                    }.call(t, i));
                    break;
                case "blob":
                    (function(e) {
                        var t = this;
                        return new Promise(function(i) {
                            X.call(t, e).toBlob(function(e) {
                                i(e)
                            }, e.format, e.quality)
                        })
                    }).call(t, i).then(e);
                    break;
                default:
                    e(function(e) {
                        var t = e.points,
                            i = document.createElement("div"),
                            n = document.createElement("img"),
                            o = t[2] - t[0],
                            r = t[3] - t[1];
                        return p(i, "croppie-result"), i.appendChild(n), c(n, {
                            left: -1 * t[0] + "px",
                            top: -1 * t[1] + "px"
                        }), n.src = e.url, c(i, {
                            width: o + "px",
                            height: r + "px"
                        }), i
                    }.call(t, i))
            }
        })
    }

    function S(e) {
        if (!this.options.useCanvas || !this.options.enableOrientation) throw "Croppie: Cannot rotate without enableOrientation && EXIF.js included";
        var t, i, n, o, a, l = this.elements.canvas;
        this.data.orientation = (t = this.data.orientation, i = e, n = r.indexOf(t) > -1 ? r : s, o = n.indexOf(t), a = i / 90 % n.length, n[(n.length + o + a % n.length) % n.length]), b(l, this.elements.img, this.data.orientation), L.call(this, !0), F.call(this)
    }
    if (window.jQuery) {
        var P = window.jQuery;
        P.fn.croppie = function(e) {
            if ("string" === typeof e) {
                var t = Array.prototype.slice.call(arguments, 1),
                    i = P(this).data("croppie");
                return "get" === e ? i.get() : "result" === e ? i.result.apply(i, t) : "bind" === e ? i.bind.apply(i, t) : this.each(function() {
                    var i = P(this).data("croppie");
                    if (i) {
                        var n = i[e];
                        if (!P.isFunction(n)) throw "Croppie " + e + " method not found";
                        n.apply(i, t), "destroy" === e && P(this).removeData("croppie")
                    }
                })
            }
            return this.each(function() {
                var t = new T(this, e);
                t.$ = P, P(this).data("croppie", t)
            })
        }
    }

    function T(e, t) {
        if (e.className.indexOf("croppie-container") > -1) throw new Error("Croppie: Can't initialize croppie more than once");
        if (this.element = e, this.options = l(h(T.defaults), t), "img" === this.element.tagName.toLowerCase()) {
            var i = this.element;
            p(i, "cr-original-image"), d(i, {
                "aria-hidden": "true",
                alt: ""
            });
            var n = document.createElement("div");
            this.element.parentNode.appendChild(n), n.appendChild(i), this.element = n, this.options.url = this.options.url || i.src
        }
        if (x.call(this), this.options.url) {
            var o = {
                url: this.options.url,
                points: this.options.points
            };
            delete this.options.url, delete this.options.points, Y.call(this, o)
        }
    }
    return T.defaults = {
        viewport: {
            width: 100,
            height: 100,
            type: "square"
        },
        boundary: {},
        orientationControls: {
            enabled: !0,
            leftClass: "",
            rightClass: ""
        },
        resizeControls: {
            width: !0,
            height: !0
        },
        customClass: "",
        showZoomer: !0,
        enableZoom: !0,
        enableResize: !1,
        mouseWheelZoom: !0,
        enableExif: !1,
        enforceBoundary: !0,
        enableOrientation: !1,
        enableKeyMovement: !0,
        update: function() {}
    }, T.globals = {
        translate: "translate3d"
    }, l(T.prototype, {
        bind: function(e, t) {
            return Y.call(this, e, t)
        },
        get: function() {
            var e = k.call(this),
                t = e.points;
            return this.options.relative && (t[0] /= this.elements.img.naturalWidth / 100, t[1] /= this.elements.img.naturalHeight / 100, t[2] /= this.elements.img.naturalWidth / 100, t[3] /= this.elements.img.naturalHeight / 100), e
        },
        result: function(e) {
            return N.call(this, e)
        },
        refresh: function() {
            return function() {
                I.call(this)
            }.call(this)
        },
        setZoom: function(e) {
            E.call(this, e), u(this.elements.zoomer)
        },
        rotate: function(e) {
            S.call(this, e)
        },
        destroy: function() {
            return function() {
                var e, t;
                this.element.removeChild(this.elements.boundary), e = this.element, t = "croppie-container", e.classList ? e.classList.remove(t) : e.className = e.className.replace(t, ""), this.options.enableZoom && this.element.removeChild(this.elements.zoomerWrap), delete this.elements
            }.call(this)
        }
    }), T
});;

function addLoader(e, t, a) {
    var i = $(e);
    if (a) i.append('<div class="spinner-container"><span class="loader" id="loader"></span></div>'), i.css("opacity", "0.33");
    else t = t || "isloading isloading--white", i.each(function() {
        var e = $(this);
        this.previous = e.html(), this.classLoader = t, e.css("width", e.width() + 1).html("").addClass(t)
    })
}

function removeLoader(e, t) {
    var a = $(e);
    if (t) a.css("opacity", "1"), a.find(".spinner-container").remove();
    else a.each(function() {
        $(this).removeClass(this.classLoader).html(this.previous)
    })
}

function common_debounce(i, n, o) {
    var r;
    return function() {
        var e = this,
            t = arguments,
            a = o && !r;
        if (clearTimeout(r), r = setTimeout(function() {
                if (r = null, !o) i.apply(e, t)
            }, n), a) i.apply(e, t)
    }
}

function BodasLib() {
    var i, n;
    this.isSafari = function() {
        return -1 != navigator.userAgent.indexOf("Safari") && -1 == navigator.userAgent.indexOf("Chrome")
    }, this.cutText = function(e, t, a) {
        return a = a || "...", e.length > t ? e.substring(0, t) + a : this
    }, this.isIOS8 = function() {
        var e = navigator.userAgent.toLowerCase();
        return /(iphone|ipod|ipad).* os 8_/.test(e)
    }, this.getCookie = function(e) {
        var t = document.cookie.match("(^|;)\\s*" + e + "\\s*=\\s*([^;]+)");
        return t ? unescape(t.pop()) : null
    }, this.getCookieURIdecoded = function(e) {
        var t = document.cookie.match("(^|;)\\s*" + e + "\\s*=\\s*([^;]+)");
        return t ? decodeURIComponent(t.pop()) : null
    }, this.deleteCookie = function(e, t) {
        var a = this.deleteCookie.arguments,
            i = this.deleteCookie.arguments.length,
            n = new Date,
            o = 3 < i ? a[3] : "/",
            r = 4 < i ? a[4] : null,
            s = 5 < i ? a[5] : !1;
        document.cookie = e + "=" + escape(t) + "; expires=" + n.toGMTString() + (null == o ? "/" : "; path=" + o) + (null == r ? "; domain=" + globals.Request_Cookie_domain : "; domain=" + r) + (1 == s ? "; secure" : "")
    }, this.setCookieSession = function(e, t) {
        var a = this.setCookieSession.arguments,
            i = this.setCookieSession.arguments.length,
            n = 3 < i ? a[3] : "/",
            o = 4 < i ? a[4] : null,
            r = 5 < i ? a[5] : !1;
        document.cookie = e + "=" + escape(t) + (null === n || !n ? "/" : "; path=" + n) + (null === o ? "; domain=" + globals.Request_Cookie_domain : "; domain=" + o) + (!0 === r ? "; secure" : "")
    }, this.setCookieTime = function(e, t, a) {
        var i = this.setCookieTime.arguments,
            n = this.setCookieTime.arguments.length,
            o = 3 < n ? i[3] : "/",
            r = 4 < n ? i[4] : null,
            s = 5 < n ? i[5] : !1,
            l = new Date;
        if (a) {
            var c = l.getTime();
            c += 24 * a * 3600 * 1e3, l.setTime(c)
        } else l.setYear(9999);
        document.cookie = e + "=" + escape(t) + "; expires=" + l.toGMTString() + (null == o ? "/" : "; path=" + o) + (null == r ? "; domain=" + globals.Request_Cookie_domain : "; domain=" + r) + (1 == s ? "; secure" : "")
    }, this.validateNumber = function(e) {
        var t = null;
        return $.ajax({
            url: window.location.protocol + "//" + globals.subdomain + "/json/validatorNumber.php?number=" + encodeURIComponent(e),
            async: !1,
            dataType: "json",
            success: function(e) {
                t = e.result
            }
        }), t
    }, this.sendPostRequest = function(e, t) {
        var a = document.createElement("form");
        for (var i in a.setAttribute("method", "post"), a.setAttribute("action", e), a.setAttribute("accept-charset", "UTF-8"), t)
            if (t.hasOwnProperty(i)) {
                var n = document.createElement("input");
                if (n.setAttribute("type", "hidden"), n.setAttribute("name", i), "object" == typeof t[i]) n.setAttribute("value", JSON.stringify(t[i]));
                else n.setAttribute("value", t[i]);
                a.appendChild(n)
            }
        document.body.appendChild(a), a.submit()
    }, this.isUndefined = function(e) {
        return void 0 === e
    }, this.generateStaticVendorURL = function(t, e) {
        t = t || {};
        var a = "https://" + (globals.isMobile ? globals.subdomainMobile : globals.subdomain);
        if (["city", "region", "regionAdm1", "grupo", "sector"].forEach(function(e) {
                if (t[e] && !t[e].url) console.warn("URL not defined in parameter '" + e + "'!");
                if ("US" == globals.Request_Country)
                    if (t[e] && !t[e].idWW && "regionAdm1" != e) console.warn("ID_WW not defined in parameter '" + e + "'!")
            }), "US" == globals.Request_Country) {
            if (!t.sector && t.grupo && ("11" == t.grupo.idWW || "605" == t.grupo.idWW)) t.sector = t.grupo;
            if (t.sector)
                if (t.regionAdm1 && t.region && t.city) a += "/c/" + (e ? "" : t.regionAdm1.url + "/") + t.city.url + "/" + t.sector.url + "/" + t.sector.idWW + "-vendors.html";
                else if (t.regionAdm1 && t.region) a += "/c/" + t.regionAdm1.url + "/" + t.region.url + "/" + t.sector.url + "/" + t.region.idWW + "-" + t.sector.idWW + "-rca.html";
            else if (t.regionAdm1) a += "/c/" + t.regionAdm1.url + "/" + t.sector.url + "/" + t.sector.idWW + "-sca.html";
            else a += "/" + t.sector.url;
            else if (t.regionAdm1 && t.region && t.city) a += "/c/" + (e ? "" : t.regionAdm1.url + "/") + t.city.url + "/" + t.region.idWW + "-rci.html";
            else if (t.regionAdm1 && t.region) a += "/c/" + t.regionAdm1.url + "/" + t.region.url + "/" + t.region.idWW + "-r.html";
            else if (t.regionAdm1) a += "/c/" + t.regionAdm1.url + "/s.html";
            else a += "/weddings";
            if (1 < t.page) a += "?page=" + t.page
        } else {
            var i = globals.Request_prevurl_model,
                n = globals.Request_URL_keygen;
            if (i) a += "/" + n;
            if (t.sector) a += "/" + t.sector.url;
            else if (t.grupo) a += "/" + t.grupo.url;
            else if (!i) a += "/" + n;
            t.city = t.city || {}, t.geozone = t.geozone || {}, t.region = t.region || {}, t.regionAdm1 = t.regionAdm1 || {};
            var o = t.city.url || t.geozone.url || t.region.url || t.regionAdm1.url;
            if (o) a += "/" + o;
            if (1 < t.page) a += "--" + t.page
        }
        return a
    }, this.setAnalyticsEventForServer = function(e) {
        var t = $(e),
            a = t.closest("form"),
            i = {
                category: t.data("track-c"),
                action: t.data("track-a"),
                label: t.data("track-l"),
                value: +t.data("track-v"),
                nonInteraction: +t.data("track-ni"),
                cds: t.data("track-cds")
            },
            n = $("<input type='hidden' name='analytics-event'>");
        n.val(JSON.stringify(i)), a.find("input[name=analytics-event]").remove(), a.append(n)
    }, this.calendarInput = function(e) {
        this.options = $.extend({}, {
            name: "calendarInput1",
            element: ".app-input-datepicker",
            callbackClickDay: function(e) {}
        }, e), this.$wrapper = $(this.options.element), this.name = this.options.name, this.datesPicked = {}, this.blockMonthLeft = !1, this.blockYearLeft = !1;
        var t = this.$wrapper.data("selected-days");
        if (this.minDay = this.$wrapper.data("min-day") || 0, Array.isArray(t))
            for (var a in t) this.datesPicked[+t[a]] = !0;
        this.$wrapper[0].datesPicked = this.datesPicked, this.year = this.$wrapper.find(".app-input-datepicker-year").data("value"), this.month = this.$wrapper.find(".app-input-datepicker-month").data("value"), this.currentPickedMonth = "" + this.year + this.month;
        var d = this;
        u();
        var p = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        function i(e, t) {
            for (var a = new Date(e, t, 0).getDate(), i = new Date(e, t - 1, 1).getDay(), n = "", o = 0, r = 7 * Math.ceil((i + a) / 7) - i, s = 1 - i; s <= r; s++) {
                if (o % 7 == 0) n += "<tr>";
                if (s < 1 || a < s) n += "<td><span></span></td>";
                else {
                    var l = "",
                        c = "" + e + String("0" + t).slice(-2) + String("0" + s).slice(-2);
                    if (+c < d.minDay) l = "availabilityFilter__disabledDay disabled";
                    else if (l = "app-input-datepicker-day", d.datesPicked[c]) l += " app-selected selected";
                    n += "<td><span class='datepicker-day " + l + "' data-value='" + c + "'>" + s + "</span></td>"
                }
                if (o % 7 == 6) n += "</tr>";
                o++
            }
            d.$wrapper.find(".app-input-datepicker-year").data("value", e).html(e), d.$wrapper.find(".app-input-datepicker-month").data("value", t).html(p[t - 1]), d.$wrapper.find("#js-datepicker-dates").html(n), u()
        }

        function u() {
            if (d.minDay) {
                var e, t = ~~(d.minDay / 100),
                    a = "" + (d.year - 1) + String("0" + d.month).slice(-2);
                if (1 == d.month) e = d.year - 1 + "12";
                else e = "" + d.year + String("0" + (d.month - 1)).slice(-2);
                if (+e < t) d.blockMonthLeft = !0, d.blockYearLeft = !0, d.$wrapper.find(".app-input-datepicker-change-month").eq(0).addClass("availability__disabledDay"), d.$wrapper.find(".app-input-datepicker-change-year").eq(0).addClass("availability__disabledDay");
                else if (+a < t) d.blockMonthLeft = !1, d.blockYearLeft = !0, d.$wrapper.find(".app-input-datepicker-change-month").eq(0).removeClass("availability__disabledDay"), d.$wrapper.find(".app-input-datepicker-change-year").eq(0).addClass("availability__disabledDay");
                else d.blockMonthLeft = !1, d.blockYearLeft = !1, d.$wrapper.find(".app-input-datepicker-change-month").eq(0).removeClass("availability__disabledDay"), d.$wrapper.find(".app-input-datepicker-change-year").eq(0).removeClass("availability__disabledDay")
            }
        }
        this.$wrapper.find(".app-input-datepicker-change-month").on("click", function() {
            if ("left" == $(this).data("direction")) {
                if (d.blockMonthLeft) return;
                if (d.month--, 0 == d.month) d.year--, d.month = 12
            } else if (d.month++, 13 == d.month) d.month = 1, d.year++;
            d.currentPickedMonth = "" + d.year + d.month, d.$wrapper.data("currentPickedMonth", d.currentPickedMonth), i(d.year, d.month)
        }), this.$wrapper.find(".app-input-datepicker-change-year").on("click", function() {
            if ("left" == $(this).data("direction")) {
                if (d.blockYearLeft) return;
                d.year--
            } else d.year++;
            i(d.year, d.month)
        }), this.$wrapper.on("click", ".app-input-datepicker-day", function() {
            var e = $(this);
            if ($(this).hasClass("app-selected")) $(this).removeClass("selected app-selected"), delete d.datesPicked[e.data("value")];
            else $(this).addClass("selected app-selected"), d.datesPicked[e.data("value")] = !0;
            d.options.callbackClickDay(this)
        })
    }, this.isValidMailSyntax = function(e) {
        return /^([\w-\+]+(?:\.[\w-\+]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(e)
    }, this.leadTrackingExceptionManager = {
        init: function(e) {
            n = e, i = {
                gaNotAvailable: +!((window.ga || ga.length) && ga.create)
            }
        },
        addFormParams: function() {
            Object.keys(i).map(function(e, t) {
                var a = i[e];
                $(n).append('<input type="hidden" name="' + e + '" value="' + a + '"/>')
            })
        },
        gaNotAvailable: function() {
            return i.gaAvailable
        }
    }, this.serializeSearchParameters = function(e) {
        var a = {
                id_grupo: "group_id",
                id_sector: "sector_id",
                "id_sector[]": "sector_id[]",
                id_region: "state_id",
                id_provincia: "region_id",
                id_poblacion: "city_id",
                id_geozona: "geozone_id",
                NumPage: "page"
            },
            i = ["geozone", "idPoblacion", "idGeozona", "idProvincia", "txtStrPoblacion", "descProvincia", "descGeozona", "descPoblacion"],
            n = "";
        return $.each(e.serializeArray(), function(e, t) {
            if (-1 === i.indexOf(t.name) && "" !== t.value && 0 !== t.value && -1 !== t.value) {
                if ("US" === globals.Request_Country && t.name in a) t.name = a[t.name];
                n += "&" + t.name + "=" + encodeURIComponent(t.value)
            }
        }), n = n.substring(1)
    }, this.animateScrollToElement = function(e, t) {
        if (null == t) t = {};
        if (null == t.offset) t.offset = 0;
        $("html, body").animate({
            scrollTop: $(e).offset().top + t.offset
        }, 600)
    }, this.trackEcClick = function(e) {
        var t = $(e).closest(".app-ec-item").data("id-empresa"),
            a = $(e).closest(".app-ec-list").data("ec-list");
        if (window.ecommerce && window.ecommerce.clickTraces && window.ecommerce.clickTraces[a] && window.ecommerce.clickTraces[a][t]) ga("ec:addProduct", window.ecommerce.clickTraces[a][t]), ga("ec:setAction", "click", {
            list: a
        }), ga("send", "event", "Ecommerce", "Click")
    }
}
var bodas = new BodasLib,
    GeoLocationManager = function() {
        var i = {};

        function t() {
            return a("GEO_LOC")
        }

        function a(e) {
            if (i.hasOwnProperty(e)) return i[e];
            var t = bodas.getCookie(e);
            if (t) {
                var a = t.split("|");
                return i[e] = {
                    precisionLevel: Number(a[0]),
                    idCity: a[1] ? Number(a[1]) : null,
                    idRegion: a[2] ? Number(a[2]) : null,
                    idState: a[3] ? Number(a[3]) : null,
                    displayCity: a[4] ? a[4].replace(/\+/g, " ") : null,
                    displayRegion: a[5] ? a[5].replace(/\+/g, " ") : null,
                    displayState: a[6] ? a[6].replace(/\+/g, " ") : null,
                    urlCity: a[7] ? a[7] : null,
                    urlRegion: a[8] ? a[8] : null,
                    urlState: a[9] ? a[9] : null,
                    idRegionWW: a[10] ? a[10] : null,
                    idStateWW: a[11] ? a[11] : null,
                    latitude: a[12] ? a[12] : null,
                    longitude: a[13] ? a[13] : null
                }, i[e]
            }
            return null
        }
        return {
            getGeoLocation: t,
            getLastLocation: function() {
                var e = a("GEO_LAST");
                if (null == e) e = t();
                return e
            }
        }
    }();

function InternalTrackingConfig(e, t, a) {
    a = a || {}, this.idCategory = e, this.idAction = t, this.name = a.name, this.extraData = a.extraData || {}
}
var funcReady = $(document.body).ready;
if ("function" == typeof fastReady) funcReady = fastReady;
funcReady(function() {
    try {
        if (parent && parent.internalTrackingService.loaded || internalTrackingService.loaded) return void(internalTrackingService = parent.internalTrackingService)
    } catch (e) {}
    if ("function" == typeof SetCookie) internalTrackingService.getCookieFunction = GetCookie, internalTrackingService.setCookieFunction = SetCookie;
    else if ("function" == typeof mobile_common_GetCookie) internalTrackingService.getCookieFunction = mobile_common_GetCookie, internalTrackingService.setCookieFunction = mobile_common_SetCookieTime;
    var e = internalTrackingService.getCookieFunction("it-nfd");
    if (null !== e && e.length) try {
        if ("object" == typeof(e = JSON.parse(internalTrackingService.getCookieFunction("it-nfd")))) internalTrackingService.nextFormData = e
    } catch (e) {
        console.log("Error parsing cookie NITS")
    }
    var t = $(".app-internal-tracking-native-api");
    if (0 < t.length) internalTrackingService.setLeadNextFormData(t, !0);
    internalTrackingService.setCookieFunction("it-nfd", ""), internalTrackingService.loaded = !0;
    var a = $(".app-internal-tracking-form");
    if (0 < a.length) a.each(function() {
        internalTrackingService.trackForm(this, !0)
    });
    internalTrackingService.bindForms(document.body), $(document.body).on("click", ".app-internal-tracking-set-lead-info", function() {
        internalTrackingService.setLeadNextFormData(this, !1)
    });
    var i = "beforeunload";
    if ("onpagehide" in window && bodas.isSafari()) i = "pagehide";
    $(window).bind(i, function() {
        internalTrackingService.onBeforeUnloadTrigger()
    })
});
var internalTrackingService = function() {
    var a = {},
        i = 0,
        n = {};

    function o(e) {
        $(e).on("change", ".app-internal-tracking-form input, .app-internal-tracking-form select, .app-internal-tracking-form textarea", function() {
            var e = $(this).closest(".app-internal-tracking-form"),
                t = $(this).attr("name"),
                a = $(this).val(),
                i = internalTrackingService.createConfigFromData(e, 0);
            internalTrackingService.setUserHistory(i, t, a)
        }), $(e).on("submit-success", ".app-internal-tracking-form", function() {
            var e = $(this),
                t = internalTrackingService.createConfigFromData(e, 4);
            if (internalTrackingService.untrackOnBeforeUnload(t), !e[0].insertedHiddenPageGuid) e.prepend($("<input type='hidden' name='it-page-guid-" + t.idCategory + "' value='" + e.attr("data-internal-tracking-page-GUID") + "'/>")), e[0].insertedHiddenPageGuid = !0;
            if (e.hasClass("catalog-lead-submission")) {
                var a = e.data("itExtraNumEmpresasShown") || 1;
                window.uetq = window.uetq || [], window.uetq.push("event", "Lead Submitted", {
                    event_category: "Directory",
                    event_value: a
                })
            }
            t.idAction = 3, internalTrackingService.track(t)
        }), $(e).on("submit-abandon", ".app-internal-tracking-form", function() {
            var e = internalTrackingService.createConfigFromData($(this), 4);
            internalTrackingService.untrackOnBeforeUnload(e), internalTrackingService.track(e)
        }), $(e).on("click", ".app-internal-tracking-form", function() {
            if (!this.internalTrackingClicked && !$(this).data("it-ignore-click")) {
                this.internalTrackingClicked = !0;
                var e = internalTrackingService.createConfigFromData($(this), 5);
                internalTrackingService.track(e)
            }
        }), $(e).on("submit-error", ".app-internal-tracking-form", function() {
            var e = internalTrackingService.createConfigFromData($(this), 2);
            internalTrackingService.track(e)
        })
    }

    function r(e) {
        for (var t in e) {
            var a = e[t];
            a.history = s(a), a.fields = l(a), e[t] = a
        }
        return e
    }

    function s(e) {
        var t = e.idCategory + " " + e.name;
        return n[t] || []
    }

    function l(e) {
        var t = $(".app-internal-tracking-form[data-it-id-category=" + e.idCategory + "]"),
            a = {};
        return t.find("input, select, textarea").each(function() {
            var e = $(this).attr("name");
            if (e) a[e] = $(this).val()
        }), a
    }
    return this._trackStoredOnBeforeUnloadTrackings = function() {
        var e = {
                trackings: r(a)
            },
            t = !0;
        if ("onpagehide" in window && bodas.isSafari()) t = !1;
        $.ajax({
            type: "POST",
            url: "/trace/internalTracking.php",
            data: e,
            async: t
        }), a = [], i = 0
    }, {
        track: function(e) {
            if (!(e instanceof InternalTrackingConfig)) return console.log("Object given is not a configuration"), !1;
            var t = {
                trackings: r({
                    singleTrack: e
                })
            };
            return $.post("/trace/internalTracking.php", t), !0
        },
        trackOnBeforeUnload: function(e) {
            if (!a[e.idCategory + " " + e.name]) i++;
            a[e.idCategory + " " + e.name] = e
        },
        untrackOnBeforeUnload: function(e) {
            if (a[e.idCategory + " " + e.name]) i--;
            delete a[e.idCategory + " " + e.name]
        },
        onBeforeUnloadTrigger: function() {
            if (0 < i) _trackStoredOnBeforeUnloadTrackings()
        },
        getUserHistory: s,
        setUserHistory: function(e, t, a) {
            var i = e.idCategory + " " + e.name;
            n[i] = n[i] || [], n[i].push([t, a])
        },
        triggerSubmit: function(e, t) {
            var a = $(e);
            if (t) a.trigger("submit-success");
            else a.trigger("submit-error")
        },
        triggerAbandon: function(e) {
            $(e).trigger("submit-abandon")
        },
        createConfigFromData: function(e, t) {
            var a = e.data("it-id-category"),
                i = {
                    extraData: {}
                };
            if (!$.isEmptyObject(this.nextFormData) && !e[0].nextFormData) e[0].nextFormData = this.nextFormData, this.nextFormData = {};
            for (var n in e[0].nextFormData) i.extraData[n] = e[0].nextFormData[n];
            if ([].slice.apply(e[0].attributes).forEach(function(e) {
                    if (/^data-it-extra-/.test(e.name)) i.extraData[e.name.substring(14)] = e.value
                }), i.extraData.pageGUID = e.attr("data-internal-tracking-page-GUID"), i.name = i.extraData.pageGUID, i.extraData.url = window.location.href, i.extraData.referrer = document.referrer, "undefined" != typeof reduced) i.extraData.reduced = reduced;
            else if (void 0 !== parent.reduced) i.extraData.reduced = parent.reduced;
            if (2 == t) i.extraData.errorMessage = this.nextError || e.find($(e.data("it-error-box"))).text().trim(), this.nextError = "";
            return new InternalTrackingConfig(a, t, i)
        },
        trackForm: function(e, t) {
            if (!t) o(e);
            var a = $(e);
            a.attr("data-internal-tracking-page-GUID", GuidManager.guidGenerator());
            var i = a.find("input[name=frmInsert]");
            if (i.val()) a.attr("data-it-extra-frm-insert", i.val());
            var n = this.createConfigFromData(a, 1);
            if (a.attr("data-it-guid-input") && !a[0].insertedHiddenPageGuid) a.prepend($("<input type='hidden' name='it-page-guid-" + n.idCategory + "' value='" + a.attr("data-internal-tracking-page-GUID") + "'/>")), a[0].insertedHiddenPageGuid = !0;
            if (!a.data("it-do-not-track")) internalTrackingService.track(n), n.idAction = 4, internalTrackingService.trackOnBeforeUnload(n)
        },
        bindForms: o,
        getCookieFunction: function() {
            return ""
        },
        setCookieFunction: function() {},
        setLeadNextFormData: function(e, t) {
            var a = $(e),
                i = a.closest(".app-internal-tracking-page").data("it-page"),
                n = a.closest(".app-internal-tracking-item").data("it-position"),
                o = a.closest(".app-internal-tracking-item").data("it-frm-insert"),
                r = {};
            if (i) r.page = i;
            if (n) r.position = n;
            if (o) r["frm-insert"] = o;
            if (t) internalTrackingService.nextFormData = r;
            else if (!$.isEmptyObject(r)) this.setCookieFunction("it-nfd", JSON.stringify(r))
        },
        nextFormData: {}
    }
}();
window.core = window.core || {}, window.core.utils = window.core.utils || {}, window.isUseProxyAppUpload = window.isUseProxyAppUpload || !1, window.core.utils.crop = new function() {
    this.init = function(options) {
        var defaultOptions = {
            buttonStartElement: ".app-croppie-browse-button",
            buttonUploadElement: ".app-croppie-upload-button",
            buttonNoCropUploadElement: ".app-croppie-no-crop-upload-button",
            containerElement: ".app-croppie-preview",
            url: "",
            rol: "",
            inputs: {},
            title: 'Crop your photo',
            width: 300,
            height: 300,
            section: "",
            uploadCropLoaderClass: "isloading",
            redirect: "",
            maxFilesize: 30,
            widthBoundary: function() {
                return .9 * $(".app-croppie-container").width()
            },
            heightBoundary: function() {
                return .7 * $(".app-croppie-container").width()
            }
        };
        if (0 === options.section.indexOf("mobile")) defaultOptions.width = 200, defaultOptions.height = 200, defaultOptions.uploadCropLoaderClass = "isloading isloading--white";
        options = $.extend(defaultOptions, options);
        var _this = $(options.buttonStartElement);
        if (_this.options = options, _this.uploadDisabled = !1, -1 !== ["tools-main-front", "my-wedding", "mobile-my-wedding"].indexOf(_this.options.section)) _this.options.isContainerStartButton = !0;
        if (_this.hasClass("app-no-photo") || 0 < _this.find(".app-no-photo").length) _this.forceReload = !0;
        if (window.isUseProxyAppUpload) _this.on("click", function() {
            if (!_this.uploadDisabled) {
                var platforms = ["android", "iOS"],
                    apps = ["Users", "Vendors", "Wedshoots"],
                    proxy, proxyPlatform, proxyname;
                e: for (var i in platforms)
                    for (var j in apps) {
                        if (proxyname = platforms[i] + "App" + apps[j] + "Proxy", proxyPlatform = platforms[i], "iOS" === proxyPlatform) proxyname += "Uploader";
                        if (proxy = window[proxyname], void 0 !== proxy) break e
                    }
                if (void 0 !== proxy) {
                    $(window).off("callbackProxy").on("callbackProxy", function(e, t) {
                        $(window).off("callbackProxy"), delete window.proxyThis, _this.uploadDisabled = !1, _this.urlProxy = t.urlThumb, _this.filenameOriginal = t.filenameOriginal, _this.filenameThumb = t.filenameThumb, _this.openCrop()
                    }), _this.$clickedButton = $(this), _this.options.rol = _this.$clickedButton.data("rol");
                    var useProxyInBrowser = !window.isUsersAppVersion;
                    if (useProxyInBrowser) {
                        var input = $("<input type='file' name='file' accept='image/jpeg,image/jpg,image/gif,image/png' style='display:none' />");
                        input.insertAfter(this), input.on("change", function() {
                            var file = this.files[0];
                            if (!_this.isCorrectFilesize(file)) return !1;
                            _this.uploadDisabled = !0, addLoader(_this.$clickedButton, _this.options.uploadCropLoaderClass, _this.options.isContainerStartButton);
                            var formData = new FormData,
                                reader = new FileReader;
                            reader.onload = function(e) {
                                var imageBase64 = e.target.result,
                                    orientation = _this.getOrientation(imageBase64),
                                    img = new Image;
                                img.onload = function() {
                                    var width = img.width,
                                        height = img.height,
                                        canvas = document.createElement("canvas"),
                                        ctx = canvas.getContext("2d"),
                                        ratio;
                                    if (4 < orientation && orientation < 9) ratio = Math.max(1, height / 1024), canvas.width = Math.floor(height / ratio), canvas.height = Math.floor(width / ratio);
                                    else ratio = Math.max(1, width / 1024), canvas.width = Math.floor(width / ratio), canvas.height = Math.floor(height / ratio);
                                    switch (orientation) {
                                        case 2:
                                            ctx.transform(-1, 0, 0, 1, canvas.width, 0);
                                            break;
                                        case 3:
                                            ctx.transform(-1, 0, 0, -1, canvas.width, canvas.height);
                                            break;
                                        case 4:
                                            ctx.transform(1, 0, 0, -1, 0, canvas.height);
                                            break;
                                        case 5:
                                            ctx.transform(0, 1, 1, 0, 0, 0);
                                            break;
                                        case 6:
                                            ctx.transform(0, 1, -1, 0, canvas.height, 0);
                                            break;
                                        case 7:
                                            ctx.transform(0, -1, -1, 0, canvas.height, canvas.width);
                                            break;
                                        case 8:
                                            ctx.transform(0, -1, 1, 0, 0, canvas.width)
                                    }
                                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height), canvas.toBlob(function(image) {
                                        formData.append("Filedata", image), formData.append("type", "PROXY"), $.ajax({
                                            url: "/uploaders/appUploader.php",
                                            data: formData,
                                            type: "POST",
                                            processData: !1,
                                            contentType: !1,
                                            success: function(response) {
                                                if (0 < response.errorCode) _this.uploadDisabled = !1, removeLoader(_this.$clickedButton, _this.options.isContainerStartButton);
                                                else eval(response.callback)
                                            }
                                        })
                                    })
                                }, img.src = imageBase64
                            }, reader.readAsDataURL(file)
                        }), input.click()
                    } else {
                        var proxyCall;
                        window.proxyThis = _this;
                        var base64BeforeCallback = btoa("(" + function() {
                                proxyThis.uploadDisabled = !0, addLoader(proxyThis.$clickedButton, proxyThis.options.uploadCropLoaderClass, proxyThis.options.isContainerStartButton)
                            }.toString() + ")()"),
                            base64ErrorCallback = btoa("(" + function() {
                                proxyThis.uploadDisabled = !1, removeLoader(proxyThis.$clickedButton, proxyThis.options.isContainerStartButton), delete window.proxyThis
                            }.toString() + ")()");
                        if ("android" === proxyPlatform) proxyCall = proxyname + ".uploader('PROXY', '" + base64BeforeCallback + "', '" + base64ErrorCallback + "')";
                        else if ("iOS" === proxyPlatform) proxyCall = proxyname + "('UPLOAD_INLINE', 'PROXY', '" + base64BeforeCallback + "', '" + base64ErrorCallback + "')";
                        eval(proxyCall)
                    }
                }
            }
        });
        else _this.on("click", function() {
            var e = $("<input type='file' name='file' accept='image/jpeg,image/jpg,image/gif,image/png' style='display:none' />");
            _this.$clickedButton = $(this), _this.options.rol = _this.$clickedButton.data("rol"), e.insertAfter(this), e.on("change", function() {
                var e = this.files[0];
                if (!_this.isCorrectFilesize(e)) return !1;
                addLoader(_this.$clickedButton, _this.options.uploadCropLoaderClass, _this.options.isContainerStartButton), _this.file = e, _this.openCrop(), $(this).remove()
            }), e.click()
        });
        _this.isCorrectFilesize = function(e) {
            if (e && e.size / 1024 / 1024 > _this.options.maxFilesize) return !1;
            else return !0
        }, _this.getOrientation = function(e) {
            if (!e) return 1;
            var t = ";base64,",
                a = e.indexOf(t) + t.length,
                i = e.substring(a),
                n = window.atob(i),
                o = n.length,
                r = new Uint8Array(new ArrayBuffer(o));
            for (m = 0; m < o; m++) r[m] = n.charCodeAt(m);
            var s = new DataView(r.buffer);
            if (65496 !== s.getUint16(0, !1)) return 1;
            for (var l = s.byteLength, c = 2; c < l;) {
                if (s.getUint16(c + 2, !1) <= 8) return 1;
                var d = s.getUint16(c, !1);
                if (c += 2, 65505 === d) {
                    if (1165519206 !== s.getUint32(c += 2, !1)) return 1;
                    var p = 18761 === s.getUint16(c += 6, !1);
                    c += s.getUint32(c + 4, p);
                    var u = s.getUint16(c, p);
                    c += 2;
                    for (var m = 0; m < u; m++)
                        if (274 === s.getUint16(c + 12 * m, p)) return s.getUint16(c + 12 * m + 8, p)
                } else if (65280 != (65280 & d)) break;
                else c += s.getUint16(c, !1)
            }
        }, _this.openCrop = function() {
            if (!_this.urlProxy) {
                var e = new FileReader;
                e.onload = function(e) {
                    t(e.target.result)
                }, e.readAsDataURL(_this.file)
            } else t();

            function t(e) {
                var t = _this.getOrientation(e);
                if (modal = $.modal({
                        template: "croppie",
                        urlForm: _this.options.url,
                        origen: _this.options.section,
                        center: !0,
                        title: _this.options.title,
                        backdrop: !0,
                        callback: function() {
                            removeLoader(_this.$clickedButton, _this.options.isContainerStartButton)
                        }
                    }), _this.crop = $(_this.options.containerElement).croppie({
                        url: _this.urlProxy,
                        enableOrientation: !0,
                        viewport: {
                            width: _this.options.width,
                            height: _this.options.height,
                            quality: 1,
                            type: "square"
                        },
                        boundary: {
                            width: "function" == typeof _this.options.widthBoundary ? _this.options.widthBoundary() : _this.options.widthBoundary,
                            height: "function" == typeof _this.options.heightBoundary ? _this.options.heightBoundary() : _this.options.heightBoundary
                        }
                    }), !_this.urlProxy) _this.crop.croppie("bind", {
                    url: e,
                    orientation: t
                });
                $(_this.options.buttonUploadElement).on("click", function(e) {
                    if (e.preventDefault(), e.stopPropagation(), !_this.uploadDisabled)
                        if (addLoader(this, _this.options.uploadCropLoaderClass), $(_this.options.buttonNoCropUploadElement).fadeTo(850, .01), _this.uploadDisabled = !0, _this.urlProxy) _this.sendCroppedImage(null, !1, _this.crop.croppie("get").points);
                        else _this.crop.croppie("result", {
                            type: "blob",
                            size: {
                                width: 1024
                            },
                            format: "jpg",
                            quality: 1
                        }).then(function(e) {
                            _this.sendCroppedImage(e)
                        })
                }), $(_this.options.buttonNoCropUploadElement).on("click", function() {
                    if (!_this.uploadDisabled)
                        if ($(_this.options.buttonUploadElement).fadeTo(850, .01), addLoader(this, "isloading isloading--gray"), _this.uploadDisabled = !0, _this.urlProxy) _this.sendCroppedImage(null, !0);
                        else _this.sendCroppedImage(_this.file, !0)
                }), _this.crop.addClass("ready")
            }
        }, _this.refreshImages = function(e) {
            var t = Math.random();
            (e = e || $("img[src*='usuarios/fotos'], img[src*='usr/']")).each(function() {
                if (this.src = this.src + "?" + t, this.srcset) this.srcset = this.srcset.replace(/(http.*?)(\?.+?)? /g, "$1?r=" + t + " ")
            })
        }, _this.sendCroppedImage = function(e, t, a) {
            var i = _this.options.url,
                n = new FormData;
            if (_this.urlProxy) a = a || [], i = "/uploaders/proxyApp", n.append("x1", a[0]), n.append("y1", a[1]), n.append("x2", a[2]), n.append("y2", a[3]), n.append("filenameOriginal", _this.filenameOriginal), n.append("filenameThumb", _this.filenameThumb), n.append("noCrop", t ? "1" : "0");
            else n.append("file", e);
            for (var o in n.append("origen", _this.options.section), _this.options.rol && n.append("rol", _this.options.rol), _this.options.inputs) {
                var r = _this.options.inputs[o];
                n.append(o, r)
            }
            $.ajax({
                url: i,
                data: n,
                type: "POST",
                processData: !1,
                contentType: !1,
                success: function(e) {
                    if (_this.uploadDisabled = !1, !_this.forceReload) switch (_this.options.section) {
                        case "profile":
                            modal.close(), _this.refreshImages(), $("#tool-modal").modal("hide");
                            break;
                        case "tools-main-front":
                            modal.close(), _this.refreshImages($("img.app-tools-main-front-img")), $(".app-tools-main-front-img-is-cover").attr("src", e.url).removeAttr("srcset"), $(".app-tools-main-front-img-is-cover").removeClass("app-tools-main-front-img-is-cover").addClass("app-tools-main-front-img");
                            break;
                        case "my-wedding":
                            modal.close();
                            var t = "owner" == e.rol ? "bride" : "groom";
                            _this.refreshImages($("img[src*='print_" + t + "']")), (a = $(".app-foto-" + e.rol + "-container")).html("<img class='app-tools-wedding-foto-" + e.rol + " rounded-modal-photo' width='150' border='0' src='" + e.filename + "?r=" + Math.random() + "'>"), $(".app-hover-" + e.rol).css("display", "");
                            break;
                        case "contest":
                            if (modal.close(), _this.refreshImages(), 0 < $(".avatar-thumb", ".modal").length) $(".avatar-thumb", ".modal").attr("src", e.url);
                            else $(".avatar", ".modal").html("<figure><img class='avatar-thumb' src='" + e.url + "'></figure>");
                            break;
                        case "invitation":
                            modal.close(), $('input[name="headerImage"]').val(e.imgname), $("#prevHeaderImg").attr("src", e.url), $(".app-show-hide-upload").addClass("dnone");
                            break;
                        case "layer":
                            location.reload();
                            break;
                        case "review":
                            modal.close(), $("#app-common-layer").modal("hide");
                            break;
                        case "owners":
                            (a = $(".adminFormUpload")).find("i").remove(), a.find("img").remove(), a.find('input[name="ownerImage"]').val(e.fileName), a.prepend("<img class='rounded-modal-photo mt20' width='150' border='0' src='" + e.url + "?r=" + Math.random() + "'>"), modal.close();
                            break;
                        case "website":
                            modal.close();
                            var a = $("#app-common-upload-container");
                            if ($(".photo-gallery-import").hasClass("dnone")) a.find("#imageList input[name='Ficheros[]']").val(e.params.fileName), a.find("#imageList input[name^=ficherosFileName]").attr("name", "ficherosFileName[" + e.params.fileName + "]").val(e.params.fileName);
                            else va_plupload_galeryAddImage({
                                fileID: e.params.fileName,
                                fileName: e.params.fileName,
                                urlImg: e.params.urlFoto,
                                crop: !0
                            }, "app-common-upload-container"), $(".photo-gallery-import").addClass("dnone");
                            a.find("img").attr("src", e.params.urlFoto).show();
                            break;
                        case "mobile-profile":
                            window.location.reload();
                            break;
                        case "mobile-my-wedding":
                            modal.close(), _this.filter("[data-rol=" + e.rol + "]").find(".app-mobile-image-my-wedding").replaceWith(e.html);
                            break;
                        case "mobile-tools-main-front":
                            modal.close(), _this.refreshImages($("img.app-tools-main-front-img")), $(".app-tools-main-front-img-is-cover").attr("src", e.url).removeAttr("srcset"), $(".app-tools-main-front-img-is-cover").removeClass("app-tools-main-front-img-is-cover").addClass("app-tools-main-front-img");
                            break;
                        case "mobile-review":
                            location.href = _this.options.redirect;
                            break;
                        case "mobile-contest":
                            $.ajax({
                                type: "POST",
                                async: !1,
                                url: "/tools/ConcursoSolicitarBoletoRun",
                                success: function(e) {
                                    location.href = "/tools/ConcursoBoletos?msgOk=" + e
                                }
                            });
                            break;
                        case "mobile-onboarding":
                            var i = $("#imgAvatar img");
                            $(".loading-wrapper").addClass("dnone"), i.error(function() {
                                i.removeAttr("src").attr("src", e.url + "1")
                            }).attr("src", e.url);
                            break;
                        default:
                            modal.close()
                    } else window.location.reload()
                }
            })
        }
    }
}, window.core = window.core || {}, window.core.utils = window.core.utils || {}, window.core.utils.rw = new function() {
    var e = ["fileWidth", "fileHeight", "fileHash", "fileSize"];
    this.createImageUploadFieldsInputs = function(a) {
        var i = $("#" + a);
        e.forEach(function(e) {
            var t = e + "[" + a + "]";
            i.append($('<input type="hidden" name="' + t + '"/>'))
        })
    }, this.modifyImageUploadFieldsByResponse = function(t, a) {
        var i = $("#" + a);
        e.forEach(function(e) {
            i.find('input[name="' + e + "[" + a + ']"]').val(t[e])
        })
    }
};
var navigationPos = 0,
    maxNavigationPos = 0,
    boxscroll, api, LAYER_ACTIONS = {
        emptyBride: 4,
        emptyData: 5,
        confirmData: 6
    };
if ("undefined" == typeof console || void 0 === console.log) console = {
    log: function() {}
};
if (function(t) {
        t.fn.common_showBreadcrumbSubitems = function(e) {
            return t(this).hover(function() {
                if (t(this).addClass("open"), t(this).find(".bread-menu").length) t(this).find(".bread-menu").attr("style", "display:block;");
                else e(), t(this).find(".bread-menu").attr("style", "display:block;")
            }, function() {
                t(this).removeClass("open"), t(this).find(".bread-menu").attr("style", "display:none;")
            }), !1
        }
    }(jQuery), function(t) {
        t.fn.common_hideShowFade = function(e) {
            if ("none" == t(this).css("display")) {
                if ("function" == typeof e) e();
                t(this).fadeIn()
            } else t(this).fadeOut(500, function() {
                if ("function" == typeof e) e();
                t(this).fadeIn()
            });
            return !1
        }
    }(jQuery), function(t) {
        t.fn.common_hideShow = function(e) {
            if ("none" == t(this).css("display")) {
                if ("function" == typeof e) e();
                t(this).slideToggle()
            } else t(this).slideToggle(500, function() {
                if ("function" == typeof e) e();
                t(this).slideToggle()
            });
            return !1
        }
    }(jQuery), jQuery.fn.cleanWhitespace = function() {
        return textNodes = this.contents().filter(function() {
            return 3 == this.nodeType && !/\S/.test(this.nodeValue)
        }).remove(), this
    }, !Array.prototype.indexOf) Array.prototype.indexOf = function(e, t) {
    for (var a = t || 0, i = this.length; a < i; a++)
        if (this[a] === e) return a;
    return -1
};

function profile_modifReload() {
    location.reload()
}

function checkBrowser() {
    if (!!window.opr && !!opr.addons || !!window.opera || 0 <= navigator.userAgent.indexOf(" OPR/")) return "Opera";
    if ("undefined" != typeof InstallTrigger) return "Firefox";
    if (/constructor/i.test(window.HTMLElement) || "[object SafariRemoteNotification]" === (!window.safari || safari.pushNotification).toString()) return "Safari";
    var e = !!document.documentMode;
    if (e) return "Explorer";
    if (!e && !!window.StyleMedia) return "Edge";
    if (!!window.chrome && !!window.chrome.webstore) return "Chrome";
    else return "Browser not detected"
}

function common_stripTrailingSlash(e) {
    if ("/" == e.substr(-1)) return e.substr(0, e.length - 1);
    else return e
}

function strtr(e, t, a) {
    var i, n, o, r = "";
    for (i = 0, n = e.length; i < n; i++)
        if (0 <= (o = t.indexOf(e.charAt(i)))) r += a.charAt(o);
        else r += e.charAt(i);
    return r
}

function _s() {
    var e = arguments[0];
    return String.prototype.sprintf.apply(e, Array.prototype.slice.call(arguments, 1))
}

function _ns() {
    var e;
    if (1 == arguments[2]) e = arguments[0];
    else e = arguments[1];
    return String.prototype.sprintf.apply(e, Array.prototype.slice.call(arguments, 3))
}

function nl2br(e, t) {
    return (e + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1" + (t || void 0 === t ? "<br />" : "<br>") + "$2")
}

function com_load_editor(e, t, a, i) {
    $.extend(jQuery.trumbowyg.langs.en, {
        bold: 'Bold',
        em: 'Italics',
        insertImage: 'Add image',
        insertVideo: 'Add video',
        link: 'Link',
        createLink: 'Add link',
        unlink: 'Delete link',
        title: 'Title',
        text: 'Text',
        target: 'Target',
        insertImageBodas: 'Add image',
        insertLinkBodas: 'Add link',
        insertVideoBodas: 'Add video',
        insertEmojiBodas: 'Add an emoji',
        insertGifBodas: 'Insert GIF',
        submit: 'Send',
        reset: 'Cancel',
        unorderedList: 'Bullets',
        orderedList: 'Numbers',
        undo: 'Undo',
        redo: 'Redo',
        justifyLeft: 'Left align',
        justifyCenter: 'Center',
        justifyRight: 'Right align'
    });
    var n, o = ["bold", "italic"],
        r = $(".app-trumbowyg-editor");
    if (i) n = o.concat(["unorderedList", "orderedList", "undo", "redo"]);
    else if (a) n = o.concat(["unlink", "insertLinkBodas", "unorderedList", "orderedList", "undo", "redo"]);
    else {
        if (null !== r && 1 == r.data("isAdmin")) o = o.concat(["justifyLeft", "justifyCenter", "justifyRight"]);
        n = o.concat(["unlink", "insertLinkBodas", "insertEmojiBodas"])
    }
    if (t) n = n.concat(["insertImageBodas", "insertVideoBodas"]);
    if (t && globals.tenor.apikey) n = n.concat(["insertGifBodas"]);
    var s = {
        btns: [n],
        hideButtonTexts: !0,
        svgPath: !1,
        semantic: !1,
        tagsToRemove: ["script"]
    };
    return $(e).trumbowyg(s)
}

function common_tiny_complete_init() {
    common_tiny_init({
        valid_elements: "strong/b,em/i,strike,u,#p[align],-ol[type|compact],-ul[type|compact],-li,br,-span[style],-a[href|title|target]",
        plugins: "paste,bodas,link,spellchecker,lists",
        toolbar: "mymenubutton bold italic | justifyleft ustifyfull bullist numlist | undo redo"
    })
}

function common_tiny_init(a, e, t) {
    if (void 0 === e) e = !1;
    if (void 0 === t) t = !1;
    var i = a || {},
        n = "es";
    switch (globals.Request_Language) {
        case "en":
            n = "en";
            break;
        case "it":
            n = "it";
            break;
        case "fr":
            n = "fr_FR";
            break;
        case "pt":
            n = "pt_" + globals.Request_Country
    }
    var o = {
        mode: "specific_textareas",
        editor_deselector: "app-no-tiny",
        menubar: !1,
        relative_urls: !1,
        remove_script_host: !1,
        schema: "html5",
        language: n,
        statusbar: !1,
        valid_elements: "strong/b,em/i,strike,u,#p[align],-ol[type|compact],-ul[type|compact],-li,br,-span[style]",
        plugins: "paste,bodas,link,lists",
        toolbar: "mymenubutton bold italic | bullist numlist | undo redo",
        content_css: globals.subdomain_cdn_css + "/assets/css/tiny/default.css",
        skin: "phoenix",
        readonly: 0
    };
    if ($(".app-tiny-focus").off("click").on("click", function() {
            if ($(this).attr("data-id-focus")) tinyMCE.get($(this).data("id-focus")).focus()
        }), i = $.extend({}, o, i), common_isMobileDevice() && (common_isAndroidDevice() || common_isSafariIpad())) {
        if (e)
            if (t) i.toolbar = "bold italic bodasAddPhoto bodasSmileys";
            else i.toolbar = "bold italic bodasSmileys";
        else i.toolbar = "bold italic";
        i.body_class = "tinyFix"
    } else if (common_isMobileDevice() || common_isInternetExplorer8()) i.toolbar = "bold italic";
    i.setup = function(e) {
        function t(e, t) {
            if ($(".app-common-captcha").is(":hidden"))
                if ($(".app-common-captcha").show(), !$(".app-common-captcha-img", ".app-common-captcha").attr("src")) $(".app-common-captcha-img", ".app-common-captcha").attr("src", "/captcha/captcha.php?" + Math.random())
        }
        if (e.on("keypress", t), e.on("paste", t), void 0 !== a.setup) a.setup(e)
    }, tinymce.init(i)
}

function common_teDIR(e) {
    common_trackEvent("Directorio", e)
}

function common_teME(e) {
    common_trackEvent("Menu Proveedor", e)
}

function common_teAR(e) {
    common_trackEvent("Articulos", e)
}

function common_teCOM(e) {
    common_trackEvent("Comunidad", e)
}

function common_teTOOL(e) {
    common_trackEvent("Tools", e)
}

function common_teCAT(e) {
    common_trackEvent("Catalogo", e)
}

function common_teSorteo(e) {
    ga_trackEventAll("PrizeDraw", e, e, 0, !1), common_trackEvent("Concurso", e)
}

function common_trackEvent(e, t) {
    common_getPageTrackerReduced()._trackEvent(e, t)
}

function common_getPageTrackerReduced() {
    return getPageTrackerReduced()
}

function common_getBrowser() {
    var e = {
        init: function() {
            this.browser = this.searchString(this.dataBrowser) || "An unknown browser", this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version", this.OS = this.searchString(this.dataOS) || "an unknown OS"
        },
        searchString: function(e) {
            for (var t = 0; t < e.length; t++) {
                var a = e[t].string,
                    i = e[t].prop;
                if (this.versionSearchString = e[t].versionSearch || e[t].identity, a) {
                    if (-1 != a.indexOf(e[t].subString)) return e[t].identity
                } else if (i) return e[t].identity
            }
        },
        searchVersion: function(e) {
            var t = e.indexOf(this.versionSearchString);
            if (-1 != t) return parseFloat(e.substring(t + this.versionSearchString.length + 1))
        },
        dataBrowser: [{
            string: navigator.userAgent,
            subString: "Chrome",
            identity: "Chrome"
        }, {
            string: navigator.userAgent,
            subString: "OmniWeb",
            versionSearch: "OmniWeb/",
            identity: "OmniWeb"
        }, {
            string: navigator.vendor,
            subString: "Apple",
            identity: "Safari",
            versionSearch: "Version"
        }, {
            prop: window.opera,
            identity: "Opera",
            versionSearch: "Version"
        }, {
            string: navigator.vendor,
            subString: "iCab",
            identity: "iCab"
        }, {
            string: navigator.vendor,
            subString: "KDE",
            identity: "Konqueror"
        }, {
            string: navigator.userAgent,
            subString: "Firefox",
            identity: "Firefox"
        }, {
            string: navigator.vendor,
            subString: "Camino",
            identity: "Camino"
        }, {
            string: navigator.userAgent,
            subString: "Netscape",
            identity: "Netscape"
        }, {
            string: navigator.userAgent,
            subString: "MSIE",
            identity: "Explorer",
            versionSearch: "MSIE"
        }, {
            string: navigator.userAgent,
            subString: "Gecko",
            identity: "Mozilla",
            versionSearch: "rv"
        }, {
            string: navigator.userAgent,
            subString: "Mozilla",
            identity: "Netscape",
            versionSearch: "Mozilla"
        }],
        dataOS: [{
            string: navigator.platform,
            subString: "Win",
            identity: "Windows"
        }, {
            string: navigator.platform,
            subString: "Mac",
            identity: "Mac"
        }, {
            string: navigator.userAgent,
            subString: "iPhone",
            identity: "iPhone/iPod"
        }, {
            string: navigator.platform,
            subString: "Linux",
            identity: "Linux"
        }]
    };
    return e.init(), e
}

function common_isInternetExplorer8() {
    return -1 !== navigator.userAgent.indexOf("MSIE 8.0")
}

function common_isMobileDevice() {
    if (-1 !== navigator.userAgent.indexOf("iPhone") || -1 !== navigator.userAgent.indexOf("iPod") || -1 !== navigator.userAgent.indexOf("iPad") || -1 !== navigator.userAgent.indexOf("symbian") || -1 !== navigator.userAgent.indexOf("android") || -1 !== navigator.userAgent.indexOf("Android") || -1 !== navigator.userAgent.indexOf("windows ce") || -1 !== navigator.userAgent.indexOf("blackberry") || -1 !== navigator.userAgent.indexOf("palm")) return !0;
    else return !1
}

function common_isTouchDevice() {
    if (isIENew()) return !1;
    if ("chrome" in window) return !!navigator.maxTouchPoints;
    else return "ontouchstart" in window || navigator.maxTouchPoints || window.DocumentTouch && document instanceof DocumentTouch
}

function common_getEventTouchDevice() {
    return common_isTouchDevice() ? "touchstart" : "click"
}

function common_isUploadAbleDevice() {
    if (-1 != navigator.userAgent.indexOf("iPhone") || -1 != navigator.userAgent.indexOf("iPod") || -1 != navigator.userAgent.indexOf("iPad") || -1 != navigator.userAgent.indexOf("symbian") || -1 != navigator.userAgent.indexOf("windows ce") || -1 != navigator.userAgent.indexOf("blackberry") || -1 != navigator.userAgent.indexOf("palm")) return !1;
    else return !0
}

function common_isIpad() {
    return navigator.userAgent.match("/iPad/i")
}

function common_isIpadNew() {
    return -1 != navigator.userAgent.indexOf("iPad")
}

function common_isAndroidDevice() {
    return -1 != navigator.userAgent.indexOf("Android")
}

function common_isSafariIpad() {
    return -1 != navigator.userAgent.indexOf("Safari") && -1 != navigator.userAgent.indexOf("iPad")
}

function common_isChromeIOS() {
    return navigator.userAgent.match("CriOS")
}

function common_isChromeIpad() {
    return -1 != navigator.userAgent.indexOf("CriOS") && -1 == navigator.userAgent.indexOf("Mobile")
}

function common_isIOS() {
    return navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? !0 : !1
}

function common_isSafari() {
    return -1 != navigator.userAgent.indexOf("Safari") && -1 == navigator.userAgent.indexOf("Chrome")
}

function common_debateCitar(e, t, a, i) {
    var n = null;
    if (null == i) i = "";
    if ("function" == typeof tinyMCE.getInstanceById)
        if (void 0 === tinyMCE.getInstanceById("Texto" + i)) $("#Texto" + i).val("\x3c!--[citar]--\x3e<p>" + 'Written by' + " " + e + ":</p><p> " + $.trim($("#msg_" + t).html()) + "</p><hr>\x3c!--[/citar]--\x3e<br/>\n\n"), $("#idCitado").val(a);
        else(n = tinyMCE.getInstanceById("Texto" + i)).setContent("\x3c!--[citar]--\x3e<p>" + 'Written by' + " " + e + ":</p><p> " + $.trim($("#msg_" + t).html()) + "</p><hr>\x3c!--[/citar]--\x3e<br/>"), $("#idCitado").val(a);
    else if (void 0 === tinyMCE.get("Texto" + i)) $("#Texto" + i).val("\x3c!--[citar]--\x3e<p>" + 'Written by' + " " + e + ":</p><p> " + $.trim($("#msg_" + t).html()) + "</p><hr>\x3c!--[/citar]--\x3e<br/>\n\n"), $("#idCitado").val(a);
    else(n = tinyMCE.get("Texto" + i)).setContent("\x3c!--[citar]--\x3e<p>" + 'Written by' + " " + e + ":</p><p> " + $.trim($("#msg_" + t).html()) + "</p><hr>\x3c!--[/citar]--\x3e<br/>&nbsp;"), $("#idCitado").val(a);
    if (null != n) n.selection.select(n.getBody(), !0), n.selection.collapse(!1), n.execCommand("mceInsertContent", !1, "<br> ");
    if (window.location.hash = "responder" + i, elemResponder = $("a[name='responder']"), 0 == elemResponder.length) elemResponder = $("#comentarios");
    window.scrollTo(0, elemResponder.offset().top - 200)
}

function common_header_showTab(e, t) {
    var a = $(t),
        i = a.find(".app-header-tab");
    if ($(e.target).hasClass("app-header-tab"))
        if (!a.attr("data-loaded")) {
            var n = a.find(".app-common-header-dropdown:first");
            a.attr("data-loaded", "true"), $(n).load("/utils-Tabs.php?tab=" + a.data("tab")), $(e.target).mouseenter(function() {
                i.addClass("show-caret"), $(this).parent().find(".app-common-header-dropdown:first").show()
            }), $(t).mouseleave(function() {
                i.removeClass("show-caret"), $(this).find(".app-common-header-dropdown:first").hide()
            }), $(n).show(), i.addClass("show-caret")
        }
}

function common_htmlInfoWithSmilies(e) {
    var t;
    return $.ajax({
        type: "POST",
        async: !1,
        url: "/com-HtmlInfoWithSmilies.php",
        data: {
            html: e
        },
        success: function(e) {
            t = e
        }
    }), t
}

function common_htmlInfoWithVideos(e) {
    var t = e.match(/app-video-preview/g);
    if (t) return t.length;
    else return 0
}

function common_htmlInfoWithGifs(e) {
    var t = e.match(/app-gif-preview/g);
    return t && t.length || 0
}

function common_insertHtmlGifContainer(n, o, e) {
    var t = n.val() || "weddings",
        r = n.data("typeSelector") || "Texto",
        s = n.data("offset"),
        a = e || !1;
    if (3 <= t.length || a) $.get("https://api.tenor.com/v1/search", {
        q: t,
        api_key: globals.tenor.apikey,
        limit: 12,
        pos: s
    }).done(function(e) {
        for (var t = e.results, a = "", i = 0; i < t.length; i++) a += '<div class="pure-u-1-4 app-modal-community-gif-image modalCommunityGifsItem" data-selector="' + r + '"><img class="modalCommunityGifsItem__img" src="' + t[i].media[0].nanogif.url + '" data-gif="' + t[i].media[0].gif.url + '"></div>';
        if (o.html(a).removeClass("dnone"), 100 < s || t.length < 12) n.data("offset", 0);
        else n.data("offset", s + 12);
        n.css({
            "padding-right": "100px"
        }), $(".app-modal-community-gif-shuffle").show()
    });
    else o.html("").addClass("dnone"), n.css({
        "padding-right": ""
    }), $(".app-modal-community-gif-shuffle").hide()
}

function common_validateRequiredFields(e) {
    return hasErrors = !1, $(e).find(".app-common-form-required").each(function() {
        if ($field = $(this), "" == $field.val()) return common_inputAlert($field), !(hasErrors = !0)
    }), !hasErrors
}

function common_validateNumber(e) {
    var t = null;
    return $.ajax({
        url: "/json/validatorNumber.php?number=" + encodeURIComponent(e),
        async: !1,
        dataType: "json",
        success: function(e) {
            t = e.result
        }
    }), t
}

function common_VerificaComentario(e, t, a) {
    tinyMCE.triggerSave();
    var i = common_htmlInfoWithSmilies($("#Texto").val());
    if (i.size < 5) return alert('The comment must contain at least 5 characters.'), !1;
    if (3 < i.numSmilies) return alert('Refrain from adding more than 3 emoticons, otherwise you will get dizzy reading the message.'), !1;
    else return common_callEnsureLogged(function() {
        t.submit()
    }, "inspiration", "tracking=" + a), !(document.frmComentario.btnSubmit.disabled = !0)
}

function common_showLoading(e) {
    $(e).html('<span class="loader" id="loader"></span>')
}

function common_validateProviderMailField(e) {
    return common_validateMailField(e, !1)
}

function common_searchEmpresa(l, e, c, t, d) {
    if (void 0 !== t) var a = "which" in t ? t.which : t.keyCode;
    c = void 0 !== c ? c : !1;
    d = $.extend({}, {
        onChange: function() {},
        addVendorOption: !0
    }, d);
    var i = $(l).closest("form"),
        p = $(".app-suggest-vendor-div-" + $(l).data("suffix") + ":first", i),
        u = $(".app-suggest-vendor-id-" + $(l).data("suffix") + ":first", i),
        m = u.parent().find($(".app-loader-line"));
    if (void 0 === t || void 0 !== t && 38 != a && 40 != a && 13 != a) {
        if ($(".app-community-add-vendor-button").hide(), $(".app-modal-content-still-looking").show(), "line" == d.loader) m.show();
        else p.addClass("loading").html($("<span />").addClass("loader"));
        var n = "/utils-SearchEmpresas.php?search=" + encodeURIComponent($(l).val()) + "&soloValidas=" + e + "&idCateg=" + ($(l).data("categs") || "") + "&idThumb=" + ($(l).data("id-thumb") || "") + "&idSector=" + $(l).data("sectors") + "&concurso=" + $(l).data("concurso");
        $.get(n, function(e) {
            var t, a, i, n, o, r = 0;
            if (u.val(""), ("0" === e.trim() || "" === e.trim()) && d.hideNoResults) return p.hide(), void m.hide();
            if ("line" == d.loader) m.hide(), p.html("").show();
            else p.removeClass("loading").html("").show();
            if (e = e.split("\n"), navigationPos = 0, maxNavigationPos = e.length, 1 < e.length) {
                t = $();
                for (var s = 0; s < e.length - 1; s++) {
                    if (a = e[s].split("||"), c) i = 1 != a[5] ? '<span style="background-color: #ffcccc">' : "", i += a[9] + " | " + a[2] + " (" + a[0] + ") | <strong>" + a[3] + "</strong>", i += 1 == a[5] ? "</span>" : "";
                    else i = "<span class='mr5'>" + a[9] + "</span> <span class='suggest-navigation-content'>" + a[2] + ", " + a[3] + "</span>";
                    n = $("<li />").attr("data-id", a[0]).attr("data-nombre", a[1]).html(i).addClass("suggest-navigation").addClass("suggest-item-navigation-" + (s + 1)).on("click", function() {
                        if (p.html("").hide(), $(l).val(unescape($(this).data("nombre"))).trigger("change"), u.val($(this).data("id")), d.onChange({
                                id: $(this).data("id")
                            }), $(l).attr("tabindex")) $("*[tabindex=" + (parseInt($(l).attr("tabindex")) + 1) + "]").focus();
                        $(".app-community-add-vendor-button").show(), $(".app-modal-content-still-looking").hide()
                    }), t = t.add(n)
                }
                if (r = e[s], p.append($("<div/>").addClass("column-container").append($("<ul />").addClass("box-scroll").append(t))), $.jScrollPane) boxscroll = p.find(".box-scroll").jScrollPane(), api = boxscroll.data("jsp")
            }
            if (0 === r) {
                if (p.append($("<div />").addClass("suggest-message-no-results").html('No matches have been found')), $(l).data("rate-vendor-option") && 0 < $(l).val().length) n = $("<div />").addClass("suggest-message-add-vendor").html($("<p />").html('Express you opinion about ' + " " + $(l).val())).on("click", function() {
                    if (p.html("").hide(), $(l).data("open-new-window")) window.open(globals.urls.tools.reviews + "?nombreEmpresa=" + $(l).val())
                }), p.append(n)
            } else if (10 < r) {
                if ($(l).data("add-vendor-option")) o = "suggest-message-num-results-soft";
                else o = "suggest-message-num-results";
                n = $("<div />").addClass(o).html('Showing' + " 10 " + 'vendors out of' + " " + r + " " + 'found'), p.append(n)
            }
            if ($(l).data("add-vendor-option") || d.addVendorOption) n = $("<div />").addClass("suggest-message-add-vendor").html($("<p />").html('Can\'t find the vendor? Click here')).on("click", function() {
                window[$(l).data("function-on-click-not-found")](l)
            }), p.append(n)
        })
    }
    if (void 0 !== t) {
        if (38 == a)
            if (0 < navigationPos) navigationPos--;
        if (40 == a)
            if (navigationPos < maxNavigationPos) navigationPos++;
        if (13 == a) {
            t.preventDefault();
            var o = p.find(".suggest-item-navigation-" + navigationPos);
            if (0 < o.length) return o.trigger("click"), !1;
            else return !0
        }
        p.find(".suggest-navigation").removeClass("bg"), p.find(".suggest-item-navigation-" + navigationPos).addClass("bg");
        var r = p.find(".suggest-item-navigation-" + navigationPos);
        if (api && 0 < navigationPos && navigationPos < maxNavigationPos)
            if (navigationPos == maxNavigationPos - 1) api.scrollToElement(r, !0);
            else api.scrollToElement(r)
    }
}

function common_searchEmpresaReset(e, t) {
    var a = $(e).closest("form");
    if (t = void 0 !== t ? t : !0, !common_isSafariIpad()) {
        var i = $(".app-suggest-vendor-div-" + $(e).data("suffix") + ":first", a),
            n = $(".app-suggest-vendor-id-" + $(e).data("suffix") + ":first", a);
        setTimeout(function() {
            if (!n.val())
                if (i.hide().html(""), t) $(e).val("")
        }, 500)
    }
}

function common_searchGiroReset(e) {
    if (!document.ignoreBlur) {
        var t = $(".app-suggest-giro-div-" + $(e).data("suffix") + ":first"),
            a = $(".app-suggest-giro-id-" + $(e).data("suffix") + ":first");
        setTimeout(function() {
            if (!a.val()) t.hide().html(""), $(e).val("")
        }, 300)
    }
}

function common_searchPoblacion(o, e, t, a, r) {
    if (void 0 !== t && null != t) var i = "which" in t ? t.which : t.keyCode;
    var s, l, c, n = 0;
    if ((r = r || {}).suggestContainer) s = $(r.suggestContainer).find(".app-suggest-poblacion-div-" + $(o).data("suffix") + ":first"), l = $(r.suggestContainer).find(".app-suggest-poblacion-id-" + $(o).data("suffix") + ":first"), c = $(r.suggestContainer).find(".app-suggest-provincia-id-" + $(o).data("suffix") + ":first");
    else s = $(".app-suggest-poblacion-div-" + $(o).data("suffix") + ":first"), l = $(".app-suggest-poblacion-id-" + $(o).data("suffix") + ":first"), c = $(".app-suggest-provincia-id-" + $(o).data("suffix") + ":first"), n = $(".app-suggest-filter-countries-" + $(o).data("suffix") + ":first").val();
    var d = "";
    if (a = void 0 !== a ? a : !1) d = window.location.protocol + "//" + globals.subdomain;
    if (r.cityWithDescRegion = void 0 !== r.cityWithDescRegion ? !!r.cityWithDescRegion : !0, void 0 === t || null == t || void 0 !== t && null != t && 38 != i && 40 != i && 13 != i) $.ajax({
        url: d + "/utils-SearchPoblacion.php",
        data: {
            id_pais: e,
            id_region: r.idRegion,
            search: $(o).val(),
            filterCountries: n,
            useCountryProject: r.useCountryProject ? 1 : 0,
            cityWithDescRegion: r.cityWithDescRegion ? 1 : 0
        }
    }).done(function(e) {
        var t, a, i;
        if (l.val(""), c) c.val("");
        if (s.removeClass("loading").html("").show(), e = e.split("\n"), navigationPos = 0, maxNavigationPos = e.length, 1 < e.length) {
            t = $();
            for (var n = 0; n < e.length - 1; n++) a = e[n].split("||"), i = $("<li />").attr("data-id-provincia", a[0]).attr("data-id-poblacion", a[1]).attr("data-nombre-poblacion", a[2]).addClass("suggest-navigation").addClass("suggest-item-navigation-" + (n + 1)).html('<strong class="mr5">' + a[3] + "</strong>" + (r.cityWithDescRegion ? "<span>" + a[4] + "</span>" : "")).on("click", function() {
                if (s.html("").hide(), $(o).val(unescape($(this).data("nombre-poblacion"))), c) c.val($(this).data("id-provincia"));
                if (l.val($(this).data("id-poblacion")).change(), $(o).attr("tabindex")) $("*[tabindex=" + (parseInt($(o).attr("tabindex")) + 1) + "]").focus()
            }), t = t.add(i);
            if (s.append($("<div/>").addClass("column-container").append($("<ul />").addClass("box-scroll").append(t))), $.jScrollPane) boxscroll = s.find(".box-scroll").jScrollPane(), api = boxscroll.data("jsp")
        } else if (!$(o).val()) s.append($("<div />").addClass("suggest-message-start-writing").html('Type the name of the location and select it from the list.'));
        else s.append($("<div />").addClass("suggest-message-no-results").html('No matches have been found'))
    });
    if (void 0 !== t) {
        if (38 == i)
            if (0 < navigationPos) navigationPos--;
        if (40 == i)
            if (navigationPos < maxNavigationPos) navigationPos++;
        if (13 == i) {
            t.preventDefault();
            var p = s.find(".suggest-item-navigation-" + navigationPos);
            if (0 < p.length) return p.trigger("click"), !1;
            else return !1
        }
        s.find(".suggest-navigation").removeClass("bg"), s.find(".suggest-item-navigation-" + navigationPos).addClass("bg");
        var u = s.find(".suggest-item-navigation-" + navigationPos);
        if (api && 0 < navigationPos && navigationPos < maxNavigationPos)
            if (navigationPos == maxNavigationPos - 1) api.scrollToElement(u, !0);
            else api.scrollToElement(u)
    }
}

function common_searchPoblacionAlertIfEmpty(e) {
    var t = $(".app-suggest-poblacion-div-" + $(e).data("suffix") + ":first");
    if (!$(e).val()) t.removeClass("loading").html("").show(), t.append($("<div />").addClass("suggest-message-start-writing").html('Type the name of the location and select it from the list.'));
    $(document).on("mousedown", function(e) {
        if (!t.is(e.target) && 0 === t.has(e.target).length) $(".app-suggest-poblacion-div-edit").addClass("dnone"), $(document).off("mousedown", arguments.callee)
    })
}

function common_success_message(e, t) {
    if ($(".app-success-box").html("<button type='button' class='app-succes-box-close close' data-dismiss='alert'>×</button><p class='app-success-box-text'></p>"), $(".app-success-box-text").html(e), $(".app-success-box").removeClass("dnone"), !t) $("html,body").animate({
        scrollTop: 0
    }, 200)
}

function common_searchGiroAlertIfEmpty(e) {
    var t = $(".app-suggest-giro-div-" + $(e).data("suffix") + ":first");
    if (!$(e).val()) t.removeClass("loading").html("").show(), t.append($("<div />").addClass("suggest-message-start-writing").html('Write the name of the activity and select it from the list.'))
}

function common_searchPoblacionReset(e, t) {
    if (!document.ignoreBlur) {
        var a = $(".app-suggest-poblacion-div-" + $(e).data("suffix") + ":first"),
            i = $(".app-suggest-poblacion-id-" + $(e).data("suffix") + ":first");
        $(".app-suggest-provincia-id-" + $(e).data("suffix") + ":first");
        if (t) {
            if (!i.val()) a.hide().html(""), $(e).val(""), $("#txtStrPoblacion").attr("size", $("#txtStrPoblacion").attr("placeholder").length), $(this).trigger("keyup")
        } else setTimeout(function() {
            if (!i.val()) a.hide().html(""), $(e).val("")
        }, 300)
    }
}

function common_searchShowChangePaisSelect() {
    $("#comboPaises").removeClass("dnone"), $("#infoPais").remove()
}

function common_searchChangePais(e) {
    $(e).val(""), $(".app-suggest-poblacion-div-" + $(e).data("suffix") + ":first").hide().html(""), $(".app-suggest-poblacion-id-" + $(e).data("suffix") + ":first").val(""), $(".app-suggest-provincia-id-" + $(e).data("suffix") + ":first").val("")
}

function common_changePaisAltaEmpresa() {
    var e = $("#PaisDestino option:selected").val(),
        t = $("#frmEmpresa"),
        a = e + "/emp-Alta.php?changeCountry=true";
    t.attr("action", a), t.submit()
}

function common_LoadBuscPage(e) {
    document.frmSearch.NumPage.value = e, document.frmSearch.submit()
}

function common_openLayer(e, t, a, i) {
    var n = $("#app-common-layer");
    if (void 0 === e) return console.error("empty url on common_openLayer()"), !1;
    var o = $.get(e).then(function(e) {
        if (n.html(e), null != t) t();
        if (void 0 !== a && !0 === a) n.modal({
            keyboard: !1,
            backdrop: "static"
        });
        else n.modal();
        return e
    });
    if (null != i) n.on("shown.bs.modal.main", function() {
        i(), $(this).off("shown.bs.modal.main")
    });
    return o
}

function common_closeLayer() {
    $("#app-common-layer").modal("hide")
}

function common_putInLayer(e, t) {
    $.get(e, function(e) {
        if ($("#app-common-layer").html(e), "function" == typeof t) t()
    })
}

function common_applyIcheck() {
    var e = $('input[type="radio"]:not(.app-not-icheck), input[type="checkbox"]:not(.app-not-icheck)'),
        t = {
            checkboxClass: "icheckbox_minimal",
            radioClass: "iradio_minimal",
            increaseArea: "20%"
        };
    e.each(function() {
        if ("grey" == $(this).data("icheck-skin")) t = {
            checkboxClass: "icheckbox_grey",
            radioClass: "iradio_grey",
            increaseArea: "20%"
        };
        $(this).iCheck(t)
    })
}

function common_specificApplyIcheck(e) {
    var t = "";
    if (e) t = e.find("input.app-icheck");
    else t = $(document.body).find("input.app-icheck");
    var a = {
        checkboxClass: "icheckbox_minimal",
        radioClass: "iradio_minimal",
        increaseArea: "20%"
    };
    if ("grey" == t.data("icheck-skin")) a = {
        checkboxClass: "icheckbox_grey",
        radioClass: "iradio_grey",
        increaseArea: "20%"
    };
    t.iCheck(a)
}

function common_forceApplyIcheck() {
    var e = $("input.app-not-icheck"),
        t = {
            checkboxClass: "icheckbox_minimal",
            radioClass: "iradio_minimal",
            increaseArea: "20%"
        };
    if ("grey" == e.data("icheck-skin")) t = {
        checkboxClass: "icheckbox_grey",
        radioClass: "iradio_grey",
        increaseArea: "20%"
    };
    e.iCheck(t)
}

function common_recoverPassword(e, t, a, o) {
    if (!0 === t) urlRedirect = window.location;
    else urlRedirect = "";
    if (a) a = 1;
    else a = 0;
    if (0 === e.trim().length) {
        if (o) common_inputAlertwithMessage(o, 'Provide your e-mail so that we can send you the password');
        else alert('Provide your e-mail so that we can send you the password');
        return !1
    }
    var r = e.trim();
    $.post("/com-RecuperaPasswordRun.php", {
        email: r,
        redirect: encodeURIComponent(urlRedirect),
        esRecuperaDatos: a
    }, function(e) {
        switch (parseInt(e.errCode)) {
            case 0:
                var t = r,
                    a = $("#hotmail"),
                    i = $("#gmail"),
                    n = $("#yahoo");
                if (a.hide(), i.hide(), n.hide(), $("#divBotonRecuperar").remove(), /@hotmail./.test(t) || /@live./.test(t)) a.show();
                else if (/@gmail.com$/.test(t)) i.show();
                else if (/@yahoo./.test(t)) n.show();
                $(".alert.alert-error").hide(), $("#email_enviado").slideDown();
                break;
            default:
                if (o) common_inputAlertwithMessage(o, 'We do not have a record of this e-mail address, make sure it is written correctly or try another.');
                else alert('We do not have a record of this e-mail address, make sure it is written correctly or try another.')
        }
    })
}

function common_upload_img(e, t) {
    var a = new Array(".jpg", ".gif", ".png"),
        i = document.getElementById("Imagen" + e).value,
        n = i.substring(i.lastIndexOf(".")).toLowerCase();
    if (i.length < 1) return alert('Select and image before uploading it'), !1;
    for (var o = !1, r = 0; r < a.length; r++)
        if (a[r] == n) {
            o = !0;
            break
        }
    if (!o) return alert('The image must be in .jpg or .gif format'), !1;
    if (document.getElementById("nfile").value = e, document.getElementById("tfile").value = "image", document.getElementById("frmImagen").target = "lFileUpload", 1 == t) document.getElementById("frmImagen").action = "admin-ContenidoUpload.php";
    else if (2 == t) document.getElementById("frmImagen").action = "/com-DebateContenidoUpload.php";
    else if (3 == t) document.getElementById("frmImagen").action = "admin-HoneyUpload.php";
    document.getElementById("frmImagen").submit(), document.getElementById("frmImagen").target = "", document.getElementById("frmImagen").value = "Guardar", document.getElementById("dImagen1").innerHTML = "<img src='" + globals.subdomain_cdn_img + "/assets/img/loading.gif'>"
}

function common_ponImagenGaleria(e) {
    var t = new Image;
    return t.name = e, t.onload = getWidthAndHeight, t.onerror = loadFailure, t.src = e, closeToolsLayer(), !1
}

function common_upload_img_run(e, t, a, i, n) {
    if (1 == i) $("#dImagen1").load("admin-ContenidoFotoShow.php?nombreimagen=" + e + "&xsize=" + t + "&ysize=" + a);
    else if (2 == i) $("#dImagen1").load("/com-DebateContenidoFotoShow.php?xsize=" + t + "&ysize=" + a + "&id_foto=" + n);
    else if (3 == i) $("#dImagen1").load("admin-HoneyFotoShow.php?nombreimagen=" + e + "&xsize=" + t + "&ysize=" + a)
}

function common_checkImageCorrectSize(e, n, o, r) {
    var t = $("#" + n.id + "_html5").get(0);
    if (void 0 === t) t = [], e.forEach(function(e) {
        t.push(e.getNative())
    });
    else t = t.files;
    $.each(t, function(a, i) {
        var e = new FileReader;
        e.onload = function(e) {
            var t = new Image;
            t.src = e.target.result, t.onload = function() {
                var e = o.settings;
                if (this.width > e.min_width && this.height > e.min_height) r(a);
                else n.splice(a, 1), alert(_s('Image size must be larger than %s', e.min_width + "x" + e.min_height + " (" + i.name + ")")), common_stop_spin(".app-spinner-container")
            }
        }, e.readAsDataURL(i)
    })
}

function common_comPointsLayerShow(e, t, a, i, n, o) {
    var r = _ns('You have earned <span class=\'strong red\'>%s</span> point!', 'You have earned <span class=\'strong red\'>%s</span> points!', t, t),
        s = "";
    if ("" !== i) s = '<i class="icon-community-rank icon-community-rank-level' + n + ' icon-left"></i>' + _ns('<strong>%s</strong> point to be <strong>%s</strong>', '<strong>%s</strong> points to be <strong>%s</strong>', a, a, i, i);
    html = '<div class="com-layer-points">    <button class="close" aria-label="Close" onclick="common_comPointsLayerHide();">&times;</button>    <div class="com-layer-points-awarded">        <span class="com-layer-points-points">' + t + "</span>        <strong>" + 'points' + '</strong>        <i class="icon-com icon-com-points-plus"></i>    </div>    <div class="com-layer-points-content">        <p class="com-layer-points-title">' + r + "</p>" + ("" !== i ? "<p>" + s + "</p>" : "") + '        <a class="btn-outline outline-rose" rel="nofollow" href="/users-badges.php">' + 'View my ranking' + "</a>    </div></div>";
    var l = $("<div>").html(html);
    return l.attr("id", "app-footer-com-point").addClass("com-layer-points-container"), l.appendTo("body"), l.animate({
        opacity: 0,
        bottom: "-20px"
    }, 0).animate({
        opacity: 1,
        bottom: "35px"
    }, 350, "easeOutElastic"), $(window).bind("load", function() {
        $.when(l.delay(4e3).animate({
            opacity: 1,
            bottom: "35px"
        }, 0).animate({
            opacity: 0,
            bottom: "-20px"
        }, 200)).then(function() {
            common_comPointsLayerHide()
        })
    }), !0
}

function common_comPointsLayerHide() {
    $("#app-footer-com-point").html(""), $("#app-footer-com-point").hide()
}

function common_comNewBadgeLayer(e) {
    $("#app-common-layer").load("/com-CapaNewBadge.php", function() {
        if (moreBadges = $(".capa-badge").hasClass("moreBadges"), noBadge = $(".capa-badge").hasClass("noBadge"), !noBadge) $("#app-common-layer").modal()
    }), $(".modal").on("hidden.bs.modal", function() {
        if (moreBadges) common_comNewBadgeLayer();
        else if (e) e()
    })
}

function common_showLayerFollowus(t) {
    if (t = t || window.reduced, 1 == GetCookie("hideSLF")) return !1;
    $(document).one("scroll", function() {
        SetCookieTime("hideSLF", "1", "15");
        var e = getTrackingDeviceAndSectionFromReduced(t);
        ga_trackEventAll("Social", "a-show", "d-" + e.device + "+s-" + e.section + "+o-popup", 0, 1), $("#app-common-footer-layer-followus").load("/com-FollowUsFooter.php?reduced=" + t)
    })
}

function common_hideLayerFollowus() {
    $("#app-common-footer-layer-followus").hide();
    var e = getTrackingDeviceAndSectionFromReduced(window.reduced);
    ga_trackEventAll("Social", "a-close", "d-" + e.device + "+s-" + e.section + "+o-popup", 0, !1), SetCookieTime("hideSLF", "1", "15")
}

function common_showConcursoFooter() {
    if (1 == GetCookie("hideSCF")) return !1;
    if (!common_isMobileDevice()) $(document).ready(function() {
        $("#app-common-footer-layer").load("/com-ConcursoFooter.php")
    })
}

function common_closeConcursoFooter() {
    $("#app-common-footer-layer").hide(), SetCookieSession("hideSCF", "1")
}

function common_closeAltaFoot() {
    $("#alta-layer").hide(), SetCookieSession("NotShowAltaFoot", "1")
}

function common_reenviarMaildeVerificacionNuevoUsuario() {
    return $.post("/com-ReenviarMailVerificacionAlta.php", function(e) {
        $(".app-common-resend-button").html('E-mail resent!')
    }), !1
}

function common_reenviarMaildeVerificacionNuevoUsuarioBadmail() {
    return $.post("/com-ReenviarMailVerificacionAlta.php", function(e) {
        $(".app-common-resend-button").html('E-mail resent!')
    }), !1
}

function common_updateNumChars(e, t, a) {
    var i = a - $(e).val().trim().length;
    if (i < 0) $(t).css("color", "green").html(_s('%s characters', $(e).val().trim().length));
    else $(t).css("color", "gray").html(_s('You need %s more characters', i))
}

function common_social_fbShare(e, t) {
    var a = screen.height / 2 - 160,
        i = screen.width / 2 - 320;
    if (common_socialTrack("facebook", "share"), common_isMobileDevice()) {
        var n = $.param({
            u: e,
            t: t
        });
        window.open("https://www.facebook.com/sharer/sharer.php?" + n)
    } else window.open("https://www.facebook.com/sharer.php?s=100&t=" + encodeURIComponent(t) + "&u=" + encodeURIComponent(e), "facebook_share", "top=" + a + ",left=" + i + ",toolbar=0,status=0,width=640,height=320")
}

function common_social_twitterShare(e, t, a) {
    common_socialTrack("twitter", "share");
    var i = screen.height / 2 - 130,
        n = screen.width / 2 - 320;
    a = a ? "&via=" + encodeURIComponent(a) : "", window.open("http://twitter.com/share?url=" + encodeURIComponent(e) + "&text=" + encodeURIComponent(t) + a, "twitter_share", "top=" + i + ",left=" + n + ",toolbar=0,status=0,width=640,height=260")
}

function common_social_pinterestShare() {
    common_socialTrack("pinterest", "share"), $.getScript("//assets.pinterest.com/js/pinmarklet.js?r=" + 99999999 * Math.random())
}

function common_social_share(e, t, a, i) {
    switch (e) {
        case "facebook":
            common_social_fbShare(t, a);
            break;
        case "twitter":
            common_social_twitterShare(t, a, i);
            break;
        case "pinterest":
            common_social_pinterestShare()
    }
}

function common_social_share_opinion_fb(e, t, a, i, n) {
    common_socialTrack("facebook", "share");
    var o = screen.height / 2 - 160,
        r = screen.width / 2 - 320;
    if ($.ajax({
            url: "/utils-TraceShare.php",
            data: {
                url: e,
                idEmpresa: t,
                idOpinion: a,
                tipoShare: 1
            }
        }), n) window.open("https://www.facebook.com/sharer.php?s=100&t=" + encodeURIComponent(i) + "&u=" + encodeURIComponent(e), "facebook_share", "top=" + o + ",left=" + r + ",toolbar=0,status=0,width=640,height=320");
    else window.open("https://www.facebook.com/dialog/feed?app_id=" + globals.Request_FB_AppID + "&display=popup&link=" + encodeURIComponent(e) + "&redirect_uri=" + encodeURIComponent(e), "facebook_share", "top=" + o + ",left=" + r + ",toolbar=0,status=0,width=640,height=320")
}

function common_social_share_opinion_twitter(e, t, a, i) {
    common_socialTrack("twitter", "share");
    var n = screen.height / 2 - 130,
        o = screen.width / 2 - 320;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idEmpresa: a,
            idOpinion: i,
            tipoShare: 2
        }
    }), window.open("http://twitter.com/share?url=" + encodeURIComponent(e) + "&text=" + encodeURIComponent(t), "twitter_share", "top=" + n + ",left=" + o + ",toolbar=0,status=0,width=640,height=260")
}

function common_social_share_cronica_fb(e, t, a, i) {
    common_socialTrack("fb", "share");
    var n = screen.height / 2 - 160,
        o = screen.width / 2 - 320;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idEmpresa: a,
            idReal: i,
            tipoShare: 1
        }
    }), window.open("https://www.facebook.com/sharer.php?s=100&t=" + encodeURIComponent(t) + "&u=" + encodeURIComponent(e), "facebook_share", "top=" + n + ",left=" + o + ",toolbar=0,status=0,width=640,height=320")
}

function common_social_share_cronica_twitter(e, t, a, i) {
    common_socialTrack("twitter", "share");
    var n = screen.height / 2 - 130,
        o = screen.width / 2 - 320;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idEmpresa: a,
            idReal: i,
            tipoShare: 2
        }
    }), window.open("http://twitter.com/share?url=" + encodeURIComponent(e) + "&text=" + encodeURIComponent(t), "twitter_share", "top=" + n + ",left=" + o + ",toolbar=0,status=0,width=640,height=260")
}

function common_social_share_sello_fb(e, t, a, i, n) {
    common_socialTrack("facebook", "share");
    var o = screen.height / 2 - 160,
        r = screen.width / 2 - 320;
    if ($.ajax({
            url: "/utils-TraceShare.php",
            data: {
                idEmpresa: t,
                idBadge: a,
                tipoShare: 1
            }
        }), n) window.open("https://www.facebook.com/sharer.php?s=100&t=" + encodeURIComponent(i) + "&u=" + encodeURIComponent(e), "facebook_share", "top=" + o + ",left=" + r + ",toolbar=0,status=0,width=640,height=320");
    else window.open("https://www.facebook.com/dialog/feed?app_id=" + globals.Request_FB_AppID + "&display=popup&link=" + encodeURIComponent(e) + "&redirect_uri=" + encodeURIComponent(e), "facebook_share", "top=" + o + ",left=" + r + ",toolbar=0,status=0,width=640,height=320")
}

function common_social_share_sello_twitter(e, t, a, i) {
    common_socialTrack("twitter", "share");
    var n = screen.height / 2 - 130,
        o = screen.width / 2 - 320;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idEmpresa: a,
            idBadge: i,
            tipoShare: 2
        },
        success: function(e) {}
    }), window.open("http://twitter.com/share?url=" + encodeURIComponent(e) + "&text=" + encodeURIComponent(t), "twitter_share", "top=" + n + ",left=" + o + ",toolbar=0,status=0,width=640,height=260")
}

function common_social_share_WeddingAwards_fb(e, t, a, i) {
    common_socialTrack("facebook", "share");
    var n = screen.height / 2 - 160,
        o = screen.width / 2 - 320;
    if ($.ajax({
            url: "/utils-TraceShare.php",
            data: {
                idEmpresa: t,
                tipoShare: 1,
                isWinnerEdition: globals.Request_Wedding_Awards_Edition
            }
        }), i) window.open("https://www.facebook.com/sharer.php?s=100&t=" + encodeURIComponent(a) + "&u=" + encodeURIComponent(e), "facebook_share", "top=" + n + ",left=" + o + ",toolbar=0,status=0,width=640,height=320");
    else window.open("https://www.facebook.com/dialog/feed?app_id=" + globals.Request_FB_AppID + "&display=popup&link=" + encodeURIComponent(e) + "&redirect_uri=" + encodeURIComponent(e), "facebook_share", "top=" + n + ",left=" + o + ",toolbar=0,status=0,width=640,height=320")
}

function common_social_share_WeddingAwards_twitter(e, t, a) {
    common_socialTrack("twitter", "share");
    var i = screen.height / 2 - 130,
        n = screen.width / 2 - 320;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idEmpresa: a,
            tipoShare: 2,
            isWinnerEdition: globals.Request_Wedding_Awards_Edition
        },
        success: function(e) {}
    }), window.open("http://twitter.com/share?url=" + encodeURIComponent(e) + "&text=" + encodeURIComponent(t), "twitter_share", "top=" + i + ",left=" + n + ",toolbar=0,status=0,width=640,height=260")
}

function common_social_share_ilustracion_fb(e) {
    common_socialTrack("facebook", "share");
    screen.height, screen.width;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idIlustracion: e,
            tipoShare: 1
        },
        success: function(e) {
            window.open(e.shareUrl)
        }
    })
}

function common_social_share_ilustracion_twitter(e, t, a) {
    common_socialTrack("twitter", "share");
    var i = screen.height / 2 - 130,
        n = screen.width / 2 - 320;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idIlustracion: a,
            tipoShare: 2
        },
        success: function(e) {}
    }), window.open("http://twitter.com/share?url=" + encodeURIComponent(e) + "&text=" + encodeURIComponent(t), "twitter_share", "top=" + i + ",left=" + n + ",toolbar=0,status=0,width=640,height=260")
}

function common_social_share_ilustracion_pinterest(e) {
    common_socialTrack("pinterest", "share");
    screen.height, screen.width;
    $.ajax({
        url: "/utils-TraceShare.php",
        data: {
            idIlustracion: e,
            tipoShare: 4
        },
        success: function(e) {
            window.open(e.shareUrl)
        }
    })
}

function common_getPageSize() {
    var e, t, a, i;
    if (window.innerHeight && window.scrollMaxY) e = document.body.scrollWidth, t = window.innerHeight + window.scrollMaxY;
    else if (document.body.scrollHeight > document.body.offsetHeight) e = document.body.scrollWidth, t = document.body.scrollHeight;
    else e = document.body.offsetWidth, t = document.body.offsetHeight;
    if (self.innerHeight) a = self.innerWidth, i = self.innerHeight;
    else if (document.documentElement && document.documentElement.clientHeight) a = document.documentElement.clientWidth, i = document.documentElement.clientHeight;
    else if (document.body) a = document.body.clientWidth, i = document.body.clientHeight;
    if (t < i) pageHeight = i;
    else pageHeight = t;
    if (e < a) pageWidth = a;
    else pageWidth = e;
    return arrayPageSize = new Array(pageWidth, pageHeight, a, i), arrayPageSize
}

function common_getPageScroll() {
    var e;
    if (self.pageYOffset) e = self.pageYOffset;
    else if (document.documentElement && document.documentElement.scrollTop) e = document.documentElement.scrollTop;
    else if (document.body) e = document.body.scrollTop;
    return arrayPageScroll = new Array("", e), arrayPageScroll
}

function common_getPosition(e) {
    var t = {
        x: 0,
        y: 0
    };
    if ((e = e || window.event).pageX || e.pageY) t.x = e.pageX, t.y = e.pageY;
    else {
        var a = document.documentElement,
            i = document.body;
        t.x = e.clientX + (a.scrollLeft || i.scrollLeft) - (a.clientLeft || 0), t.y = e.clientY + (a.scrollTop || i.scrollTop) - (a.clientTop || 0)
    }
    return t
}

function common_crearIframe(e) {
    var t, a = navigator.userAgent,
        i = /opera/i.test(a),
        n = /gecko/i.test(a);
    if (!i && !n)(t = document.createElement("iframe")).setAttribute("name", e), t.setAttribute("id", e), t.setAttribute("style", "display:none;"), document.body.appendChild(t);
    else(t = document.createElement("iframe")).id = e, t.name = e, t.style.display = "none", document.body.appendChild(t)
}

function common_bindTraceNavigation() {
    var e = $(document.body);
    if (e.hasClass("app-common-trace-navigation")) common_traceNavigation(e.data("trace-id-item"), e.data("trace-id-type"))
}

function common_traceNavigation(e, t) {
    var a = null,
        i = 5e3;

    function n() {
        if (null !== a) $.ajax({
            url: "/trace/trace-Update.php",
            async: !0,
            dataType: "json",
            data: {
                id: a
            }
        }).done(function(e) {
            setTimeout(n, i), i *= 2
        })
    }
    $(window).load(function() {
        $.ajax({
            url: "/trace/trace-Add.php",
            async: !0,
            dataType: "json",
            data: {
                reduced: reduced,
                idItem: e,
                idType: t,
                idAction: 1
            }
        }).done(function(e) {
            if (e.status) a = e.id, setTimeout(n, i), i *= 2
        })
    })
}

function common_footerSelectPais() {
    $("#app-footer-flags").load("/utils-FooterFlags.php", function() {
        $("#app-footer-flags").show(), $("#app-footer-flags").find("ul").toggle()
    })
}

function common_hideId(e, t) {
    e = t ? t + "_" + e : e, $("#" + e).hide()
}

function common_linkAccount() {
    if (!GetCookie("cla")) SetCookieTime("cla", 1, 7), common_openLayer("/tools/LinkAccount", function() {
        new AjaxFormManager($("#formVicularCuenta"), 3, function() {
            common_inputAlert($(".app-input-mail-la"))
        }, function() {
            SetCookie("cla", 1), common_success_message($(".app-input-mail-la").data("msgok"))
        });
        $("#linkedOmitir").on("click", function() {
            SetCookieTime("cla", 1, 7), $("#app-common-layer").modal("hide")
        }), $("#linkedDescartar").on("click", function() {
            SetCookie("cla", 1), $("#app-common-layer").modal("hide")
        })
    })
}

function common_linkedAccount() {
    common_openLayer("/tools/LinkedAccount", function() {
        new AjaxFormManager($("#formVicularCuenta"), null, null, function() {
            $("#app-common-layer").modal("hide")
        })
    })
}

function common_strip_html_tags(e) {
    var t = document.createElement("div");
    return t.innerHTML = e, t.textContent || t.innerText || ""
}

function isIE() {
    var e = navigator.userAgent.toLowerCase();
    return -1 != e.indexOf("msie") ? parseInt(e.split("msie")[1]) : !1
}

function isIENew() {
    var e = window.navigator.userAgent,
        t = e.indexOf("MSIE ");
    if (0 < t) return parseInt(e.substring(t + 5, e.indexOf(".", t)), 10);
    if (0 < e.indexOf("Trident/")) {
        var a = e.indexOf("rv:");
        return parseInt(e.substring(a + 3, e.indexOf(".", a)), 10)
    }
    var i = e.indexOf("Edge/");
    if (0 < i) return parseInt(e.substring(i + 5, e.indexOf(".", i)), 10);
    else return !1
}

function homeSliderInit(e) {
    if (!1 !== isIE() && isIE() < 9) setTimeout(function() {
        topSliderHome.init(e)
    }, 1500);
    else return topSliderHome.init(e)
}
String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, "")
}, String.prototype.sprintf = function() {
    var a = arguments,
        i = 0;
    return this.replace(/\%s/g, function(e, t) {
        return void 0 !== a[++i - 1] ? a[i - 1] : e
    })
}, Number.prototype.currency_format = function(e) {
    var t = globals.REQUEST_CURRENCY_PRECISION;
    if (void 0 !== e) t = e;
    var a = globals.thousandsSeparator,
        i = globals.decimalSeparator,
        n = "\\d(?=(\\d{3})+" + (0 < t ? "\\D" : "$") + ")",
        o = this.toFixed(Math.max(0, ~~t));
    return (i ? o.replace(".", i) : o).replace(new RegExp(n, "g"), "$&" + (a || ","))
};
var topSliderHome = function() {
    var o, i = ".app-main-slider-home",
        r = {},
        s = !1,
        l = function() {
            o.pagination.render(), o.pagination.update(), o.update()
        };
    return {
        init: function(e) {
            r = e, o = new Swiper(i, {
                    slideActiveClass: "app-main-slider-home-active",
                    autoplay: !0,
                    loop: !0,
                    simulateTouch: !1,
                    speed: 800,
                    delay: 500,
                    pagination: {
                        el: ".app-main-slider-home-bullet",
                        clickable: !0,
                        renderBullet: function(e, t) {
                            return '<span class="' + t + ' homeSlider__bullet"></span>'
                        }
                    },
                    effect: "fade"
                }),
                function() {
                    if ("true" === $(i).attr("data-static-title")) s = !0;
                    for (var e = {}, n = $(".app-main-slider-home-img").attr("src"), t = 1; t <= 4; t++) {
                        var a = 1 == t ? r.firstPictureIndex : Math.floor(Math.random() * r[t].imgs.length);
                        if (e[t] = {}, e[t].img = r[t].imgs[a].src, r[t].imgs[a].imgInfoText) e[t].imgInfoText = '<p class="mb25"><i class="homeSlider__iconCamera icon icon-camera-small-white"></i>' + r[t].imgs[a].imgInfoText + "</p>";
                        else {
                            if (r[t].imgs[a].NOVIO) e[t].imgInfoText = r[t].imgs[a].NOVIO;
                            if (r[t].imgs[a].NOVIA) e[t].imgInfoText += " & " + r[t].imgs[a].NOVIA;
                            if (r[t].imgs[a].DESC_POBLACION) e[t].imgInfoText += " (" + r[t].imgs[a].DESC_POBLACION + ")";
                            if (r[t].imgs[a].NOMBRE_EMPRESA) e[t].imgInfoText += '<p><i class="homeSlider__iconCamera icon icon-camera-small-white"></i>' + r[t].imgs[a].NOMBRE_EMPRESA + "</p>"
                        }
                        e[t].text = r[t].text
                    }
                    $.each(e, function(e, t) {
                        var a = t.img,
                            i = t.imgInfoText || "";
                        if (!(-1 < n.indexOf(a))) o.appendSlide('<div class="homeSlider__item swiper-slide"><div class="homeSlider__droplayer"></div><img class="homeSlider__itemImg app-main-slider-home-img" src="' + a + '" alt=""><div class="homeSlider__boxTags app-main-slider-home-caption"><div class="wrapper"><div class="homeSlider__tags app-main-slider-home-related">' + i + "</div></div></div></div>");
                        else $(".app-main-slider-home-related").html(i)
                    }), l()
                }(),
                function() {
                    if (!s) o.on("transitionStart", function() {
                        var e = o.realIndex;
                        $(".app-main-slider-home-title").html(r[e + 1].text)
                    })
                }()
        }
    }
}();

function homeSliderResize() {
    var e = $(".app-main-slider-home"),
        t = $(document.body).width() * (25 / 72);
    if (500 < t) t = 500;
    e.attr("style", "height:" + t + "px;")
}

function common_IframeConversion(e) {
    var t = document.getElementsByTagName("body")[0],
        a = document.createElement("iframe");
    e = e + "-" + Math.floor(1e4 * Math.random()), a.setAttribute("src", "/landing-AdwordsSolic.php?id=" + e), a.setAttribute("id", e), a.style.display = "none", t.appendChild(a)
}

function common_showMore(e, t) {
    if ($("#" + t).show(), $(e).next().show(), $(e).hide(), null != map) google.maps.event.trigger(map, "idle")
}

function common_addJavascriptLinks() {
    $(".app-general-item").each(function() {
        var e = $(this).find(".app-general-item-link").attr("href"),
            t = $(this).find(".app-general-item-linked");
        t.css("cursor", "pointer"), t.on("click", function() {
            window.location.href = e
        })
    })
}

function common_addBlackOver() {
    var e = $(".blackOver");
    if (0 == e.length) $("body").append('<div class="blackOver" style="display:none;"></div>'), e = $(".blackOver");
    e.css("height", $(document).height()).css({
        opacity: .5
    }).fadeIn("slow")
}

function common_removeBlackOver() {
    $("#layer-suggest-1,#layer-suggest-2").hide(), $(".blackOver").fadeOut("fast")
}

function common_jspDestroy() {
    $(".box-scroll").each(function() {
        $(this).jScrollPane(), $(this).data("jsp").destroy()
    })
}

function common_stickyForm(e, t) {
    var a = $("." + e),
        i = $("." + t);
    if (0 < i.length && 0 < a.length) {
        a.data("height", a.height()), i.data("top", i.offset().top);
        var n = i.height() < $("." + e + " > div > div").height() ? !0 : !1;
        if (i.data("top")) $(window).on("scroll", function() {
            if ($(this).scrollTop() > i.data("top") - 10 && n)
                if (i.addClass("fixed"), $(this).scrollTop() >= a.data("height") - (i.data("height") ? i.data("height") : i.height()) - 20 + i.data("top")) i.css({
                    position: "absolute",
                    top: a.data("height") - (i.data("height") ? i.data("height") : i.height() + 15)
                });
                else i.removeAttr("style");
            else if ($(this).scrollTop() <= i.data("top") && i.hasClass("fixed")) i.removeClass("fixed")
        })
    }
}

function common_getBase64FromImageUrl(e) {
    var t = document.createElement("canvas");
    if (!!(!t.getContext || !t.getContext("2d"))) return null;
    t.width = e.width, t.height = e.height, t.getContext("2d").drawImage(e, 0, 0);
    var a = t.toDataURL("image/png");
    return a = a.replace(/^data:image\/(png|jpg);base64,/, "")
}

function common_searchItem(l, c, d, p) {
    var e = $(l).val().trim(),
        u = $("#" + l.name + "_div");
    if (fncSetAux = function(e, t, a) {
            a = unescape(a);
            $("#" + e.name).val(a), $("#" + e.name + "_id").val(t), $("#" + e.name + "_listed").val("1")
        }, e.length < 2) return u.show(), void u.html("<span class='searchComm'>" + 'Type the name to search' + ".</span>");
    u.show(), u[0].style.visibility = "visible", u.html("<span class='searchComm'>" + 'Loading' + "</span>"), l = l;
    var t = "/json/searchItem.php?tipoItem=" + c + "&search=" + encodeURIComponent(e);
    if (2 == p) t = "/utils-SearchEmpresas.php?search=" + encodeURIComponent(e) + "&soloValidas=1&json=1";
    $.ajax({
        url: t,
        success: function(e) {
            if (2 == p) var t = e.empresas.length,
                a = e.empresas,
                i = "idEmpresa";
            else if (0 == e.nItems) t = 0;
            else t = (a = e.items).length, i = "id";
            if (0 != t) {
                for (var n = "", o = 0; o < t; o++) {
                    var r = (s = a[o]).descripcion;
                    if (2 == p) r = s.descSector + " | " + s.descRegion;
                    n += "<div style='background-color:#ffffff; padding:6px 10px;border-bottom:1px dotted #cccccc;'><a id='itemSuggest_" + c + "_" + s[i] + "' href='javascript:void(0);' class='gris'>" + s.nombre + "</a>&nbsp;&nbsp;&nbsp;<span class='small'>" + r + "</span></div>"
                }
                u.html(n);
                for (o = 0; o < t; o++) {
                    var s = a[o];
                    $("#itemSuggest_" + c + "_" + s[i]).click(function(e) {
                        return function() {
                            if (null != d) d(l, e[i], e.nombre);
                            else fncSetAux(l, e[i], e.nombre);
                            $("#" + l.name + "_div").html(""), $("#" + l.name + "_div").hide().delay(500)
                        }
                    }(s))
                }
            } else u.hide()
        }
    })
}

function common_relatedItemAdd(t, a, i, n, o) {
    $.ajax({
        url: "/com-RelatedContenIntoRelatedItem.php?mode=add&tipoItem=" + t + "&idItem=" + a + "&relatedTipoItem=" + i + "&relatedIdItem=" + n,
        success: function(e) {
            $('[data-id="' + i + '"]').append("<li data-id='" + i + "-" + n + "'>" + o + " <a>[x]</a></li>"), $('[data-id="' + i + "-" + n + '"] a').click(function() {
                common_relatedItemDelete(t, a, i, n)
            })
        }
    })
}

function common_relatedItemAddByAlgorithm(t, a, i, n, o, r) {
    if (!r) r = 0;
    $.ajax({
        url: "/com-RelatedContenIntoRelatedItem.php?mode=add&tipoItem=" + t + "&idItem=" + a + "&relatedTipoItem=" + i + "&relatedIdItem=" + n,
        success: function(e) {
            $('[data-id="' + i + '"]').append("<li data-id='" + i + "-" + n + "-" + r + "'>" + o + " (MANUAL) <a>&times;</a></li>"), $('[data-id="' + i + "-" + n + "-" + r + '"] a').click(function() {
                common_relatedItemDeleteByAlgorithm(t, a, i, n, r)
            })
        }
    })
}

function common_relatedItemDelete(e, t, a, i) {
    $.ajax({
        type: "GET",
        url: "/com-RelatedContenIntoRelatedItem.php",
        data: {
            mode: "dlt",
            tipoItem: e,
            idItem: t,
            relatedTipoItem: a,
            relatedIdItem: i,
            IdAlgorithm: 0
        },
        success: function(e) {
            $('[data-id="' + a + "-" + i + '"]').remove()
        }
    })
}

function common_relatedItemDeleteByAlgorithm(e, t, a, i, n) {
    if (!n) n = 0;
    $.ajax({
        type: "GET",
        url: "/com-RelatedContenIntoRelatedItem.php",
        data: {
            mode: "dlt",
            tipoItem: e,
            idItem: t,
            relatedTipoItem: a,
            relatedIdItem: i,
            IdAlgorithm: n
        },
        success: function(e) {
            $('[data-id="' + a + "-" + i + "-" + n + '"]').remove()
        }
    })
}

function common_badmailLayer() {
    if (!GetCookie("lbm")) SetCookieTime("lbm", 1, 7), common_openLayer("/tools/BadmailLayer", null, !0)
}

function common_ShowLayerAddReviewOrReal(e, t) {
    if (t = +(+t || +GetCookie("rwmu2")), e = +(+e || +GetCookie("rwmu1")), !(GetCookie("rwmu") || 1 == t && 1 == e))
        if (SetCookieTime("rwmu", 1, 1), 0 == e) SetCookieTime("rwmu1", 1, 7), common_openLayer("/com-LayerAddReview.php", null, !1);
        else if (0 == t) SetCookieTime("rwmu2", 1, 7), common_openLayer("/com-LayerAddReal.php", null, !1)
}

function common_ShowLayerAddReviewAndReal(e, t) {
    if (e = +(+e || +GetCookie("rerwmu")), t = +(+t || +GetCookie("rerwmu")), !(GetCookie("rerwmu") || 1 == t && 1 == e))
        if (0 == e || 0 == t) SetCookieTime("rerwmu", 1, 7), common_openLayer("/com-LayerAddReviewOrReal.php", null, !1)
}

function common_validarBadmail(e) {
    $("[id^=error]").hide();
    var t = e.badmail,
        a = e.fromBadmailLayer;
    if (!common_validateMailField(t)) return !1;
    else $.ajax({
        type: "POST",
        async: !1,
        url: "/com-ChangeEmailRun.php",
        data: {
            newEmail: $(t).val(),
            fromBadmailLayer: $(a).val()
        },
        success: function(e) {
            switch (e) {
                case "0":
                    return location.reload(), !0;
                case "1":
                    return $("#error").common_hideShow(function() {
                        $("#msgError").html('A user with this email address already exists.')
                    }), !1;
                default:
                    if ("-1" != e) return $("#error").common_hideShow(function() {
                        $("#msgError").html(e)
                    }), !1
            }
        }
    });
    return !1
}

function common_linkCorrectMail(e) {
    $("input[name*='mail'],input[name*='Mail']").val(e), $(".alert-error,.input-error").hide()
}

function common_VerficaEmailSolic(e) {
    if (email = e.value, "" != e.value)
        for (var t = email.split(","), a = 0; a < t.length; a++) {
            var i = common_validateMail(t[a].replace(/^\s+/g, "").replace(/\s+$/g, ""), !0, e.name);
            if (0 == i.estado) {
                var n = 'Wrong e-mail address';
                if (i.suggestion) n += i.suggestion;
                return alert(n), !1
            }
        }
    return !0
}

function common_disableEnterKey(e, t) {
    if (null != e.target && "undefined" != e.target && $(e.target).data("allowEnter")) return !0;
    if (void 0 !== t)
        if ("object" == typeof t) {
            if ("" == (a = t).val() && 13 == e.keyCode) return !1;
            else if ("" !== a.val() && 13 == e.keyCode) return !0
        } else if ("string" == typeof t) {
        var a;
        if ("" == (a = $(t)).val() && 13 == e.keyCode) return !1;
        else if ("" !== a.val() && 13 == e.keyCode) return !0
    }
    if (13 != e.keyCode) return !0;
    else return !1
}

function users_checkBoxBoletin(e) {
    $("#Boletin").val(e ? 1 : 0), $("#Ofertas").val(e ? 1 : 0)
}

function common_flushLocalStorage() {
    if (1 == GetCookie("PUSHER")) PusherManager.flush(), SetCookieSession("PUSHER", 0)
}

function common_checkVisibleOnScreen(e, t) {
    var a, i, n = e.getBoundingClientRect();
    if ("object" == typeof t) a = t.top || 0, i = t.bottom || 0;
    else i = a = t || 0;
    var o = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return !(n.bottom + a < 0 || 0 <= n.top - o - i)
}

function common_setImageFacebookProfile(e, t, a, i, n) {
    var o = {
        url: e,
        x1: t,
        y1: a,
        x2: i,
        y2: n
    };
    $.ajax({
        beforeSend: function() {
            $("#fbPictureContent").html("<p class='bigest mt20 mb20' style='text-align:center'><?= 'Importando foto de perfil'; ?><br /><img style='margin:auto'src='https://" + document.domain + "/img/ajax-loader-bar-blue.gif'></p>")
        },
        data: o,
        url: "/com-SetFotoFacebook.php",
        type: "POST",
        success: function(e) {
            if (1 == e) $("#fbPictureContent").html("<p class='bigest mt20 mb20' style='text-align:center'>" + escape("<?= 'No se ha podido importar tu foto de facebook'; ?>") + "<br /><div class='mb10 mt5 ml10 tacenter'><a href='javascript:void(0);' id='lImportFbPicture' class='fb-friends-big nolink strong noloader'><span><?= 'Reintentar'; ?></span></a></div></p>");
            else if (0 < $("#app-form-solicitar-boletos-buscador").length || 0 < $("#frmRecomendaciones").length || 0 < $("#app-rw-msg-alert").length || $(document.body).hasClass("app-logged-review")) $("#app-common-layer").modal("hide");
            else $("#tool-modal").modal("hide"), document.location.href = "/users-update.php"
        }
    })
}
var GuidManager = function() {
    var e = null;

    function t() {
        function e() {
            return Math.floor(65536 * (1 + Math.random())).toString(16).substring(1)
        }
        return e() + e() + "-" + e() + "-" + e() + "-" + e() + "-" + e() + e() + e() + "-" + (new Date).getTime()
    }
    return {
        init: function() {
            if (null == e)
                if (null == (e = GetCookie("GUID"))) SetCookie("GUID", e = t());
            return e
        },
        guidGenerator: t
    }
}();

function common_button_loader(e) {
    var t = {
            disable: !1,
            button: "",
            ajaxPromise: function() {
                return $.when()
            }
        },
        a = $.extend({}, t, e);
    if (a.ajaxPromise) {
        var i = $(a.button);
        if (e.disable) i.prop("disabled", "disabled");
        return i.addClass("loader-button").append('<span class="loader"></span>'), a.ajaxPromise().then(function() {
            if (i.removeClass("loader-button"), i.find(".loader").remove(), a.disable) i.removeProp("disabled")
        })
    }
}

function common_charge_spin(e) {
    var t = $(".app-pencil-profile");
    if (t.length) t.stop().fadeTo("slow", .33);
    $(e).append('<div class="spinner-container"><span class="loader" id="loader"></span></div>'), $(e).find("img").stop().fadeTo("slow", .33), $(e).find(".app-spinner-container-fadeto").stop().fadeTo("slow", .33)
}

function common_stop_spin(e) {
    var t = $(".app-pencil-profile");
    if (t.length) t.stop().fadeTo("slow", 1);
    $(e).find("img").stop().fadeTo("slow", 1), $(e).find(".app-spinner-container-fadeto").stop().fadeTo("slow", 1), $(".spinner-container").remove()
}

function common_ajaxManager_load() {
    var e = {
        "/ajaxManager/load.php": $(".app-ajax-manager"),
        "/ajaxManager/loadNoIndex.php": $(".app-ajax-manager-no-index")
    };
    for (var t in e) {
        var a = e[t];
        if (0 < a.length) {
            var n = [];
            a.each(function() {
                    n.push($(this).data("id"))
                }),
                function(e, i) {
                    $.post(e, {
                        ids: n
                    }, function(e) {
                        for (var t in e) {
                            var a = i.filter("[data-id='" + t + "']").parent();
                            i.filter("[data-id='" + t + "']").replaceWith(e[t]), a.trigger("ajax-manager-load")
                        }
                    })
                }(t, a)
        }
    }
}
var LandingVendorSlider = function() {
    var c, d = !1;

    function p(e, t) {
        if (e.activeIndex - 1 >= t) {
            if (e.activeIndex - 2 == t) e.slideTo(t + 1, 100);
            e.lockSwipeToNext(), $(e.container).find(".app-slider-btn-next").addClass("dnone");
            var a = $(e.container).find(".swiper-slide").eq(t + 1);
            if (!a.loadedSlideLead) u(e, t + 2), a.find(".app-lead-img").after($("<div>").append($(".app-lead-slide").detach().removeClass("dnone")).html()), a.loadedSlideLead = !0
        } else {
            if (e.unlockSwipeToNext(), e.activeIndex + 1 <= t) u(e, e.activeIndex + 1);
            $(e.container).find(".app-slider-btn-next").removeClass("dnone")
        }
        if (1 == e.activeIndex) e.lockSwipeToPrev(), $(e.container).find(".app-slider-btn-prev").addClass("dnone");
        else {
            if (0 == e.activeIndex) e.slideTo(1, 400);
            if (0 < e.activeIndex - 1) u(e, e.activeIndex - 1);
            e.unlockSwipeToPrev(), $(e.container).find(".app-slider-btn-prev").removeClass("dnone")
        }! function(e) {
            if ($(e.slides[e.activeIndex]).hasClass("app-vendor-slide-load-video")) $(e.container).addClass("icon icon-play-white pointer");
            else $(e.container).removeClass("icon icon-play-white pointer")
        }(e)
    }

    function u(e, t) {
        var a = $(e.container).closest(c),
            i = a.data("img-urls"),
            n = void 0 !== t ? t : e.activeIndex;
        if (!e.params.lazyLoading) {
            if (i.length) {
                var o = i.shift();
                a.data("img-urls", i);
                var r = '<div class="swiper-slide"><img src="' + o + '">';
                if (1 == i.length) r += $("<div>").append($(".app-lead-slide").detach().removeClass("dnone")).html();
                r += "</div>", e.appendSlide(r)
            }
        } else {
            var s = $(e.slides[n]).find("img[data-src]");
            if (void 0 !== s) s.attr("src", s.attr("data-src")), s.removeAttr("data-src")
        }
    }
    return {
        createDefault: function(n) {
            var l = [];
            return (c = $(".app-slider-container")).each(function() {
                if (!this.swiperLoaded) {
                    var o = $(this).data("total-imgs"),
                        t = $(this).data("track-views"),
                        r = $(".app-slider-title"),
                        s = $(".app-slider-description"),
                        e = {
                            slidesPerView: "auto",
                            centeredSlides: !0,
                            prevButton: ".app-slider-btn-prev",
                            nextButton: ".app-slider-btn-next",
                            initialSlide: 1,
                            observer: !0,
                            spaceBetween: 5,
                            watchSlidesVisibility: !0,
                            watchSlidesProgress: !0,
                            uniqueNavElements: !0,
                            onInit: function(e) {
                                if (1 == e.activeIndex) e.lockSwipeToPrev()
                            },
                            onSlideChangeStart: function(e) {
                                p(e, o)
                            },
                            onTransitionStart: function(e) {
                                if (function(e) {
                                        $(e.container).parent().find(".loader").show()
                                    }(e), e.container.find("video").each(function() {
                                        this.pause()
                                    }), void 0 !== e.params.wpPreloadNextAmount)
                                    for (var t = e.activeIndex; t <= e.activeIndex + e.params.wpPreloadNextAmount; t++) u(e, t);
                                if (void 0 !== e.params.wpPreloadPrevAmount)
                                    for (t = e.activeIndex - 1; t >= e.activeIndex - e.params.wpPreloadPrevAmount && 0 < t; t--) u(e, t);
                                if (e.activeIndex >= e.previousIndex) u(e);
                                var a = $(e.slides[e.activeIndex]),
                                    i = a.data("title"),
                                    n = a.data("description");
                                if (void 0 !== i) r.html(i);
                                if (void 0 !== n) s.html(n);
                                p(e, o)
                            },
                            onTransitionEnd: function(e) {
                                if (p(e, o), e.update(!0), function(e) {
                                        $(e.container).parent().find(".loader").hide()
                                    }(e), void 0 !== t && t) ! function(t) {
                                    if (1 == t.activeIndex && !d) return d = !0;
                                    var e = $("#app-vendor-slider-box").data("id-empresa");
                                    if (null != e && 0 !== e.length) $.ajax({
                                        url: "/emp-SliderAddPageView.php?idEmpresa=" + e
                                    }), setTimeout(function() {
                                        var e = t.activeIndex;
                                        ga_trackPageviewAll($(t.slides[e]).find("img").data("url"), reduced)
                                    }, 500)
                                }(e)
                            },
                            onImagesReady: function(e) {
                                e.update(!0)
                            }
                        },
                        a = $.extend({}, e, n);
                    this.swiperLoaded = !0;
                    var i = new Swiper(this, a);
                    this.swiper = i, l.push(i)
                }
            }), l
        },
        showOnImagesLoaded: function(e, t, a) {
            for (var i = a ? $(a) : $(".app-slider-container"), n = i.find("img"), o = 0, r = 0; r < n.length && r < e; r++) l(n[r], n[r].currentSrc || n[r].getAttribute("src"), n[r].srcset || n[r].getAttribute("srcset"), !0, s);

            function s() {
                if (++o == e)
                    if ("function" == typeof t) t(i);
                    else i.removeClass("dnone")
            }

            function l(e, t, a, i, n) {
                var o;

                function r() {
                    if (n) n()
                }
                if (!e.complete || !i)
                    if (t) {
                        if ((o = new window.Image).onload = r, o.onerror = r, a) o.srcset = a;
                        if (t) o.src = t
                    } else r();
                else r()
            }
        }
    }
}();

function common_articles_menu_showCategories(a, e) {
    $(".app-articles-menu-categories[data-id-categ=" + e + "]").load("/contenido-MenuSubcategorias.php?idCateg=" + e, function() {
        var e = $(this),
            t = 90;
        if (e.is(":visible")) t = 0;
        a.find(".app-widget-sections-division-icon").css({
            "-webkit-transform": "rotate(" + t + "deg)",
            transform: "rotate(" + t + "deg)"
        }), e.stop(), e.slideToggle()
    })
}

function cleanUpSpecialChars(e, t) {
    return t = t || "", (e = (e = (e = (e = (e = e.replace(/[àáâãäå]/gi, "a")).replace(/[ÈÉÊË]/gi, "e")).replace(/[ÒÓÕ]/gi, "o")).replace(/[ÙÚ]/gi, "u")).replace(/[ÌÍ]/gi, "i")).replace(/[^a-z0-9 ]/gi, t)
}
var BannerPenalizer = function() {
    var s = "BFP_PEN";
    return {
        update: function(e, t) {
            e = e || {};
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                if (e[i]) {
                    if (e[i].ts < 5) e[i].ts++
                } else {
                    var n = Object.keys(e);
                    if (10 <= n.length) {
                        var o = n[0];
                        for (var r in e)
                            if (e[r].ts < e[o].ts) o = r;
                        delete e[o]
                    }
                    e[i] = {
                        ts: 1
                    }
                }
            }
            return SetCookieSession(s, JSON.stringify(e)), e
        },
        extractIdsFromPromise: function(e) {
            var t = [];
            for (var a in e) {
                var i = e[a];
                if (i.length) i = i[0];
                if (i.banner_ids && i.banner_ids.length) t = t.concat(i.banner_ids)
            }
            return t
        },
        get: function() {
            return JSON.parse(GetCookie(s) || "{}")
        }
    }
}();

function common_icon_hover(e) {
    if (e.jquery) e = e.selector;
    $(document.body).on("mouseenter", e, function() {
        var e = $(this).data("icon-old"),
            t = $(this).data("icon-new");
        $(this).find("." + e).removeClass(e).addClass(t)
    }), $(document.body).on("mouseleave", e, function() {
        var e = $(this).data("icon-old"),
            t = $(this).data("icon-new");
        $(this).find("." + t).removeClass(t).addClass(e)
    })
}

function common_dropdown_toggle(e, t) {
    if (t) return e.hide(), $(document.body).off("click.dropDownToggle", common_dropdown_hide), !1;
    else return e.show(), $(document.body).on("click.dropDownToggle", common_dropdown_hide), !0
}

function common_dropdown_hide(e) {
    var t = $(".app-dropdown-toggle-layer");
    if (0 === $(e.target).closest(t).length) t.data("isVisible", common_dropdown_toggle(t, !0))
}

function common_form_setautofocus(e) {
    e.find("input[type=text]:visible").first().focus()
}

function searchPlaceholderWidth(e) {
    var t = e[0].value || e[0].placeholder,
        a = (searchPlaceholderWidth.canvas || (searchPlaceholderWidth.canvas = document.createElement("canvas"))).getContext("2d");
    return a.font = "bold 15px Arial", a.measureText(t).width
}

function searchPlaceholderAnimation(e, t) {
    var a = searchPlaceholderWidth(e);
    if (t) e.css({
        width: a + "px",
        transition: "width 300ms ease",
        "-webkit-transition": "300ms ease",
        "-moz-transition": "300ms ease",
        "-ms-transition": "300ms ease",
        "-o-transition": "300ms ease"
    });
    else e.css({
        width: a + "px"
    })
}

function searchPlaceholderText(e, t, a) {
    if ("enter" == a) {
        var i = 'Search for';
        e[0].placeholder = i.toUpperCase(), t.show()
    } else e[0].placeholder = 'SEARCH', t.hide();
    searchPlaceholderAnimation(e, !0)
}

function hideSuggest(e) {
    e.hide()
}

function searchRemoveContent(e) {
    e.val("")
}
var BestSuggest = function(c) {
    c = $.extend({}, {
        container: ".app-best-suggest-box",
        containerInput: ".app-best-suggest-input",
        inputClear: ".app-best-suggest-clear-input",
        containerList: ".app-best-suggest-list",
        containerListHidden: ".app-best-suggest-list-hidden",
        listElement: ".app-best-suggest-list-element",
        zeroResultElement: ".app-best-suggest-zero-result"
    }, c);
    var d = $(c.container),
        e = d.find(c.inputClear),
        p = d.find(c.containerList),
        r = d.find(c.containerInput),
        t = p.css("height");
    r.on("focus", function() {
        if ($(this).val("").trigger("change"), p.is(":hidden")) p.css("height", "0px"), p.css("padding", "0px"), p.show();
        p.stop().animate({
            height: t,
            padding: "10px 0"
        }, 400, function() {
            p.css("height", "")
        })
    }), $(document.body).on("click", c.listElement, function() {
        r.val($(this).text().trim())
    }), r.on("blur", function(e) {
        if (document.ignoreBlur) return document.ignoreBlur = !1, void e.preventDefault();
        var t = $(this);
        t.val(t.data("name")), p.stop().animate({
            height: "0px",
            padding: "0px"
        }, 400, function() {
            p.hide().css("height", "").css("padding", "")
        })
    }), d.on("keydown", c.containerInput + ":focus", function(e) {
        if ($(this).data("enable-keyboard-navigation")) {
            var t, a = d.find(c.containerList + " > " + c.listElement),
                i = a.filter(".suggest-designer-current");
            if (38 == e.keyCode) {
                e.preventDefault();
                var n = i.prevAll(c.listElement + ":visible").eq(0);
                if (0 < n.length) {
                    if ($(this).data("enable-keyboard-navigation")) i.removeClass("suggest-designer-current"), n.addClass("suggest-designer-current");
                    if (t = p, n[0].offsetTop - t[0].scrollTop - n.height() - 100 < 0) t[0].scrollTop = n[0].offsetTop - ~~(t.height() / 2) + n.height()
                }
            } else if (40 == e.keyCode) {
                var o;
                if (e.preventDefault(), !i.length) i = o = a.filter(":visible").eq(0);
                else o = i.nextAll(c.listElement + ":visible").eq(0);
                if (0 < o.length) {
                    if ($(this).data("enable-keyboard-navigation")) i.removeClass("suggest-designer-current"), o.addClass("suggest-designer-current");
                    if (t = i.closest(c.containerList + ":visible"), o[0].offsetTop - t[0].scrollTop > ~~(t.height() / 2)) t[0].scrollTop = o[0].offsetTop - ~~(t.height() / 2) - o.height()
                }
            } else if (13 == e.keyCode) e.preventDefault(), r.val(i.text().trim()), i.click()
        }
    }), r.on("keyup change", function(e) {
        if (-1 == [38, 40, 13].indexOf(e.keyCode)) {
            var t = d,
                i = $(this).val().trim().toUpperCase();
            i = strtr(i, "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
            var a = $(c.containerListHidden),
                n = $(c.containerList),
                o = n.find(c.zeroResultElement).data("list");
            if ("ordered" == o && 0 < i.length || "business" == o && 0 == i.length) {
                var r = n.html();
                n.html(a.html()), a.html(r)
            }
            var s = 0,
                l = t.find(c.containerList + " > " + c.listElement);
            if (l.each(function() {
                    var e = $(this).data("name-suggest"),
                        t = e.split(" ");
                    if (0 != e.indexOf(i)) {
                        if (1 < t.length)
                            for (var a in t)
                                if (0 == t[a].indexOf(i)) return void $(this).show();
                        s++, $(this).hide()
                    } else $(this).show()
                }), s == l.length) return t.find(c.containerList + " > " + c.zeroResultElement).show(), void l.show();
            else t.find(c.containerList + " > " + c.zeroResultElement).hide();
            if (p[0].scrollTop = 0, $(this).data("enable-keyboard-navigation")) l.removeClass("suggest-designer-current"), l.filter(":visible").first().addClass("suggest-designer-current")
        }
    }), e.on("mousedown", function() {
        r.focus(), document.ignoreBlur = !0
    }), p.on("mousedown", function() {
        document.ignoreBlur = !0
    }), e.on("click", function() {
        r.val("").trigger("change").focus()
    })
};

function aboutToggleSuggest(t, a) {
    if (t.is(":visible")) t.addClass("dnone"), $(document.body).unbind(".bodas.layer");
    else {
        t.removeClass("dnone"), t.removeAttr("style");
        var e = t.find("input[type=text]");
        if (e.length) e.focus();
        $(document.body).bind("mouseup.bodas.layer", function(e) {
            if (!t.is(e.target) && 0 === a.has(e.target).length) t.addClass("dnone"), $(document.body).unbind("mouseup.bodas.layer")
        })
    }
}
var LoadingVendorTourSlider = function() {
        function n(e, t) {
            if (e.activeIndex + 1 >= t) e.lockSwipeToNext(), $(".app-slider-btn-next").addClass("dnone");
            else e.unlockSwipeToNext(), $(".app-slider-btn-next").removeClass("dnone");
            if (0 == e.activeIndex) e.lockSwipeToPrev(), $(".app-slider-btn-prev").addClass("dnone");
            else e.unlockSwipeToPrev(), $(".app-slider-btn-prev").removeClass("dnone")
        }
        return {
            createDefault: function(a) {
                $(".app-slider-container").each(function() {
                    if (!this.swiperLoaded) {
                        var i = $(this).data("total-items"),
                            e = ($(this).data("track-views"), {
                                slidesPerView: "auto",
                                centeredSlides: !0,
                                prevButton: ".app-slider-btn-prev",
                                nextButton: ".app-slider-btn-next",
                                initialSlide: 0,
                                observer: !0,
                                spaceBetween: 5,
                                watchSlidesVisibility: !0,
                                watchSlidesProgress: !0,
                                uniqueNavElements: !0,
                                onInit: function(e) {
                                    n(e, i)
                                },
                                onSlideChangeStart: function(e) {
                                    n(e, i)
                                },
                                onTransitionStart: function(e) {
                                    var t = $(e.slides[e.activeIndex]).data("title");
                                    if (void 0 !== t) $(".app-title-slider").html(t);
                                    var a = $(e.slides[e.activeIndex]).data("description");
                                    if (void 0 !== a)
                                        if ("" != a) $(".app-description-slider").html(a).show();
                                        else $(".app-description-slider").html(a).hide();
                                    n(e, i)
                                }
                            }),
                            t = $.extend({}, e, a);
                        return this.swiperLoaded = !0, new Swiper(this, t)
                    }
                })
            }
        }
    }(),
    SearchEmpresas = function() {
        var t = {
            selector: ".app-suggest-vendor",
            searchResultSelector: ".app-suggest-vendor-div",
            idInputSelector: ".app-suggest-vendor-id",
            loaderSelector: ".app-loader-line",
            moreItemsSelector: null,
            zeroItemsSelector: null,
            suffix: "default",
            renderItem: function(e) {
                var t;
                if (e.showId) {
                    var a = 1 != e.valid,
                        i = e.nombre + " | " + e.descSector + " (" + e.idEmpresa + ") | <span class='color-grey'>" + e.descRegion + "</span>";
                    if (a) t = '<span style="background-color: #ffcccc">' + i + "</span>";
                    else t = i
                } else t = e.snipped + ", <span class='color-grey'>" + e.descSector + " (" + e.descRegion + ")</span>";
                return '<li class="app-suggest-vendor-item pointer suggest-navigation suggest-item-navigation-' + e.index + '"     data-id="' + e.idEmpresa + '"     data-nombre="' + e.nombre + '">' + t + "</li>"
            },
            renderList: function(e) {
                return '<div class="column-container"><ul>' + e + "</ul></div>"
            },
            renderZeroItems: function() {
                return '<div class="suggest-message-no-results">' + 'No matches have been found' + "</div>"
            },
            renderMoreItems: function(e) {
                return '<div class="suggest-message-num-results">' + 'Showing' + " 10 " + 'vendors out of' + " " + e.numItems + " " + 'found' + "</div>"
            },
            showId: !1,
            soloValidas: !1,
            hideNoResults: !1,
            onChange: function() {},
            onZeroItemsClick: function() {},
            onSearch: function() {}
        };

        function a(e) {
            this.options = e, this.$el = $(e.selector), this.$listContainer = $(e.searchResultSelector + "-" + e.suffix), this.$idContainer = $(e.idInputSelector + "-" + e.suffix), this.$loaderSelector = $(e.loaderSelector), this.currentItem = 0, this.maxItems = null
        }

        function n(e, t) {
            if (t.$listContainer.html("").hide(), t.$el.val(decodeURIComponent(e.data("nombre"))), t.$idContainer.val(e.data("id")), t.options.onChange({
                    id: e.data("id")
                }), t.$el.attr("tabindex")) $("*[tabindex=" + (parseInt(t.$el.attr("tabindex")) + 1) + "]").focus()
        }
        return a.prototype.init = function() {
            var l = this;
            l.$listContainer.on("click", ".app-suggest-vendor-item", function() {
                n($(this), l)
            }), l.$el.on("keyup", function(e) {
                var t = SearchEmpresas.keyCode(e);
                if (e)
                    if (-1 === SearchEmpresas.disallowedKeycodes.indexOf(t)) {
                        l.$loaderSelector.show(), l.$listContainer.show();
                        var a = {
                            soloValidas: l.options.soloValidas,
                            idCateg: l.$el.data("categs"),
                            idThumb: l.$el.data("id-thumb"),
                            idSector: l.$el.data("sectors"),
                            concurso: l.$el.data("concurso")
                        };
                        l.options.onSearch(), SearchEmpresas.doSearch(l.$el.val(), a).then(function(e) {
                            if (0 != e.num || !l.options.hideNoResults) {
                                l.maxItems = e.empresas.length;
                                var t = e.num;
                                if (l.$loaderSelector.hide(), function(e) {
                                        if (e.options.moreItemsSelector) $(e.options.moreItemsSelector).html("").hide();
                                        if (e.options.zeroItemsSelector) $(e.options.zeroItemsSelector).html("").hide();
                                        $(".app-modal-content-still-looking").hide()
                                    }(l), 1 <= t) {
                                    for (var a = "", i = 0; i < e.empresas.length; i++) {
                                        var n = e.empresas[i];
                                        n.index = i, a += l.options.renderItem(n)
                                    }
                                    var o = l.options.renderList(a);
                                    l.$listContainer.html(o)
                                }
                                if (0 < t) {
                                    var r = l.options.renderMoreItems({
                                        numItems: t,
                                        maxItems: l.maxItems
                                    });
                                    if (l.options.moreItemsSelector) $(l.options.moreItemsSelector).html(r).show().find(".app-zero-items-click-" + l.options.suffix).on("click", function() {
                                        l.options.onZeroItemsClick(l)
                                    });
                                    else l.$listContainer.append(r)
                                } else if (0 == t) {
                                    if (l.$listContainer.html("").hide(), 0 < l.$el.val().length) {
                                        r = l.options.renderZeroItems();
                                        if (l.options.zeroItemsSelector) $(l.options.zeroItemsSelector).html(r).show().find(".app-zero-items-click-" + l.options.suffix).on("click", function() {
                                            l.options.onZeroItemsClick(l)
                                        });
                                        else l.$listContainer.html(r)
                                    } else $(".app-modal-content-still-looking").show();
                                    if (l.$el.data("rate-vendor-option") && 0 < l.$el.val().length) {
                                        r = '<div class="suggest-message-add-vendor"><p>' + 'Express you opinion about ' + " " + l.$el.val() + "</p></div>";
                                        var s = $(r).on("click", function() {
                                            l.$listContainer.html("").hide()
                                        });
                                        l.$listContainer.html(s)
                                    }
                                }
                            } else l.$listContainer.hide()
                        })
                    } else {
                        switch (t) {
                            case 38:
                                if (0 < l.currentItem) l.currentItem--;
                                break;
                            case 40:
                                if (l.currentItem < l.maxItems) l.currentItem++;
                                break;
                            case 13:
                                e.preventDefault();
                                var i = l.$listContainer.find(".suggest-item-navigation-" + l.currentItem);
                                if (0 < i.length) return n(i, l), !1;
                                else return !0
                        }
                        l.$listContainer.find(".suggest-navigation").removeClass("bg"), l.$listContainer.find(".suggest-item-navigation-" + l.currentItem).addClass("bg")
                    }
            }), l.$el.on("blur", function(e) {})
        }, {
            create: function(e) {
                return new a($.extend({}, t, e))
            },
            doSearch: function(e, t) {
                return t.search = e, t.json = 1, $.get("/utils-SearchEmpresas.php", t)
            },
            keyCode: function(e) {
                var t;
                if (e) t = "which" in e ? e.which : e.keyCode;
                return t
            },
            disallowedKeycodes: [38, 40, 13]
        }
    }(),
    tooltipManager = {
        init: function() {
            var e = $(".tooltip");
            e.on("mouseenter", function() {
                ! function(e) {
                    var t = '<span class="tooltip-content tooltip-shown">' + e.data("tooltip") + "</span>";
                    if (!e.find(".tooltip-content").length) e.append(t);
                    else e.find(".tooltip-content").addClass("tooltip-shown")
                }($(this))
            }), e.on("mouseleave", function() {
                ! function(e) {
                    e.find(".tooltip-content").removeClass("tooltip-shown")
                }($(this))
            })
        }
    },
    InputSelectManager = function() {
        var a = {
            label: ".app-input-label",
            option: "li",
            dropdown: ".app-input-dropdown",
            selectedLabel: ".app-input-select-label",
            noValueLabel: ".app-input-no-value-label",
            input: !1,
            eager: !1
        };

        function i(e, t) {
            this.$el = e.jquery ? e : $(e), (this.$el[0].inputSelect = this).options = $.extend({}, a, t || {}), this.initialized = !1
        }
        return i.prototype = {
            init: function() {
                if (!this.initialized) {
                    var t;
                    if (this.initialized = !0, this.$options = this.$el.find(this.options.option), this.$dropdown = this.$el.find(this.options.dropdown), this.$label = this.$el.find(this.options.label), this.$selectedLabel = this.$el.find(this.options.selectedLabel), this.$noValueLabel = this.$el.find(this.options.noValueLabel), this._attachEvents(), this.$options.each(function() {
                            var e = $(this);
                            if (!bodas.isUndefined(e.data("default"))) t = e
                        }), !this.options.eager) {
                        var e = this.$dropdown.data("name");
                        if (e && !this.$el.find(".app-input-hidden").length) this.$el.append('<input class="app-input-hidden" type="hidden" name="' + e + '">');
                        if (t && 0 < t.length) this.setOption(t)
                    }
                    return this
                }
            },
            _attachEvents: function() {
                var i = this;
                i.$options.filter(function() {
                    return !$(this).hasClass("app-input-select-label")
                }).on("click", function(e) {
                    var t = $(this);
                    if (!t.attr("disabled"))
                        if (bodas.isUndefined(t.data("action"))) {
                            if (t.data("confirm")) {
                                var a = 0 < t.data("confirm").length ? t.data("confirm") : 'Are you sure?';
                                if (!confirm(a)) return void i.$dropdown.hide()
                            }
                            i.update(t)
                        } else i.$dropdown.hide()
                }), i.$el.on("click", function() {
                    i.show()
                })
            },
            show: function() {
                var t = this,
                    e = this.$label.html();
                if (0 < t.$selectedLabel.length) t.$selectedLabel.html(e);
                else t.$el.find("ul").prepend('<li class="subtitle app-input-select-label">' + e + "</li>"), t.$selectedLabel = this.$el.find(t.options.selectedLabel);
                t.$dropdown.closest(".input-group-line-error").removeClass("input-group-line-error").find(".app-message-error").remove(), t.$dropdown.show().scrollTop(0), $(document.body).one("mouseup touchstart", function(e) {
                    t.hide(e)
                })
            },
            hide: function(e) {
                var t = this.$dropdown;
                if (!t.is(e.target) && 0 === t.has(e.target).length) t.fadeOut(100)
            },
            setValue: function(e) {
                var t = this.$options.filter(function() {
                    return $(this).data("value") == e
                });
                return this.setOption(t.first()), this
            },
            setOption: function(e) {
                var t = this,
                    a = e.data("value"),
                    i = $(".app-input-custom"),
                    n = "";
                if (i.length) n = i.find(".app-input-hidden");
                if (!bodas.isUndefined(a))
                    if (n.length && !bodas.isUndefined(e.data("custom"))) n.val(a).trigger("change");
                    else t.$el.find(".app-input-hidden").val(a);
                return t.$label.html(e.html()).addClass("input-filled"), t.$dropdown.fadeOut(100, function() {
                    t.$options.show(), e.hide()
                }), this
            },
            update: function(e) {
                this.setOption(e), this._sendEvent(e.data("value"))
            },
            reset: function() {
                if (this.$noValueLabel.length) {
                    var e = this.$el.find(".app-input-hidden");
                    this.$label.html(this.$noValueLabel.html()), this.$el.find(this.options.option + "[data-default]").removeAttr("data-default"), this.$options.show(), e.val("")
                }
            },
            _sendEvent: function(e) {
                var t = {
                    value: e
                };
                this.$el.trigger("bodas.inputSelect.change", [t])
            },
            triggerChange: function() {
                var e = this.$el.find(".app-input-hidden").val();
                return this._sendEvent(e), this
            }
        }, {
            init: function() {
                var t = [];
                return $(".app-input-select").each(function() {
                    var e = new i(this, {
                        eager: $(this).data("eager") || !1
                    });
                    e.init(), t.push(e)
                }), t
            },
            reset: function(e) {
                e.each(function() {
                    this.inputSelect.reset()
                })
            },
            create: function(e, t) {
                return new i(e, t)
            }
        }
    }();

function common_inputAlert(e) {
    common_inputAlertwithMessage(e, e.data("msgerror"))
}

function common_inputAlertRemoveErrorMessages() {
    $(".app-message-error").remove(), $(".input-group-line-error").removeClass("input-group-line-error")
}

function common_inputAlertwithMessage(e, t, a) {
    if ("redesign" === e.data("redesign")) common_inputAlertwithMessageForAnimated(e, t);
    else common_inputAlertwithMessageOld(e, t, a)
}

function common_inputAlertwithMessageOld(e, t, a) {
    if (null == a) a = !0;
    var i = e.data("name");
    if (e.hasClass("app-input-texto-box-message"))(e = $(".trumbowyg-editor")).parent().addClass("input-group-line");
    var n = e.closest(".input-group-line"),
        o = $(".app-message-error").data("name");
    if (void 0 === i || void 0 === o || o != i) {
        var r;
        if (common_inputAlertRemoveErrorMessages(), 0 < n.length) r = "input-group-label-error dnone", n.addClass("input-group-line-error");
        else r = "input-error-text";
        var s = "<div class='app-message-error " + r + "' data-name='" + i + "' >" + t + "</div>";
        if (0 < n.length) n.append(s), n.find(".app-message-error").slideDown(250);
        else e.after(s);
        if (e.focus(), a) {
            var l = "click keydown";
            if ("date" !== e.attr("type")) l += " change";
            else l += " blur";
            e.one(l, function() {
                $(this).closest(".input-group-line").find(".app-message-error").remove(), $(this).closest(".input-group").find(".app-message-error").remove(), $(this).closest(".filter-panel").find(".app-message-error").remove(), $(".input-group-line-error").removeClass("input-group-line-error")
            })
        }
    }
}

function common_inputAlertwithMessageForAnimated(e, t) {
    var a = e.attr("name"),
        i = e.closest(".textfield, .switchfield, .app-textfield-validate"),
        n = $(".textfield__hint"),
        o = n.data("name");
    if (void 0 === a || void 0 === o || o != a) {
        n.remove(), $(".textfield--error").removeClass("textfield--error"), i.addClass("textfield--error");
        var r = "<div class='textfield__hint' data-name='" + a + "' >" + t + "</div>";
        i.append(r), i.find(".textfield__hint").slideDown(250), e.focus();
        var s = "click keydown";
        if ("date" !== e.attr("type")) {
            if ("enabled" === i.data("trumbowyg")) s += " blur";
            s += " change"
        } else s += " blur";
        e.one(s, function() {
            $(this).nextAll(".textfield__hint").remove(), $(".textfield--error").removeClass("textfield--error")
        })
    }
}

function common_inputFocus() {
    var e = $(".input-group-line input");
    if (0 < e.length) e.on("blur", function() {
        var e = $(this);
        if (e.val()) e.addClass("input-filled");
        else e.removeClass("input-filled")
    })
}

function common_searchGiro(r, e) {
    if (void 0 !== e && null != e) var t = "which" in e ? e.which : e.keyCode;
    $("input[name=idGiro]").val("");
    var s = $(".app-suggest-giro-div-" + $(r).data("suffix") + ":first"),
        l = $(".app-suggest-giro-id-" + $(r).data("suffix") + ":first");
    if (void 0 === e || null == e || void 0 !== e && null != e && 38 != t && 40 != t && 13 != t) $.get("/utils-SearchGiro.php?search=" + encodeURIComponent($(r).val()), function(e) {
        var t, a;
        if (s.removeClass("loading").html("").show(), e = e.split("\n"), navigationPos = 0, maxNavigationPos = e.length, 1 < e.length) {
            t = $();
            for (var i = 0; i < e.length - 1; i++) {
                var n = e[i].split("||"),
                    o = "<span class='mr5'></span> <span class='suggest-navigation-content'>" + n[1] + "</span>";
                a = $("<li />").attr("data-id-giro", n[0]).attr("data-name-giro", n[1]).addClass("suggest-navigation").addClass("suggest-item-navigation-" + (i + 1)).html(o).on("click", function() {
                    if (s.html("").hide(), $(r).val(decodeURIComponent($(this).data("name-giro"))), l.val($(this).data("id-giro")).change(), $(r).attr("tabindex")) $("*[tabindex=" + (parseInt($(r).attr("tabindex")) + 1) + "]").focus()
                }), t = t.add(a)
            }
            s.append($("<div/>").addClass("column-container").append($("<ul />").addClass("box-scroll").append(t))), boxscroll = s.find(".box-scroll").jScrollPane(), api = boxscroll.data("jsp")
        } else if (!$(r).val()) s.append($("<div />").addClass("suggest-message-start-writing").html('Write the name of the activity and select it from the list.'));
        else s.append($("<div />").addClass("suggest-message-no-results").html('No matches have been found'))
    });
    if (void 0 !== e) {
        if (38 == t)
            if (0 < navigationPos) navigationPos--;
        if (40 == t)
            if (navigationPos < maxNavigationPos) navigationPos++;
        if (13 == t) {
            e.preventDefault();
            var a = s.find(".suggest-item-navigation-" + navigationPos);
            if (0 < a.length) return a.trigger("click"), !1;
            else return !1
        }
        s.find(".suggest-navigation").removeClass("bg"), s.find(".suggest-item-navigation-" + navigationPos).addClass("bg");
        var i = s.find(".suggest-item-navigation-" + navigationPos);
        if (api && 0 < navigationPos && navigationPos < maxNavigationPos)
            if (navigationPos == maxNavigationPos - 1) api.scrollToElement(i, !0);
            else api.scrollToElement(i)
    }
}

function vendors_showCamposNovios(e, t, a) {
    var i, n, o;
    if (a) i = a.find("#divRol", t), n = a.find(".app-capa-rol-select", t), o = a.find("#divProvinciaBoda", t);
    else i = $("#divRol", t), n = $(".app-capa-rol-select", t), o = $("#divProvinciaBoda", t);
    if (i.show(), n.hide(), o.hide(), 1 == e || 2 == e || 8 == e) o.show();
    else if (e) n.show(), o.hide()
}

function users_verificaLayerEmptyData(e) {
    var t = e.find("input[name='action']"),
        a = e.find(".app-gender");
    if (t.val() == LAYER_ACTIONS.emptyBride && (!a.val() || a.val() != a.data("role-bride") && a.val() != a.data("role-groom") && a.val() != a.data("role-other"))) return common_inputAlert(a), !1;
    var i = e.find("select[name='Pais']");
    if (!i.val() || -1 == i.val()) return common_inputAlert($(".app-msgerror1")), i.one("change", function() {
        common_inputAlertRemoveErrorMessages()
    }), !1;
    var n = e.find("input[name='Poblacion']");
    if (-1 == n.val() || "" == n.val() || 0 == Number(n.val())) return common_inputAlert(n), !1;
    var o = $(".app-datepicker-wd-layer");
    if ("" == o.val()) return common_inputAlert(o), !1;
    else return !0
}

function loadWedUserDataLayer() {
    var e = $(".app-tools-main-layers");
    if (0 < e.length && !$('[class^="modal-layer"]').length && !e.data("already-loaded")) {
        var t = e.data("id-action");
        e.data("already-loaded", !0), common_openLayer("/com-LayerDataUserTools.php?action=" + t)
    }
}

function common_socialTrack(e, t) {
    ga_trackEventAll("Social", t, e, 0, 0)
}

function common_getUserNumPendingMessages(t, e) {
    if (void 0 !== e) users_updateBadge(t, e);
    else $.ajax({
        url: "/utils-HeaderUnreadedMessagesAjax.php",
        type: "GET",
        cache: !1,
        success: function(e) {
            if (0 < e.numUnread)
                if (0 < t.length) users_updateBadge(t, e.numUnread)
        }
    })
}

function users_updateBadge(e, t) {
    if (0 < e.find(".badge").length) {
        if (void 0 !== t) a = t;
        else {
            if (0 < e.find(".badge-notice").length) i = parseInt(e.find(".badge-notice").html());
            else i = parseInt(e.find(".badge").html());
            if (isNaN(i)) i = 0;
            a = parseInt(i + 1)
        }
        if (0 != a) e.find(".badge").html(a).show();
        else e.find(".badge").html("").hide()
    } else if (e.hasClass("header-joined-inbox")) {
        var a;
        if (void 0 !== t) a = t;
        else {
            var i;
            if (0 < e.find(".app-header-inbox-counter").length) i = parseInt(e.find(".app-header-inbox-counter").html());
            else i = parseInt(e.html());
            if (isNaN(i)) i = 0;
            a = parseInt(i + 1)
        }
        if (0 != a) {
            if (0 < e.find(".app-header-inbox-counter").length) e.find(".app-header-inbox-counter").addClass("counter").html(a).show()
        } else e.find(".app-header-inbox-counter").html("").hide()
    } else if (void 0 !== t) {
        if (0 != t) $("<a class='badge' href='https://" + globals.subdomain + "/com-Buzon.php'>" + t + "</a>").insertBefore(e.find("a"))
    } else $("<a class='badge' href='https://" + globals.subdomain + "/com-Buzon.php'>1</a>").insertBefore(e.find("a"))
}
var stickyAside = function(e, n, o) {
        function t() {
            var e = n.clientHeight + r;
            if (window.innerHeight - 5 > e) {
                if (s != n.offsetTop) n.style.position = null, n.style.top = null, n.style.bottom = null, s = n.offsetTop;
                var t = o.offsetHeight + o.offsetTop - window.scrollY,
                    a = window.scrollY >= s - r,
                    i = t <= e;
                if (n.style.cssText = "width:" + n.clientWidth + "px;position:inherit;", a) n.style.position = "fixed", n.style.top = r + "px", n.style.bottom = null;
                if (i) n.style.position = "fixed", n.style.top = null, n.style.bottom = window.innerHeight - t + "px";
                if (!a && !i) n.style.position = null, n.style.top = null, n.style.bottom = null
            } else n.style.position = null, n.style.top = null, n.style.bottom = null
        }
        var r = parseInt(e, 10) || 40,
            s = n.offsetTop;
        t(), window.addEventListener("scroll", t, !1), window.addEventListener("resize", t, !1), o.addEventListener("resize", t, !1)
    },
    navManager = function() {
        var i = ".app-common-header-container",
            s = ".app-common-header-dropdown",
            l = ".app-header-backdrop",
            c = ".app-header-tab",
            n = "hovered",
            o = {
                load: function(e) {
                    var t = $(s),
                        a = e.data("tab"),
                        i = (GetCookie("USER_ID") || "").slice(-2);
                    $.get("/utils-Tabs.php", {
                        tab: a,
                        version: globals.Request_SiteVersion,
                        logged: i
                    }).done(function(e) {
                        t.html(e)
                    }), o.show(e)
                },
                show: function(e) {
                    var t = $(l),
                        a = $(s),
                        i = $(c),
                        n = $(".app-dropdown-toggle-layer"),
                        o = $("#app-logged-box");
                    d(n);
                    var r = n.data("isVisible");
                    if (r) n.data("isVisible", common_dropdown_toggle(n, r));
                    d(o), t.show(), a.show(), i.removeClass("active"), e.addClass("active")
                },
                hide: function() {
                    var e = $(l),
                        t = $(s),
                        a = $(c);
                    e.fadeOut(100), t.fadeOut(100), a.removeClass("active")
                }
            };

        function d(e) {
            if (0 < e.length && e.is(":visible")) e.hide()
        }

        function r() {
            $(".app-menu").find("." + n).removeClass(n)
        }
        return {
            init: function() {
                if (common_isTouchDevice()) $(document.body).on("click", c, function(e) {
                    var t = $(this);
                    ! function(e, t, a) {
                        if ($(a).not(e).removeClass(n), !e.hasClass(n)) t.preventDefault(), e.addClass(n)
                    }(t, e, c), o.load(t), $(document.body).one("click", l, function() {
                        r(), o.hide()
                    }), $(window).on("scroll", function() {
                        r(), o.hide()
                    })
                });
                else {
                    var a;
                    $(document.body).on("mouseenter", c, function(e) {
                        var t = $(this);
                        if (null !== e.relatedTarget) {
                            if (!$(e.relatedTarget).is($(s)) && !$(e.relatedTarget).is($(i)) && 0 == $(e.relatedTarget).closest(i).length) a = setTimeout(function() {
                                o.load(t)
                            }, 300);
                            else o.load(t);
                            $(document.body).one("mouseleave", s, function(e) {
                                if (!$(e.relatedTarget).is($(c)) && 0 === $(e.relatedTarget).has(c).length) o.hide()
                            }), $(document.body).one("mouseleave", i, function(e) {
                                if (!$(e.relatedTarget).is($(s)) && !$(e.relatedTarget).is($(i)) && 0 == $(e.relatedTarget).closest(i).length) o.hide()
                            }), $(window).one("scroll", function() {
                                o.hide()
                            }), $(document.body).one("mouseleave", c, function(e) {
                                clearTimeout(a)
                            })
                        }
                    })
                }
            }
        }
    }();

function ajaxLoginHeaderUpdate() {
    return $.ajax({
        url: "/users-login-header-update.php"
    }).then(function(e) {
        if (e) return $(".menu-top-access").remove(), $(".header-join").replaceWith(e), e
    })
}

function tools_run_countdown(e, t) {
    var a = $("#defaultCountdown");
    a.countdown("destroy");
    var i = "";
    if (t) i += "<span><small>" + 'days' + "</small>{d<}{dn}{d>}</span>";
    i += "<span><small>" + 'hours' + "</small>{h<}{hn}{h>}</span><span><small>" + 'min.' + "</small>{m<}{mn}{m>}</span><span><small>" + 'sec.' + "</small>{s<}{sn}{s>}</span>", a.countdown({
        until: e,
        timezone: globals.timezone,
        layout: i
    })
}
var AnimatedTextfield = function() {
    var i = [];

    function n(e) {
        if (this.input = e, this.root = e.parentNode, this.focused = "textfield--focused", this.focusedLabel = "textfield__label--float-above", this.autofocus = "textfield--autofocus", this.label = this.root.querySelectorAll(".textfield__label")[0] || null, this.hint = this.root.querySelectorAll(".textfield__hint")[0] || null, !e.animatedTextField) this.bindFocusIn(), this.bindFocusOut();
        e.animatedTextField = this
    }
    n.prototype.init = function() {
        if (!$(this.label).hasClass(this.focusedLabel)) this.toggleLabel();
        if ($(this.root).hasClass(this.autofocus)) this.input.focus(), this.upLabel()
    }, n.prototype.bindFocusIn = function() {
        var e = this;
        this.input.addEventListener("focus", function() {
            e.upLabel()
        })
    }, n.prototype.bindFocusOut = function() {
        var e, t = this;
        if (this.root.classList.contains("app-common-datepicker")) e = "hide";
        else e = "blur";
        $(this.input).on(e, function() {
            t.toggleLabel()
        })
    }, n.prototype.toggleLabel = function() {
        if (!this.input.value) this.downLabel();
        else this.upLabel()
    }, n.prototype.upLabel = function() {
        if (this.root.classList.add(this.focused), null != this.label) this.label.classList.add(this.focusedLabel);
        if (null != this.hint) this.hint.style.display = "none"
    }, n.prototype.downLabel = function() {
        if (this.root.classList.remove(this.focused), null != this.label) this.label.classList.remove(this.focusedLabel);
        if (null != this.hint) this.hint.style.display = "block"
    };
    return {
        init: function() {
            i = [];
            for (var e = document.getElementsByClassName("textfield__input"), t = e.length - 1; 0 <= t; t--) {
                var a = new n(e[t]);
                a.init(), i.push(a)
            }
        }
    }
}();

function BFP() {
    var bannerPromises = [],
        bannerPromise, rv, sv, tv, uv, wv, xv, yv, zv;
    if (0 < $(".app-DFP").length) bannerPromise = function() {
        var banner = $(".app-DFP"),
            numSlots = banner.length,
            idRegion = banner.first().data("idregion"),
            idRegionAdm1 = banner.first().data("idregionadm1"),
            idGrupo = banner.first().data("idgrupo"),
            idSubSeccion = banner.first().data("idsubseccion"),
            autopromo = banner.first().data("autopromo");
        return $.ajax({
            url: "/banners/banner-Show.php?numSlots=" + numSlots + "&reduced=" + reduced + "&idRegion=" + idRegion + "&idGrupo=" + idGrupo + "&idSubSeccion=" + idSubSeccion + "&idRegionAdm1=" + idRegionAdm1 + "&autopromo=" + autopromo
        }).done(function(data) {
            var i = 0;
            return $(".app-DFP").each(function() {
                $(this).html(eval("data.banner" + i)), i += 1
            }), data
        })
    }(), bannerPromises.push(bannerPromise);
    if (0 < $(".app-DFP-875").length) rv = $(".app-DFP-875"), sv = rv.data("idregion"), tv = rv.data("idgrupo"), uv = rv.data("idsubseccion"), bannerPromise = $.ajax({
        url: "/banners/banner-Show875x90.php?reduced=" + reduced + "&idRegion=" + sv + "&idGrupo=" + tv + "&idSubSeccion=" + uv
    }).done(function(e) {
        if (e.banner) $(".app-DFP-875").html(e.banner);
        else $(".app-DFP-875").hide();
        return e
    }), bannerPromises.push(bannerPromise);
    if (0 < $(".app-DFP-html").length) bannerPromise = function() {
        var banner = $(".app-DFP-html"),
            numSlots = banner.length,
            idRegion = banner.first().data("idregion"),
            idRegionAdm1 = banner.first().data("idregionadm1"),
            idGrupo = banner.first().data("idgrupo"),
            idSubSeccion = banner.first().data("idsubseccion"),
            autopromo = banner.first().data("autopromo");
        return $.ajax({
            url: "https://" + globals.subdomain + "/banners/banner-ShowHtml.php?numSlots=" + numSlots + "&reduced=" + reduced + "&idRegion=" + idRegion + "&idGrupo=" + idGrupo + "&idSubSeccion=" + idSubSeccion + "&idRegionAdm1=" + idRegionAdm1 + "&autopromo=" + autopromo
        }).done(function(data) {
            var i = 0;
            return $(".app-DFP-html").each(function() {
                $(this).html(eval("data.banner" + i)), i += 1
            }), data
        })
    }(), bannerPromises.push(bannerPromise);
    if (0 < $(".app-DFP-70").length) wv = $(".app-DFP-70"), xv = wv.data("idregion"), yv = wv.data("idgrupo"), zv = wv.data("idsubseccion"), bannerPromise = $.ajax({
        url: "https://" + globals.subdomain + "/banners/banner-Show300x70.php?reduced=" + reduced + "&idRegion=" + xv + "&idGrupo=" + yv + "&idSubSeccion=" + zv
    }).done(function(e) {
        return $(".app-DFP-70").html(e.banner), e
    }), bannerPromises.push(bannerPromise);
    if (bannerPromises.length) $.when.apply($, bannerPromises).then(function() {
        var e = BannerPenalizer.extractIdsFromPromise(arguments),
            t = BannerPenalizer.get();
        BannerPenalizer.update(t, e)
    })
}

function SliderInput(e) {
    this.options = $.extend({}, {
        name: "vendorSlider",
        element: ".app-input-range",
        elementBarStart: ".app-input-range-bar-start",
        elementBarEnd: ".app-input-range-bar-end",
        elementHandle: ".app-input-range-bar-end",
        elementSteps: ".app-input-range-step",
        inputHidden: ".app-input-range-hidden",
        percentagesSteps: [10, 25, 50, 75, 100],
        valuesSteps: [10, 25, 50, 75, 0]
    }, e), this.name = this.options.name, this.activeSlider = !1, this.points = [], this.value = +$(this.options.inputHidden).val(), this.handleValue = this.value;
    var r = this;
    $(this.options.elementSteps).each(function() {
        r.points.push(this.getBoundingClientRect().left + window.scrollX)
    }), $(this.options.element).on("mousedown." + this.name, function(e) {
        var t = !1;
        if ("buttons" in e) t = 1 === e.buttons;
        else if ("which" in e) t = 1 === e.which;
        else t = 1 === e.button;
        if (t) r.activeSlider = !0
    }), $(window).unbind("mousemove." + this.name), $(window).unbind("mousedown." + this.name), $(window).unbind("mouseup." + this.name), $(window).on("mousemove." + this.name + " mousedown." + this.name, function(e) {
        if (r.activeSlider) {
            var t = 9e9,
                a = 0;
            for (var i in r.points) {
                var n = Math.abs(r.points[i] - e.pageX);
                if (n < t) a = i, t = n
            }
            var o = r.options.percentagesSteps[a];
            $(r.options.elementBarStart).css("right", 100 - o + "%"), $(r.options.elementBarEnd).css("left", o + "%"), r.handleValue = r.options.valuesSteps[a]
        }
    }), $(window).on("mouseup." + this.name, function() {
        if (r.activeSlider) {
            if (r.activeSlider = !1, r.handleValue != r.value) $(r.options.inputHidden)[0].value = +r.handleValue, r.value = r.handleValue;
            vendors_triggerFilter(this, !0)
        }
    })
}

function limitStringLength(e, t, a) {
    if (a = a || "", e.length > t) e = e.substring(0, t - a.length) + a;
    return e
}

function escapeRegexSpecialChars(e) {
    return e.replace(/([-\[\]{}()*+?.,\\^$|#])/g, "\\$1")
}

function countSubstringMatches(e, t) {
    e = escapeRegexSpecialChars(e);
    var a = new RegExp(e, "g");
    return (t.match(a) || []).length
}

function vendors_showFormContactarEmp(e, t, a, i, n, o) {
    if (void 0 === i) i = null;
    vendors_showCapaFormularioSolic(e, t, null, !1, i, n, o, a)
}

function vendors_showCapaFormularioSolic(e, t, a, i, n, o, r, s, l) {
    var c;
    try {
        internalTrackingService.setLeadNextFormData(e, !0)
    } catch (e) {
        console.error("NITS Error: Not loaded.")
    }
    if (null === a) a = GetCookie("ie");
    if (null == r) r = "/landings/form.php?id_empresa=" + t + "&isCapaSolicitud=1";
    if (null !== a) r += "&idEscaparate=" + a;
    if (!0 === s) r += "&isTestAB=1";
    if (i) r += "&isLanding=1";
    if (l) r += "&idPromocion=" + l;
    if (null !== o) r += "&frmInsert=" + o;
    if (null !== n) setZOrigen(n);
    if (0 === $("#fMultisolicitud").length) common_crearIframe("fMultisolicitud");
    if (void 0 !== document.forms.frmContacto)(c = document.forms.frmContacto).name = "frmContacto2";
    else c = null;
    return $.get(r, function(e) {
        var t = $("#app-common-layer");
        if (t.html(e), t.modal({
                backdrop: "static"
            }), AnimatedTextfield.init(), vendors_setCookiesLeadForm(t.find("form")[0]), 0 < $("#divVenueSaved").length) vendors_usuarioRegistradoAndVenue(t.find("input[name=Mail]")[0]);
        if (common_isChromeIpad()) $(".modal, .modal-backdrop").css("height", $(window).height())
    }), $(".modal").on("hidden.bs.modal", function() {
        if (null !== c) c.name = "frmContacto";
        $(".modal").unbind("hidden.bs.modal")
    }), !1
}

function vendors_usuarioRegistradoAndVenue(e) {
    if (vendors_usuarioRegistrado(e), 0 != $("#divVenueSaved").length) {
        var t = $(e).closest("form");
        if ("" == e.value || cookies_verificaVenueSaved(e, "")) $("#divVenueSaved", t).hide();
        else $("#divVenueSaved", t).show()
    }
}

function vendors_usuarioRegistrado(e) {
    var t = $(e).closest("form"),
        a = $('input[name="Rol"]:checked', t).val();
    if (!a) a = $('input[name="Rol"]', t).val();
    if (common_verificaUserDup(e, "") && "" !== e.value) $("input[name=SolicNewMail]", t).val(1), $(t).find(".app-wrapper-legal-terms").removeClass("dnone"), vendors_showCamposNovios(a, t);
    else $("input[name=SolicNewMail]", t).val(0), $(t).find(".app-wrapper-legal-terms").addClass("dnone"), vendors_resetCamposNovios(t)
}

function vendors_setCookiesLeadForm(e) {
    var t = !1;
    if ("" == e.Nombre.value)
        if (null != bodas.getCookieURIdecoded("pb_name")) t = !0, e.Nombre.value = bodas.getCookieURIdecoded("pb_name"), upLabelIfNecessary(e, e.Nombre);
    if ("" == e.Mail.value)
        if (null != bodas.getCookieURIdecoded("pb_mail")) e.Mail.value = bodas.getCookieURIdecoded("pb_mail"), $(e.Mail).trigger("change"), upLabelIfNecessary(e, e.Mail);
    if ("" == e.Telefono.value)
        if (null != bodas.getCookieURIdecoded("pb_telefono")) e.Telefono.value = bodas.getCookieURIdecoded("pb_telefono"), upLabelIfNecessary(e, e.Telefono);
    if (void 0 !== e.Fecha) {
        var a = e.Fecha;
        if ("" == a.value)
            if (null != bodas.getCookieURIdecoded("pb_fecha")) a.value = bodas.getCookieURIdecoded("pb_fecha"), upLabelIfNecessary(e, a)
    }
    if (void 0 !== e.Comensales) {
        var i = e.Comensales;
        if ("" == i.value)
            if (null != bodas.getCookieURIdecoded("pb_comensales")) i.value = bodas.getCookieURIdecoded("pb_comensales"), upLabelIfNecessary(e, i)
    }
    if (t && !e.dataset.disableAutoFocus) upLabelIfNecessary(e, e.Comentario), e.Comentario.focus()
}

function vendors_resetCamposNovios(e) {
    $(".app-capa-rol", e).removeClass("current"), $('input[name="Rol"]', e).removeAttr("checked"), $("#divRol", e).hide(), $("#divProvinciaBoda", e).hide(), $(".app-capa-rol-select", e).hide()
}

function vendors_sendSolic(e, t, a) {
    if (void 0 !== a) setZOrigen(a);
    e.tipo.value = t
}

function vendors_verificaContacto(e, t) {
    var a = !1,
        i = !!$(".app-lead-form-animated").length,
        n = {
            name: 'Enter your full name.',
            phone: 'Enter a valid phone number so that businesses can contact you. Remember to include the area code.',
            phoneVendor: 'Please enter a phone number for vendors to contact you.',
            weddingDate: 'Approximate date of the event.',
            guestNumber: 'Enter the approximate number of guests.',
            role: 'Let us know your role in the wedding',
            message: 'Your comment must contain a minimum of ten characters',
            province: 'Tell us your location',
            legal: 'You must accept the Terms of Use and privacy policy.'
        },
        o = common_inputAlertwithMessage,
        r = 5;
    if (i) $.extend(n, {
        phone: 'Please enter a valid phone number',
        phoneVendor: 'Please enter a valid phone number',
        weddingDate: 'Event date',
        guestNumber: 'Estimated guest count',
        message: 'Minimum 10 characters'
    }), o = common_inputAlertwithMessageForAnimated, r = 3;
    if (void 0 !== t && 1 == t) {
        a = !0, (t = $("#error")).hide()
    }
    var s = internalTrackingService || {};
    if (e.Nombre.value.trim().length < r) {
        if (a) t.common_hideShow(function() {
            $("#msgError").html(s.nextError = n.name)
        });
        else o($(e).find("input[name=Nombre]"), s.nextError = n.name);
        return e.Nombre.focus(), !1
    }
    if (!common_validateMailField(e.Mail, !0, !0, o)) return !1;
    if ("13" == globals.Request_id_project) {
        if (e.Telefono.value.trim().length < 10) {
            if (a) t.common_hideShow(function() {
                $("#msgError").html(s.nextError = n.phone)
            });
            else o($(e).find("input[name=Telefono]"), s.nextError = n.phone);
            return e.Telefono.focus(), !1
        }
    } else if (e.Telefono.value.trim().length < 6 && (void 0 === e.preferredContact || 2 == e.preferredContact.value)) {
        if (a) t.common_hideShow(function() {
            $("#msgError").html(s.nextError = n.phoneVendor)
        });
        else o($(e).find("[name=Telefono]"), s.nextError = n.phoneVendor);
        return e.Telefono.focus(), !1
    }

    function l() {
        if (e.Fecha.value.length < 1) {
            if (a) t.common_hideShow(function() {
                $("#msgError").html(s.nextError = n.weddingDate)
            });
            else o($(e).find("[name=Fecha]"), s.nextError = n.weddingDate);
            return e.Fecha.focus(), !1
        }
        if (void 0 !== e.Comensales)
            if ($(e).find("[name=Comensales]").is(":visible") && e.Comensales.value.trim().length < 1) {
                if (a) t.common_hideShow(function() {
                    $("#msgError").html(s.nextError = n.guestNumber)
                });
                else o($(e).find("[name=Comensales]"), s.nextError = n.guestNumber);
                return e.Comensales.focus(), !1
            }
        return !0
    }

    function c() {
        if (0 < $("#divRol", e).length && $("#divRol", e).is(":visible"))
            if ($("select[name='Rol']", e).length) {
                if ($("select[name='Rol']", e).val() < 1) {
                    if (a) t.common_hideShow(function() {
                        $("#msgError").html(s.nextError = n.role)
                    });
                    else o($(e).find("[name=Rol]"), s.nextError = n.role);
                    return e.Rol[0].focus(), !1
                }
            } else if ("radio" == $("input[name='Rol']", e).attr("type")) {
            if (!$("input[name='Rol']", e).is(":checked")) {
                if (a) t.common_hideShow(function() {
                    $("#msgError").html(s.nextError = n.role)
                });
                else o($(e).find("[name=Rol]"), s.nextError = n.role);
                return e.Rol[0].focus(), !1
            }
        } else if ("hidden" == $("input[name='Rol']", e).attr("type"))
            if ($("input[name='Rol']", e).val() < 1) {
                if (a) t.common_hideShow(function() {
                    $("#msgError").html(s.nextError = n.role)
                });
                else o($(e).find("[name=Rol]"), s.nextError = n.role);
                return !1
            }
        return !0
    }
    if (i) {
        if (!c()) return !1;
        if (!l()) return !1
    } else {
        if (!l()) return !1;
        if (!c()) return !1
    }
    if (e.Comentario.value.trim().length < 10) {
        if (a) t.common_hideShow(function() {
            $("#msgError").html(s.nextError = n.message)
        });
        else o($(e).find("[name=Comentario]"), s.nextError = n.message);
        return e.Comentario.focus(), !1
    }
    if (0 < $("#campo-rol-en-landing-mobile").length && $("#campo-rol-en-landing-mobile").val() < 1) {
        if (a) t.common_hideShow(function() {
            $("#msgError").html(s.nextError = n.role)
        });
        else o($(e).find("[name=Rol]"), s.nextError = n.role);
        return !1
    }
    if (0 < $("#campo-provincia-en-landing-mobile").length && $("#campo-provincia-en-landing-mobile").val() < 1) {
        if (a) t.common_hideShow(function() {
            $("#msgError").html(s.nextError = n.province)
        });
        else o($(e).find("[name=idProvincia]"), s.nextError = n.role);
        return !1
    }
    var d = $(e).find($(".app-check-legal-terms")),
        p = d.closest($(".app-wrapper-legal-terms")),
        u = $(".modal-fullscreen-form");
    if (0 != d.length && !d.prop("checked") && !p.hasClass("dnone")) {
        if (a) t.common_hideShow(function() {
            $("#msgError").html(s.nextError = n.legal)
        });
        else {
            var m = $(e).find(".app-check-legal-terms-msg");
            if (m.html(n.legal).slideDown(), 0 < u.length) $(u).animate({
                scrollTop: $(m).offset().top
            }, 2e3);
            d.on("ifChanged", function() {
                if ($(this).prop("checked")) m.slideUp()
            })
        }
        return !1
    }
    if ($("#divVenueSaved").is(":hidden")) $("input[name=suProvider_id]").attr("disabled", "disabled");
    return bodas.setAnalyticsEventForServer(e), bodas.leadTrackingExceptionManager.init(e), bodas.leadTrackingExceptionManager.addFormParams(), !0
}

function copyToClipboard(e) {
    var t = document.createElement("span");
    t.textContent = e, document.body.appendChild(t);
    var a = document.getSelection(),
        i = document.createRange();
    i.selectNode(t), a.removeAllRanges(), a.addRange(i), document.execCommand("copy"), document.body.removeChild(t)
}

function vendors_continuarEnvio() {
    document.frmMultisolic.continuar.value = 1, document.frmMultisolic.submit()
}

function upLabelIfNecessary(e, t) {
    if (!!$(".app-lead-form-animated").length) t.animatedTextField.upLabel()
}

function template_simple_login(e, t) {
    return '<div class="text-center border p20"><div class="layout-auth-avatar">' + t + '</div><p class="strong">' + e + "</p></div>"
}

function desktop_showPushNotification(e, t) {
    $(e).html(t).fadeIn(400), setTimeout(function() {
        $(e).fadeOut("fast")
    }, 5e3)
}
var RoleSwitcherSelector = function() {
        var i = {
            form: "",
            switcherClass: "app-switcher-role-selector",
            othersWrapper: "app-switcher-role-selector-others-wp",
            othersSelector: "app-switcher-role-selector-others",
            roleInput: "input[name=Rol]"
        };
        return {
            init: function(e) {
                var t = $.extend({}, i, e),
                    a = $("." + t.form);
                if (a.length) $("." + t.switcherClass).on("click", function() {
                    var e = $(this);
                    if (a.find("." + t.switcherClass).removeClass("active"), e.addClass("active"), "others" === e.data("role")) a.find("." + t.othersWrapper).show(), a.find(t.roleInput).val(a.find("." + t.othersSelector).val()).change();
                    else a.find("." + t.othersWrapper).hide(), a.find(t.roleInput).val(e.data("role")).change()
                }), $("." + t.othersSelector).on("change", function() {
                    a.find(t.roleInput).val($(this).val())
                })
            }
        }
    }(),
    layersSuggest = {},
    numKeys = 0,
    urlSource, blurEnable = !0;

function common_init_currency_value(e) {
    var t = null;
    if (null != e) t = $(e);
    else t = $(document.body);
    var a = t.find(".app-currency-value");
    if (a.length) {
        if (void 0 === a.autoNumeric) return;
        var i = globals.separators.thousand,
            n = {
                digitGroupSeparator: i,
                decimalCharacter: globals.separators.decimal,
                decimalCharacterAlternative: i,
                maximumValue: "999999999",
                allowDecimalPadding: !1
            };
        if (15 === parseInt(globals.Request_id_project)) n.digitalGroupSpacing = 2;
        a.autoNumeric(n)
    }
}! function(f) {
    f.fn.suggest = function(n) {
        for (var a, o, i, r, e = "layer-suggest-1", t = 1, s = {}, l = f(this), c = 0, d = 0; f("#" + e).length || e in layersSuggest;) e = "layer-suggest-" + ++t;
        t = 1;
        var p = {
            layer: layersSuggest[e] = e,
            dataType: "html",
            emptySearch: !1,
            allowNavigation: !1,
            msg: {
                noResults: ""
            },
            success: function(e) {},
            onFocus: function(e) {},
            keyMove: function(e, t) {},
            keySelect: function(e) {}
        };
        n = f.extend({}, p, n);
        var u = f("#" + n.layer);
        f(this).attr("autocomplete", "off"), f(this).on("focus keyup", function(e) {
            var t;
            if (++numKeys != numKeys || 38 == (e.keyCode || e.which) || 40 == (e.keyCode || e.which) || 13 == (e.keyCode || e.which) || 32 == (e.keyCode || e.which)) return !1;
            if (-1 == (urlSource = n.source).indexOf("?")) urlSource += "?dataType=" + n.dataType;
            else urlSource += "&dataType=" + n.dataType;
            if (n.onFocus.call(this, urlSource), urlSource += "&term=" + encodeURIComponent(l.val()), a = l.offset(), o = l.val(), 0 === l.val().trim().length && !n.emptySearch) return f(".layer-suggest").css("display", "none"), !1;
            if (!u.length) {
                if (!f(".app-search-right").length) f(document.body).append("<div class='SelectorOptions droplayer droplayer-extralarge' id='" + n.layer + "' style='position:absolute; top:" + (parseInt(a.top + l.outerHeight()) + 11) + "px; left:" + a.left + "px;'></div>");
                else f(document.body).append("<div class='SelectorOptions droplayer droplayer-extralarge droplayer-right' id='" + n.layer + "' style='position:absolute; top:" + (parseInt(a.top + l.outerHeight()) + 11) + "px; left:inherit; right:" + (parseInt(f(window).width()) - a.left - parseInt(l.outerWidth())) + "px;'></div>");
                u = f("#" + n.layer)
            } else u.css("display", "block");
            if ("" !== o && o in s) i = s[o], m(i);
            else t = o, f.ajax({
                url: urlSource,
                success: function(e) {
                    if (s[t] = e, t == o) m(i = e)
                }
            })
        }), f(this).on("blur", function() {
            if (blurEnable) u.fadeOut(100), c = 0
        }), f(this).on("keydown", function(e) {
            var t = e.keyCode || e.which;
            if (38 == t || 40 == t || 13 == t) {
                if (!n.allowNavigation) return !1;
                if (38 == t)
                    if (1 < c) c--;
                if (40 == t)
                    if (c < d) c++;
                if (13 == t) {
                    var a = u.find(".suggest-item-navigation-" + c);
                    if (0 < a.length) return n.keySelect(a), f(this).trigger("blur"), !1;
                    else return !0
                }
                if (u.find(".suggest-navigation").removeClass("bg"), u.find(".suggest-item-navigation-" + c).addClass("bg"), n.keyMove(u.find(".suggest-item-navigation-" + c), e), 0 < c && c < d) {
                    var i = u.find(".suggest-item-navigation-" + c);
                    if (boxscroll = u.find(".box-scroll").jScrollPane(), api = boxscroll.data("jsp"), c == d - 1) api.scrollToElement(i, !0);
                    else api.scrollToElement(i)
                }
            }
        });
        var m = function(e) {
            if (r = "", "1" == e)
                if ("" !== n.msg.noResults) r = "<p class='gris'>" + n.msg.noResults + "</p>";
                else r = "";
            else if ("json" == n.dataType) {
                var t = JSON.parse(e),
                    a = t.length;
                r = "<ul>";
                for (var i = 0; i < a; i++) r += "<li>" + t[i].label + "</li>";
                r += "</ul>"
            } else r = e;
            if ("" !== r) {
                if (u.html(r), n.success(o, u), n.allowNavigation && 1 == u.find("ul").length) u.find("li").each(function(e) {
                    f(this).addClass("suggest-navigation suggest-item-navigation-" + parseInt(e + 1)), c = 0, d = parseInt(e + 1)
                })
            } else u.hide()
        }
    }
}(jQuery), $(document).ready(function() {
    if (function() {
            if (0 != window.desktopInMobile && 1 == globals.isDynamicServing) $.ajaxSetup({
                headers: {
                    "X-Force-Desktop": 1
                }
            })
        }(), navManager.init(), AnimatedTextfield.init(), common_applyIcheck(), $(document.body).hasClass("app-has-ajax-manager")) common_ajaxManager_load();
    if ($(document.body).hasClass("app-has-tiny-common")) common_tiny_init({});
    var t, a, i;
    if ((t = jQuery).fn.goTo = function(e) {
            return e |= 0, t("html, body").animate({
                scrollTop: t(this).offset().top + e + "px"
            }, 500, "swing"), this
        }, $("#app-common-layer, #tool-modal").bind("hidden.bs.modal", function() {
            $(document.body).css("margin-right", "0px")
        }), $("#app-common-layer, #tool-modal").bind("show.bs.modal", function() {
            $(document.body).css("margin-right", "15px")
        }), $(document.body).on("hidden.bs.modal", ".modal", function() {
            $(this).removeData("bs.modal"), $(this).html("")
        }), $(document.body).on("click", ".app-succes-box-close", function() {
            $(this).closest(".app-success-box").addClass("dnone")
        }), $(document.body).on("click", ".app-common-datepicker", function() {
            var t = $(this),
                e = $(this).find("input")[0];
            if (!!$(".app-lead-form-animated").length) e.animatedTextField.upLabel();
            t.find("input:first").datepicker("show").on("changeDate", function(e) {
                if ("days" == e.viewMode) {
                    if (t.find("input:first").attr("tabindex")) $("*[tabindex=" + (parseInt(t.find("input:first").attr("tabindex")) + 1) + "]").focus();
                    $(this).datepicker("hide"), $(this).trigger("change")
                }
            })
        }), $(".app-tools-perfil-boda-layer", "#misTags").on("click", function() {
            var e, t = $(this).parent().data("grupo"),
                a = $(this).data("id"),
                i = $("span", $(this)).attr("class"),
                n = $("small", $(this)).html();
            if (1 === t) e = "color";
            else if (3 === t) e = "temporada";
            else if (2 === t) e = "estilo";
            var o = $("#misTags").data("url-base-buscador") + "?" + e + "=" + a;
            $("i[data-grupo=" + t + "]", "#misTags").removeClass().addClass(i).addClass("app-perfil-show").parent().removeClass("profile-aboutwedding-icon-miss"), $("span[data-grupo=" + t + "]", "#misTags").html(n), $("#weddingName" + t).html(n), $.post("/com-PerfilCambiarTag.php", {
                grupo: $(this).parent().data("grupo"),
                id: $(this).data("id")
            });
            var r = {
                idTag: a,
                tagName: e,
                url: o
            };
            $.ajax({
                url: "/tools/PerfilCambiarTag",
                data: r,
                success: function(e) {
                    e = e.replace(/color/g, "colour").replace(/temporada/g, "season").replace(/estilo/g, "style"), $("span[data-grupo=" + t + "]", "#misTags").next().html(e)
                }
            }), $(".app-about-wedding-layer").addClass("dnone")
        }), $(".app-perfil-show-old", "#misTags").on("click", function() {
            var e = $(this).parent().find(".com-about-wedding-layer");
            if (e.is(":visible")) e.hide();
            else $(".com-about-wedding-layer").hide(), e.show()
        }), $(".app-perfil-show", "#misTags").on("click", function(e) {
            aboutToggleSuggest($(this).closest(".app-aboutwedding-show").find(".app-about-wedding-layer"), $(this).closest(".app-container"))
        }), $(".app-perfil-show", "#app-members-search").on("click", function(e) {
            aboutToggleSuggest($(this).find(".app-about-wedding-layer"), $(this))
        }), $(".app-perfil-boda-layer", "#app-members-search").on("click", function() {
            var e = $(this),
                t = e.data("id"),
                a = e.closest(".app-perfil-show"),
                i = a.data("grupo");
            $("input[data-grupo='" + i + "']").val(t), a.closest("form").submit()
        }), $("#app-show-footer-flags").on("click", function() {
            if ($("#app-footer-flags").is(":hidden")) common_footerSelectPais();
            else $("#app-footer-flags").find("ul").toggle()
        }), 0 < $(".app-slideshow-vendors-home").length) {
        var n, o = $(".app-slideshow-home-vendors-wrapper"),
            r = o.data("id-empresas"),
            s = common_isTouchDevice() ? 0 : 10;
        $.get("/index-DestacadasAjax.php?idEmpresas=" + r, function(e) {
            if (e.length) o.append(e), n = new Swiper(".app-slideshow-vendors-home", {
                slidesPerView: 4,
                spaceBetween: s,
                allowTouchMove: !1,
                simulateTouch: !1,
                loop: !0
            }), $(document.body).on("click", ".app-slideshow-vendors-prev", function() {
                n.slidePrev(400)
            }), $(document.body).on("click", ".app-slideshow-vendors-next", function() {
                n.slideNext(400)
            })
        }), $(document).mouseup(function(e) {
            for (var t = $(".index-busc-input"), a = ["#txtStrSearch", "#txtLocSearch", "#layer-suggest-1", "#layer-suggest-2"], i = !0, n = 0; n < a.length; n++) {
                if ((t = $(a[n])).is(e.target) || 0 < t.has(e.target).length) {
                    i = !1;
                    break
                }
            }
            if (i) blurEnable = !0, $("#txtLocSearch").trigger("blur", !0);
            if (!t.is(e.target) && 0 === t.has(e.target).length)
                if (blurEnable) common_removeBlackOver(), $("#txtLocSearch").trigger("blur", !0)
        })
    }
    if ($(document.body).on("mouseenter", ".app-dress-tipo-nav", function() {
            var e = $(this).data("id-tipo");
            if ($(".app-dress-destacados[data-id-tipo=" + e + "]:hidden")) $(".app-dress-destacados").hide(), $(".app-dress-destacados[data-id-tipo=" + e + "]").show()
        }), common_addJavascriptLinks(), -1 < navigator.userAgent.indexOf(" MSIE ")) $(".modal").removeClass("fade");
    if ($(document.body).on("click", ".app-footer-links", function(e) {
            e.preventDefault(), window.location.href = globals.link_sections[$(this).data("sec")]
        }), $(document.body).on("click", "*[class*=app_lnkEsc_]", function() {
            var e = $(this).attr("class").split("app_lnkEsc_")[1].split(" ")[0];
            if (e) SetCookie("ie", e)
        }), globals.Request_AnalyticsEcommerceEnabled) $(document.body).on("click", ".app-ec-click", function() {
        bodas.trackEcClick(this)
    });
    if ($(document.body).on("click", ".app-user-logged-menu-chat", function(e) {
            e.preventDefault(), $("#app-user-logged-menu-layer").toggle(), PusherManager.openCurrentChat($(this).data("totype"), $(this).data("toid"), $(this).data("idconversation"), $(this).data("toname"), $(this).data("toavatar"))
        }), BFP(), 0 < $(".app-reals-index").length) $.ajax({
        url: "/index-Real.php"
    }).done(function(e) {
        $(".app-reals-index").html(e)
    });
    if ($(".app-multilogin-toggle").on("click", function(e) {
            $("#app-logged-box").hide(), $("#app-multiLogin").toggle()
        }), $(".app-logged-toggle").on("click", function(e) {
            $("#app-multiLogin").hide(), $("#app-logged-box").toggle()
        }), 0 < ".empLoggedBox".length) $(document).mouseup(function(e) {
        var t = $(".empLoggedBox");
        if (!t.is(e.target) && 0 === t.has(e.target).length) $("#app-multiLogin").hide(), $("#app-logged-box").hide()
    });
    if ($(document.body).on("click", ".app-mirror-link", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).find("a").first().attr("href");
            document.location = t
        }), $(document.body).on("click", ".app-link", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).data("href");
            document.location = t
        }), $(document.body).on("click", ".app-link-b64", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = atob($(this).data("id-link"));
            document.location = t
        }), $(document.body).on("click", ".app-link-blank", function(e) {
            e.preventDefault(), e.stopPropagation();
            var t = $(this).data("href"),
                a = window.open();
            a.opener = null, a.location = t, a.target = "_blank"
        }), $(document.body).on("mousedown", ".app-link-blank-all", function(e) {
            var t = $(this).data("href");
            switch (e.which) {
                case 1:
                    e.preventDefault(), e.stopPropagation(), window.location = t;
                    break;
                case 2:
                    e.preventDefault(), e.stopPropagation(), window.open(t, "_blank", "noopener");
                    break;
                default:
                    return !1
            }
        }), $(document.body).on("click", ".app-share-social", function() {
            var t = $(this).data("social"),
                a = $(this).data("url"),
                i = $(this).data("title"),
                n = $(this).data("via"),
                o = $(this).data("image");
            if ($(this).data("stop-prop")) e.stopPropagation();
            common_social_share(t, a, i, n, o)
        }), 0 < $("#app-related-content").length) a = $("#app-related-content"), i = {
        idSectores: a.data("id-sectores"),
        idGrupo: a.data("id-grupo"),
        idGrupoDebate: a.data("id-grupo-debate"),
        idArticulo: a.data("id-articulo"),
        keyword: a.data("keyword"),
        idDebate: a.data("id-debate"),
        templates: a.data("templates"),
        idPage: a.data("id-page")
    }, $.post("/relatedContent/loadContent.php", i, function(e) {
        $("#app-related-content").replaceWith(e.html)
    });
    $(document.body).on("click", "#lImportFbPicture", function(e) {
        e.preventDefault(), common_setImageFacebookProfile($(this).data("url"))
    }), $(document.body).on("click", ".app-init-conversation", function(e) {
        e.preventDefault(), PusherManager.initConversation($(this).data("totype"), $(this).data("toid"), $(this).data("idconversation"), $(this).data("toname"), $(this).data("toavatar"))
    }), $(document.body).on("click", ".app-pusher-pedir-presupuesto", function(e) {
        e.preventDefault(), PusherManager.showContactar($(this).data("href"), $(this).data("id"), !1), PusherManager.minimizeChat()
    }), $(document.body).on("click", ".app-ua-track-event", function() {
        ga_trackEventAllByData($(this))
    }), $(document.body).on("click", ".app-ua-track-multisolic", function() {
        var e = $(this);
        if (!e[0].eventAlreadyTracked) {
            e[0].eventAlreadyTracked = !0;
            var t = e.data("track-c"),
                a = e.data("track-a"),
                i = e.data("track-l"),
                n = $(".app-multisolic-check:checked").length,
                o = +e.data("track-ni");
            if (a && t && i && 0 !== n) ga_trackEventAll(t, a, i, n, o)
        }
    }), $(document.body).on("click", ".app-validacion-redes-sociales", function(e) {
        e.preventDefault();
        var t = $("#input_facebook").val(),
            a = $("#input_twitter").val(),
            i = $("#input_pinterest").val(),
            n = $("#input_instagram").val(),
            o = $("#input_youtube"),
            r = o.length ? o.val() : null,
            s = $("#input_vimeo"),
            l = s.length ? s.val() : null;
        if (t.toLowerCase().indexOf("facebook.com") < 0 && 0 < t.length) return $(".app-msg-error").addClass("alert alert-error mb20 mr10 ml10").html('This Facebook profile is incorrect. Please copy the URL of your profile (ex: www.facebook.com/yourbusiness)'), !1;
        if (a.toLowerCase().indexOf("twitter.com") < 0 && 0 < a.length) return $(".app-msg-error").addClass("alert alert-error").html('This Twitter profile is incorrect. Please copy the URL of your profile (ex: twitter.com/yourbusiness)'), !1;
        if (i.toLowerCase().indexOf("pinterest.com") < 0 && 0 < i.length) return $(".app-msg-error").addClass("alert alert-error").html('This Pinterest profile is incorrect. Please copy the URL of your profile (ex: www.pinterest.com/yourbusiness)'), !1;
        if (n.toLowerCase().indexOf("instagram.com") < 0 && 0 < n.length) return $(".app-msg-error").addClass("alert alert-error").html('This Instagram profile is incorrect. Please copy the URL of your profile (ex: www.instagram.com/yourbusiness)'), !1;
        if (r && r.toLowerCase().indexOf("youtube.com") < 0 && r.length) return $(".app-msg-error").addClass("alert alert-error").html('The YouTube profile is not correct. Copy the exact link of your profile (ex: www.youtube.com/yourbusiness)'), !1;
        if (l && l.toLowerCase().indexOf("vimeo.com") < 0 && l.length) return $(".app-msg-error").addClass("alert alert-error").html('The Vimeo profile is not correct. Copy the exact link of your profile (ex: www.vimeo.com/yourbusiness)'), !1;
        else $(".app-admin-social-form").submit()
    }), $(document.body).on("click", ".app-close-signup-layer", function() {
        ga_trackEventAllByData($(this)), $("#app-common-layer").modal("hide")
    }), $(document.body).on("click", ".guests-invitationForm-upload-input", function(e) {
        $(".guests-invitationForm-upload-input").val("")
    }), $(document.body).on("click", ".app-scroll-to", function(e) {
        e.preventDefault();
        var t = $(this).data("id"),
            a = $("#" + t);
        $("html, body").stop().animate({
            scrollTop: a.offset().top
        })
    }), $(".app-suggest-designer-input").keyup(function(e) {
        if (void 0 !== e) var t = "which" in e ? e.which : e.keyCode;
        if (void 0 === e || void 0 !== e && (t < 35 || 40 < t) && 13 != t && 32 != t) c(function() {
            var n = $(".app-suggest-designer-div");
            $.ajax({
                url: "/utils-SearchDesigners.php",
                data: {
                    nameDisenador: $(".app-suggest-designer-input").val()
                },
                type: "GET",
                dataType: "json",
                success: function(e) {
                    if (n.html(""), !$.isEmptyObject(e)) {
                        var i = $();
                        $.each(e, function(e, t) {
                            var a = $("<li />").addClass("suggest-navigation").attr("data-iddisenador", t.idDesigner).attr("data-namedisenador", t.name).html(t.snippet).on("click", function() {
                                var e = $(this).data("iddisenador"),
                                    t = $(this).data("namedisenador");
                                $.ajax({
                                    url: "/com-AsignarDisenadorAUsuario.php",
                                    data: {
                                        idDisenador: e
                                    },
                                    method: "POST",
                                    success: function(e) {
                                        $(".app-name-designer").html(t)
                                    }
                                }), n.html("").hide(), $(".app-about-wedding-layer").addClass("dnone"), $(".app-perfil-show").show(), $(".app-com-icon-about[data-group=designer]").replaceWith('<i data-grupo="designer" class="app-perfil-show icon icon-about-dress"></i>')
                            });
                            i = i.add(a)
                        }), n.append($("<div/>").addClass("column-container").append($("<ul />").addClass("box-scroll").append(i)))
                    } else n.append($("<div />").addClass("suggest-message-no-results").html('No matches have been found'));
                    var t = $("<div />").addClass("suggest-message-add-vendor").html($("<p />").html('Can\'t find the designer? Add them here')).on("click", function() {
                        $.post("/com-AddNewDesignerIns.php", {
                            nameDisenador: $(".app-suggest-designer-input").val()
                        }).done(function(e) {
                            $(".app-name-designer").html($(".app-suggest-designer-input").val()), n.html("").hide(), $(".app-about-wedding-layer").addClass("dnone"), $(".app-perfil-show").show()
                        })
                    });
                    n.append(t), n.show()
                }
            })
        }, 600)
    }), $(".app-suggest-honeymoon-input").keyup(function(e) {
        if (void 0 !== e) var t = "which" in e ? e.which : e.keyCode;
        if (void 0 === e || void 0 !== e && (t < 35 || 40 < t) && 13 != t && 32 != t) c(function() {
            var i = $(".app-suggest-honeymoon-div");
            $.ajax({
                url: "/utils-SearchHoneyMoons.php",
                data: {
                    nameHoneyMoon: $(".app-suggest-honeymoon-input").val()
                },
                type: "GET",
                dataType: "json",
                success: function(e) {
                    if (i.html(""), !$.isEmptyObject(e)) {
                        var a = $();
                        $.each(e, function(e, t) {
                            li = $("<li />").addClass("suggest-navigation").attr("data-idhoneymoon", e).attr("data-namehoneymoon", t.snippet).html(t.snippet).on("click", function() {
                                var e = $(this).data("idhoneymoon");
                                $(this).data("namehoneymoon");
                                $.ajax({
                                    url: "/com-AsignarHoneyMoonAUsuario.php",
                                    data: {
                                        idHoneyMoon: e
                                    },
                                    method: "POST",
                                    success: function(e) {
                                        $(".app-name-honeymoon").html(t.name)
                                    }
                                }), i.html("").hide(), $(".app-about-wedding-layer").addClass("dnone"), $(".app-perfil-show").show(), $(".app-com-icon-about[data-group=honeymoon]").replaceWith('<i data-grupo="honeymoon" class="app-perfil-show icon icon-about-travel"></i>')
                            }), a = a.add(li)
                        }), i.append($("<div/>").addClass("column-container").append($("<ul />").addClass("box-scroll").append(a)))
                    } else i.append($("<div />").addClass("suggest-message-no-results").html('No matches have been found'));
                    li = $("<div />").addClass("suggest-message-add-vendor").html($("<p />").html('Can\'t find the destination? Add it here')).on("click", function() {
                        $.post("/com-AddNewHoneyMoonIns.php", {
                            nameHoneyMoon: $(".app-suggest-honeymoon-input").val()
                        }).done(function(e) {
                            $(".app-name-honeymoon").html($(".app-suggest-honeymoon-input").val()), i.html("").hide(), $(".app-about-wedding-layer").addClass("dnone"), $(".app-perfil-show").show()
                        })
                    }), i.append(li), i.show()
                }
            })
        }, 600)
    });
    var l, c = (l = 0, function(e, t) {
        clearTimeout(l), l = setTimeout(e, t)
    });
    if ($(document.body).on("click", ".app-articles-widget-show-subcateg", function() {
            var e = $(this);
            common_articles_menu_showCategories(e, e.data("idcateg"))
        }), common_icon_hover(".app-icon-hover"), $(document.body).on("click", ".app-dropdown-toggle", function(e) {
            var t = $(this);
            if (0 === t.children(":not(:first-child)").has(e.target).length) {
                var a = t.find(".app-dropdown-toggle-layer"),
                    i = a.data("isVisible"),
                    n = a.data("ajax"),
                    o = 0 < a.html().trim().length;
                if (n && !o) $.ajax({
                    url: n,
                    cache: !1
                }).then(function(e) {
                    a.html(e), a.data("isVisible", common_dropdown_toggle(a, i))
                });
                else a.data("isVisible", common_dropdown_toggle(a, i))
            }
        }), $(document.body).on("click", ".app-load-quote-common", function() {
            var t = $(this).closest(".app-citado").find(".app-cargar-citado-box"),
                e = t.data("type"),
                a = null;
            if ("dress" == e) a = "/catalog-GetCitaMensaje.php";
            else if ("article" == e) a = "/articles-GetCitaMensaje.php";
            else if ("real" == e) a = "/real-GetCitaMensaje.php";
            if ("" == t.html()) {
                $(this).html('Hide quoted message');
                var i = $(this).data("idcita");
                $.ajax({
                    url: a + "?idcita=" + i,
                    success: function(e) {
                        t.html(e)
                    }
                })
            } else if (!t.is(":visible")) $(this).html('Hide quoted message'), t.show();
            else $(this).html('View quoted message'), t.hide()
        }), $(document.body).on("click", ".app-modal", function() {
            var e = $(this),
                t = e.data("modal-href"),
                a = e.data("modal-container") || "app-common-layer",
                i = $("#" + a);
            if (0 === i.length) $(document.body).append('<div id="' + a + '" class="modal"></div>'), i = $("#" + a);
            var n = e.data("modal-backdropclass");
            return $.get(t).then(function(e) {
                if (i.html(e), !(i.data("bs.modal") || {}).isShown) i.modal();
                if (n) $(".modal-backdrop").addClass(n)
            }), !1
        }), $(document.body).on("click", ".app-com-show-tema-all", function() {
            $(this).hide(), $(".discuss-post-comment-globe.discuss-post-comment-globe-resume").removeClass("discuss-post-comment-globe-resume"), $(".app-com-tema-resume").hide(), $(".app-com-tema-all").removeClass("dnone")
        }), $(".radioPagBrasilMetodoPago").on("ifChecked", function(e) {
            $("#pagBrasilPaymentSelect").submit()
        }), 0 < $("#app-trumbowyg-editor-inbox").length) {
        com_load_editor("#app-trumbowyg-editor-inbox", !1, !0).on("tbwchange tbwpaste", function() {
            var e = $(".app-common-captcha");
            if (e.is(":hidden")) {
                e.show();
                var t = e.find(".app-common-captcha-img");
                if (!t.attr("src")) t.attr("src", "/captcha/captcha.php?" + Math.random())
            }
        });
        var d = $(".app-trumbowyg-editor-wrapper");
        if (d.length) d.css("opacity", "1")
    }
    if (0 < $(".tooltip").length) tooltipManager.init();
    if (0 < $(".app-input-select").length) InputSelectManager.init();
    if ($(document.body).hasClass("app-infinite-scroll")) $(window).scroll(function() {
        var r = $(".app-infinite-scroll-pagination"),
            s = $(".app-infinite-scroll-content"),
            e = r.data("end"),
            t = r.data("loading"),
            a = r.data("url"),
            l = r.data("masonry"),
            i = r.data("type"),
            n = r.data("year");
        if (r.length)
            if ($(this).scrollTop() > r.position().top - 2500 && 1 != e && 0 == t) {
                var c = r.data("page"),
                    o = "",
                    d = r.data("iduser");
                if (d) o += "&id_user=" + d;
                var p = r.data("tipo");
                if (p) o += "&tipo=" + p;
                var u = r.data("orden");
                if (u) o += "&orden=" + u;
                var m = r.data("idgroup");
                if (m) o += "&id_group=" + m;
                if (i) o += "&type=" + i;
                if (n) o += "&year=" + n;
                c++, r.data("page", c), r.data("loading", 1), $.ajax({
                    url: "/" + a + "?frmNPage=" + c + o,
                    success: function(e) {
                        if ($(".pagination").addClass("dnone"), e) {
                            var t = window.location.href;
                            if (1 < c) {
                                var a = /--(\d+)$/;
                                if (a.test(t)) t = t.replace(a, c);
                                else t += "--" + c
                            }
                            if (ga_trackPageviewAll(t, window.reduced), l) {
                                var i = $("<div />").append(e).find(".app-fav-list-item"),
                                    n = i.length,
                                    o = 0;
                                i.css({
                                    opacity: 0
                                }), s.append(i), i.each(function() {
                                    var e = $(this).find("img").attr("src"),
                                        t = new Image;
                                    t.src = e, t.onload = function() {
                                        if (++o == n) r.data("loading", 0), s.masonry("appended", i), $(".app-fav-list-item").css({
                                            opacity: 1
                                        })
                                    }
                                })
                            } else r.data("loading", 0), s.append(e)
                        } else r.data("loading", 0), r.data("end", 1), r.addClass("dnone")
                    }
                })
            }
    }), $(window).on("scroll ready", function() {
        var e = $(".app-infinite-scroll-top");
        if (1800 <= $(this).scrollTop()) e.fadeIn();
        else e.fadeOut()
    }), $(document.body).on("click", ".app-infinite-scroll-top", function() {
        $("html,body").animate({
            scrollTop: 0
        }, 200)
    });
    if (common_inputFocus(), $(document.body).on("click", ".app-ww-toggle-button", function() {
            var e = $(this),
                t = $("#app-wedding-navbar-collapse");
            if (e.hasClass("collapsed")) e.removeClass("collapsed"), t.animate({
                display: "block",
                height: "427px"
            }).addClass("in");
            else e.addClass("collapsed"), t.animate({
                display: "none",
                height: "1px"
            }).removeClass("in")
        }), $(document.body).on("submit", ".app-form-layer-data-wed", function(e) {
            e.preventDefault();
            var t = $(this);
            if (users_verificaLayerEmptyData(t)) $.ajax({
                type: "POST",
                url: "/com-LayerDataUserToolsRun.php",
                data: t.serialize(),
                success: function(e) {
                    if (0 == e.errCode) location.reload();
                    else alert('An error has occurred. Please, try again ')
                }
            })
        }), $(document.body).on("click", ".app-tools-icon-hover", function() {
            var e = $(this).data("gender"),
                t = $(this).find(".app-icon-hover-active");
            if ("male" === e) t.removeClass($(this).data("icon-old")), t.addClass($(this).data("icon-new") + " active"), $(this).addClass("modalData__roleButton--active"), $elementFemale = $(".app-female"), $elementFemale.find(".app-icon-hover-active").removeClass($elementFemale.data("icon-new")), $elementFemale.find(".app-icon-hover-active").removeClass($elementFemale.data("active")), $elementFemale.find(".app-icon-hover-active").addClass($elementFemale.data("icon-old")), $elementFemale.removeClass("modalData__roleButton--active"), $(".app-gender").val(2);
            else t.removeClass($(this).data("icon-old")), t.addClass($(this).data("icon-new") + " active"), $(this).addClass("modalData__roleButton--active"), $elementMale = $(".app-male"), $elementMale.find(".app-icon-hover-active").removeClass($elementMale.data("icon-new")), $elementMale.find(".app-icon-hover-active").removeClass($elementMale.data("active")), $elementMale.find(".app-icon-hover-active").addClass($elementMale.data("icon-old")), $elementMale.removeClass("modalData__roleButton--active"), $(".app-gender").val(1);
            common_inputAlertRemoveErrorMessages()
        }), $(document.body).hasClass("app-is-com-modif")) {
        var p = $(".app-com-modif-estimated-cost"),
            u = p.val();
        if (p.autoNumeric({
                digitGroupSeparator: globals.separators.thousand,
                decimalCharacter: globals.separators.decimal,
                minimumValue: 1,
                maximumValue: 9999999999999
            }), u && 0 < parseFloat(u)) p.autoNumeric("set", parseFloat(u).toFixed(globals.REQUEST_CURRENCY_PRECISION))
    }
    if (common_init_currency_value(), $(document.body).on("app_event_init_currency_value", function(e, t) {
            if (null != t) common_init_currency_value(t);
            else common_init_currency_value()
        }), $(document.body).on("click", ".app-followus-layer-btn", function() {
            var e = $(this).data("social-network"),
                t = getTrackingDeviceAndSectionFromReduced(window.reduced);
            ga_trackEventAll("Social", "a-click", "d-" + t.device + "+s-" + t.section + "+sn-" + e + "+o-popup", 0, !1)
        }), $(document.body).on("click", ".app-line-switch", function() {
            var e = $(this);
            e.find(".app-line-switch-item").toggleClass("inputSwitch__item--current"), $(".app-line-switch-input-" + e.data("user")).val(e.find(".inputSwitch__item--current").data("value"))
        }), $("body").hasClass("app-emp-admin-solis-show")) {
        var m = "";
        $(".app-vendors-solicitudes-response-form").on("submit", function(e) {
            e.preventDefault();
            var a = $(this);
            if (!va_solicitudes_verificaRespuesta(a)) return !1;
            if (!m) {
                for (var t = a.serializeArray(), i = 0; i < t.length; i++) {
                    if ("Comentario" == t[i].name) t[i].value = a.find(".trumbowyg-editor").html();
                    if ("NombrePlantilla" == t[i].name) {
                        for (var n = common_strip_html_tags(a.find(".trumbowyg-editor").html().replace(/(<([^>]+)>)/gi, " ").trim()).trim().split(" "), o = "", r = 0; o.length <= 20 && r < n.length;) o = o + " " + n[r], r++;
                        t[i].value = o.trim()
                    }
                }
                a.trigger("submittingMessage"), m = $.post(a.attr("action"), t, function(e) {
                    if ($("#app-trumbowyg-editor-va-chat").trumbowyg("empty"), $(".app-admin-sol-template-tag").remove(), $("#ficherosNuevos").val(""), $("#ficheroSubido").removeClass("app-inbox-upload-attachments"), 0 < $(".app-sol-reply").length) $(e.messageView).insertBefore($(".app-sol-reply:first")).hide().slideToggle("slow");
                    else $(e.messageView).insertAfter($("#app-new-inbox-message-request")).hide().slideToggle("slow");
                    if (e.newTemplateView.length) $(".app-va-template-selector").show(), $(".app-va-select-template-dropdown").append(e.newTemplateView);
                    var t = $("#SavePlantilla");
                    if (t.is(":checked")) t.iCheck("uncheck"), $("#NombrePlantilla").val("");
                    a.trigger("successfullySubmittedMessage")
                }).fail(function(e) {
                    if (e.responseJSON && e.responseJSON.errorMessage) alert(e.responseJSON.errorMessage)
                }).always(function() {
                    m = "", a.trigger("completedSubmittingMessage")
                })
            }
        })
    }
    if (common_bindTraceNavigation(), AnimatedTextfield.init(), $(document.body).on("click", ".app-switcher span", function() {
            var e = $(this),
                t = e.closest(".app-switcher").find("input");
            e.addClass("active").siblings().removeClass("active"), t.val(e.data("selected")), t.trigger("change")
        }), 0 < $(".app-sticky-aside").length)
        for (var f = document.getElementsByClassName("app-sticky-aside"), h = 0; h < f.length; h++) {
            var g = f[h],
                v = g.closest(".app-sticky-aside-parent") || g.parentElement,
                b = g.getAttribute("data-gap") || null;
            stickyAside(b, g, v)
        }
    var _ = $(".app-tools-main-countdown");
    if (_.length && _.data("fecha")) {
        var y = _.data("fecha").split("-"),
            w = (_.data("time") ? _.data("time") : "00:00:00").split(":");
        tools_run_countdown(new Date(y[0], y[1] - 1, y[2], w[0], w[1]), 0 < _.data("days"))
    }
    $(document.body).on("click", ".app-lead-edit", function() {
        $(".app-logged-user-lead").hide(), $(".app-anonymous-user-lead").show()
    }), $(document.body).on("click", ".app-storefrontContact-toggle", function() {
        $(".app-storefrontContact-form").slideDown(), $(this).parent().prepend('<i class="icon-header icon-header-form-user"></i>'), $(this).remove()
    }), $(document.body).on("submit", ".app-signup-social-form", function() {
        var e = common_VerificaAltaSocial(this);
        return internalTrackingService.triggerSubmit(this, e), e
    }), $(document.body).on("click", ".app-flashbag-messages-close", function() {
        $(".app-flashbag-messages-placeholder").remove()
    }), $(document.body).on("submit", ".app-signup-layer-form", function(e) {
        e.preventDefault();
        var t = !1;
        if (!$(this).data("type")) t = common_verificaCapaAlta(this);
        else t = common_VerificaAltaSocial(this);
        if (internalTrackingService.triggerSubmit(this, t), t) $.post("/com-CapaAltaRun.php", $(this).serialize()).then(function(e) {
            if (dataLayer.push({
                    event: "gp.wedding.signup.completed"
                }), e.facebook) window.common_teCOM("capa_alta_facebook_run"), window.ga_trackEventAll("Community", "capa_alta_facebook_run", window.getPageTrackerReduced().M, 0, 0);
            if (window.trackAnalyticsGoal("/groups/layer/user_singup/run"), void 0 !== document.onLoginOk && null !== document.onLoginOk) common_doLoginOkAction();
            else if (e.redirect) window.location = e.redirect
        })
    }), GoogleLogin.registerEvents(), $(document.body).on("keypress", ".app-form-submit-enter-disable", function() {
        return common_disableEnterKey(event)
    }), $(document.body).on("click", ".app-tooltip-button", function() {
        var e = $(this).next(".app-tooltip-button-content");
        e.css({
            display: "block"
        }), setTimeout(function() {
            e.css({
                display: "none"
            })
        }, 1e3)
    });
    var C = $(".app-user-reminder-message-globe");
    if (C.length) setTimeout(function() {
        C.hide()
    }, 8e3);
    $(document.body).on("click", ".app-copy-to-clipboard", function() {
        var e = $(".app-on-copy-tooltip");
        e.show();
        var t = document.createElement("textArea");
        if (t.value = $(this).data("clipboard-text"), t.readOnly = !0, document.body.appendChild(t), common_isIOS()) {
            var a, i;
            (a = document.createRange()).selectNodeContents(t), (i = window.getSelection()).removeAllRanges(), i.addRange(a), t.setSelectionRange(0, 999999)
        } else t.select();
        document.execCommand("copy"), document.body.removeChild(t), setTimeout(function() {
            e.hide()
        }, 1500)
    }), $(document.body).on("click", ".app-auth-login", function() {
        var e = $(this);
        common_callEnsureLogged(function() {
            window.location.href = e.data("urlAction")
        }, e.data("action"), null, null, null, !0)
    })
});
var rootdomain = window.location.protocol + "//" + window.location.hostname;

function common_modalIsOpen(e) {
    return !(void 0 === $(e).data("bs.modal") || null === $(e).data("bs.modal") || !$(e).data("bs.modal").isShown)
}

function common_loadCapaLogin(e, t, a, i) {
    common_teCOM("capa_login"), ga_trackEventAll("Community", "capa_login", getPageTrackerReduced().M, 0, 0), $.ajax({
        url: "/com-CapaLogin.php",
        data: {
            load: 0,
            close: e,
            accion: t,
            isFromWedshoots: a,
            tracking: i
        },
        success: function(e) {
            $("#app-alta-model-content").html(e)
        }
    })
}

function common_loadCapaUserExist(e, t, a) {
    $.ajax({
        url: "/com-CapaUserExist.php",
        data: {
            close: e,
            accion: t,
            email: a
        },
        success: function(e) {
            $("#app-alta-model-content").html(e)
        }
    })
}

function common_loadCapaAlta(e, t, a) {
    ga_trackEventAll("SignUpTracking", "a-step1", "d-desktop+s-js_switch_to_layer_signup", 0, 0), $.ajax({
        url: "/com-CapaAlta.php",
        data: {
            load: 0,
            close: e,
            accion: t,
            tracking: a
        },
        success: function(e) {
            $("#app-alta-model-content").html(e)
        }
    })
}

function common_verificaCapaLogin(e) {
    if (!common_validateMailField(e.Mail, !0, !0)) return !1;
    if (e.Password.value.length < 4) return alert('The password must contain a minimum of four characters'), e.Password.focus(), !1;
    else return !0
}

function common_verificaCapaAlta(e) {
    var t = internalTrackingService || {};
    if (void 0 !== e.NombreCompleto)
        if (e.NombreCompleto.value.trim().length < 4) return alert(t.nextError = 'Your name must have a minimum of four characters'), e.NombreCompleto.focus(), !1;
        else e.NombreCompleto.value = e.NombreCompleto.value.trim();
    else {
        if (e.Nombre.value.trim().length < 2) return alert(t.nextError = 'Your name must be at least two characters.'), e.Nombre.focus(), !1;
        if (e.Apellidos.value.trim().length < 2) return alert(t.nextError = 'Your last name must be at least two characters.'), e.Apellidos.focus(), !1
    }
    if (!common_validateMailField(e.Mail, !0, !0)) return !1;
    if ("51" == globals.Request_id_project) {
        if (!common_verificaUserDup(e.Mail, t.nextError = 'A user with this e-mail address already exists.')) return !1
    } else if (!common_verificaUserDup(e.Mail)) return common_loadCapaUserExist(!0, e.Section.value, e.Mail.value), !1;
    if (e.Password.value.length < 6) return alert(t.nextError = 'The password must have at least six characters.'), e.Password.focus(), !1;
    if (void 0 !== e.Poblacion && (0 === Number(e.Poblacion.value) || -1 == e.Poblacion.value || "" === e.Poblacion.value)) return alert(t.nextError = 'Please select the city in which you live'), !1;
    if (!(1 < $(e).find("[name='Rol']").size() ? $(e).find("[name='Rol']:checked").val() : $(e).find("[name='Rol']").val())) return alert('You must select your role in this event.' + "."), $("input[name=Rol]", e).focus(), !1;
    if (e.Fecha.value.length < 1) return alert(t.nextError = 'Approximate date of the event.'), e.Fecha.focus(), !1;
    var a = $("#app-check-legal-terms");
    if (0 != a.length && !a.prop("checked")) return $("#error").common_hideShow(function() {
        $("#msgError").html()
    }), alert(t.nextError = 'You must accept the Terms of Use and privacy policy.'), !1;
    else return ga_trackEventAll("SignUpTracking", "a-run", "d-desktop+s-layer_form", 0, 0), !0
}

function common_verificaUserDupValid(e) {
    var t = "nada";
    return $.ajax({
        url: "/com-VerificaUserDupValid.php?mail=" + encodeURIComponent(e),
        async: !1,
        success: function(e) {
            t = e
        }
    }), t
}

function common_verificaUserDup(t, a) {
    if ("" === t.value) {
        if (void 0 !== a && "" !== a) alert(a), t.focus();
        return !1
    }
    var i = !1;
    return $.ajax({
        url: "/com-VerificaUserDup.php?",
        method: "POST",
        data: {
            mail: t.value
        },
        async: !1,
        cache: !1,
        success: function(e) {
            if ("OK" == e.trim()) i = !0;
            else {
                if (void 0 !== a && "" !== a) alert(a), t.focus();
                i = !1
            }
        }
    }), i
}

function common_validateMail(e, t, a) {
    var i = [],
        n = t || 0;
    return $.ajax({
        url: "/json/validatorEmail.php",
        method: "POST",
        async: !1,
        dataType: "json",
        data: {
            mail: e,
            alert: n,
            field: a
        },
        success: function(e) {
            i.estado = e.result, i.suggestion = e.suggestion || ""
        }
    }), i
}

function common_validateMailAsync(e, t, a) {
    var i = {
        mail: e,
        alert: t || 0,
        field: a
    };
    return $.post("/json/validatorEmail.php", i).then(function(e) {
        var t = {};
        return t.estado = e.result, t.suggestion = e.suggestion || "", t
    })
}

function common_secureValidateMail(e) {
    var t = null;
    return $.ajax({
        url: globals.subdomain_secure + "/json/validatorEmail.php",
        method: "POST",
        data: {
            mail: e
        },
        async: !1,
        dataType: "json",
        success: function(e) {
            t = e.result
        }
    }), t
}

function common_showMailError(e, t) {
    if (!t) t = function(e) {
        alert(e)
    };
    if (!$("#msgError").length)
        if (e.suggestion && 0 < e.suggestion.length) t(e.suggestion);
        else t('Check that the e-mail is correct.');
    else $("#error").common_hideShow(function() {
        $("#msgError").html('Check that the e-mail is correct.' + e.suggestion)
    })
}

function common_validateMailField(t, e, a, i, n) {
    var o = internalTrackingService || {},
        r = {
            short: 'You can only choose one e-mail.',
            long: 'The format of your e-mail is incorrect. Check that it contains the characters "@" and ".".',
            domain: 'The format of your e-mail is incorrect. It must contain a "." followed by at least two characters.'
        };
    if ($(".app-lead-form-animated").length || n) $.extend(r, {
        short: 'Please enter a valid email',
        long: 'Please enter a valid email',
        domain: 'Please enter a valid email'
    });
    if (i = i || function(e, t) {
            alert(t)
        }, null == e) e = !0;
    var s = !1,
        l = 0,
        c = 0,
        d = 0,
        p = "";
    if (antesArroba = t.value.match(/(.*?)@/g)) c = antesArroba[0].length - 1;
    if (despuesPunto = t.value.match(/\.(.*)/g)) d = despuesPunto.slice(-1)[0].length - 1;
    if (arrobas = t.value.match(/@/g)) l = arrobas.length;
    if (t.value.match(/\./g)) s = !0;
    if (1 < l) return i($(t), o.nextError = r.short), t.focus(), !1;
    else if (0 == c || 0 == l || !s) {
        if (p = o.nextError = r.long, !$("#msgError").length) i($(t), p);
        else $("#error").common_hideShow(function() {
            $("#msgError").html(p)
        });
        return t.focus(), !1
    } else if (d < 2) {
        if (p = o.nextError = r.domain, !$("#msgError").length) i($(t), p);
        else $("#error").common_hideShow(function() {
            $("#msgError").html(p)
        });
        return t.focus(), !1
    }
    var u = common_validateMail(t.value, a, t.name);
    if (e && !u.estado) return common_showMailError(u, function(e) {
        i($(t), o.nextError = e)
    }), t.focus(), !1;
    else return !0
}

function common_doLoginOkAction() {
    if ($("#app-common-layer").modal("hide"), ajaxLoginHeaderUpdate(), void 0 !== document.onLoginOk && null !== document.onLoginOk) return document.onLoginOk(), !0;
    else return !1
}

function common_goEnsureLogged(e, t, a, i) {
    if (-1 == e.indexOf(window.location.protocol + "//")) e = rootdomain + e;
    return common_callEnsureLogged(function() {
        window.location.href = e
    }, t, a, i), !1
}

function common_callEnsureLoggedAsync(t, a, i, n, o, r, e) {
    if (void 0 === o) o = !1;
    r = (r = r || function() {}) || function() {}, e = (e = e || function() {}) || function() {}, common_verificaComSessionPromise().done(function(e) {
        if ("OK" == e.trim()) t();
        else {
            r();
            fb_init(), common_showLoginLayer(function() {
                t()
            }, a, null, null, i, n, o)
        }
    })
}

function common_callEnsureLogged(e, t, a, i, n, o, r) {
    if (void 0 === n) n = !1;
    if (void 0 === o) o = null;
    var s = common_verificaComSession();
    if (!s) {
        fb_init(), common_showLoginLayer(function() {
            e()
        }, t, o, null, a, i, n, r)
    } else e();
    return s
}

function common_showLoginLayer(e, t, a, i, n, o, r, s) {
    if (common_teCOM("capa_alta"), ga_trackEventAll("Community", "capa_alta", getPageTrackerReduced().M, 0, 0), void 0 === r) r = !1;
    document.onLoginOk = function() {
        if (!r) $("#app-common-layer").modal("hide");
        e()
    };
    var l = "/com-CompruebaLogin.php?a";
    if (null !== a) l += "&defaultLogin=" + a;
    if (!a) ga_trackEventAll("SignUpTracking", "a-step1", "d-desktop+s-js_show_login_layer", 0, 0);
    if (null !== i) l += "&redirect=" + i;
    if (null !== t) l += "&accion=" + t;
    if (null != n) l += "&" + n;
    if ($.get(l).then(function(e) {
            var t = $("#app-common-layer");
            if (t.html(e).modal({
                    keyboard: !1,
                    backdrop: "static"
                }), t.find(".app-google-layer-login").length) GoogleLogin.init()
        }), void 0 !== s) $("#app-common-layer").on("hide.bs.modal", function(e) {
        if (!$(e.target).parent().hasClass("app-common-datepicker")) {
            if (!common_verificaComSession()) s()
        }
    })
}

function common_verificaComSession() {
    var t = !1;
    return url = "/com-VerificaLayerSession.php", $.ajax({
        url: url,
        async: !1,
        cache: !1,
        success: function(e) {
            t = "OK" == e.trim()
        }
    }), t
}

function common_verificaComSessionPromise() {
    return $.ajax({
        url: "/com-VerificaLayerSession.php",
        cache: !1
    })
}

function common_showLayerRedirect(e) {
    if ("" !== document.referrer && -1 != document.referrer.indexOf(".google."))
        if (void 0 !== GetCookie && navigator.cookieEnabled)
            if (cookie_LayerRedirect = GetCookie("layerRedirect"), !cookie_LayerRedirect || "2" != cookie_LayerRedirect) $.ajax({
                url: "/utils-LayerRedirect.php?options=" + e,
                success: function(e) {
                    $(document.body).append(e), setTimeout(function() {
                        $("#layerRedirect").fadeIn(700)
                    }, 1500), $(document.body).on("click", ".app-close-layer-redirect", function() {
                        $("#layerRedirect").fadeOut(700)
                    })
                }
            })
}

function common_loadPaisComboNew(e, t) {
    $.ajax({
        url: "/utils-LoadComboProvincias.php?limite=" + t + "&id_pais=" + $('input[name="Pais"]').val(),
        cache: !0
    }).done(function(e) {
        $("#fldProvincia").html(e)
    }), $.ajax({
        url: "/utils-LoadComboPoblaciones.php?limite=" + t,
        cache: !0
    }).done(function(e) {
        $("#fldPoblacion").html(e)
    })
}

function common_loadPaisCombo(e, t) {
    $.ajax({
        url: "/utils-LoadComboProvincias.php?limite=" + t + "&id_pais=" + $('select[name="Pais"]').val(),
        cache: !0
    }).done(function(e) {
        $("#fldProvincia").html(e)
    }), $.ajax({
        url: "/utils-LoadComboPoblaciones.php?limite=" + t,
        cache: !0
    }).done(function(e) {
        $("#fldPoblacion").html(e)
    })
}

function common_loadPoblacionesCombo(e, t, a) {
    var i = void 0 === a ? "utils-LoadComboPoblaciones.php" : a;
    $.ajax({
        url: "/" + i + "?limite=" + t + "&id_pais=" + $('select[name="Pais"]').val() + "&id_provincia=" + $(e).val(),
        cache: !0
    }).done(function(e) {
        $("#fldPoblacion").html(e), $("#txtStrPoblacion").val($("#Provincia>option:selected").text())
    })
}

function common_loadPoblacionesComboLine(e, t, a) {
    var i = void 0 === a ? "utils-LoadComboPoblaciones.php" : a;
    $.ajax({
        url: "/" + i + "?limite=" + t + "&id_pais=" + $('select[name="Pais"]').val() + "&id_provincia=" + $(e).val(),
        cache: !0
    }).done(function(e) {
        $("#fldPoblacion").html(e), $("#txtStrPoblacion").val($("#Provincia>option:selected").text())
    }), common_inputAlertRemoveErrorMessages()
}

function common_setTextoLocalizacion(e) {
    $("#txtStrPoblacion").val(e)
}

function common_VerificaAltaSocial(e) {
    var t = internalTrackingService || {};
    if (!common_validateMailField(e.Mail)) return !1;
    if (e.Nombre.value.trim().length < 4) return alert(t.nextError = 'Your name must have a minimum of four characters'), e.Nombre.focus(), !1;
    else e.Nombre.value = e.Nombre.value.trim();
    if (e.Password.value.length < 6) return alert(t.nextError = 'The password must have at least six characters.'), e.Password.focus(), !1;
    if (e.Poblacion.value <= 0) return alert(t.nextError = 'Please select the city in which you live'), !1;
    if (e.Fecha.value.length < 1) return alert('Approximate date of the event.'), e.Fecha.focus(), !1;
    if (!(1 < $(e).find("[name='Rol']").size() ? $(e).find("[name='Rol']:checked").val() : $(e).find("[name='Rol']").val())) return alert('You must select your role in this event.'), !1;
    var a = $("#app-check-legal-terms");
    if (0 != a.length && !a.prop("checked")) return alert('You must accept the Terms of Use and privacy policy.'), !1;
    var i = $(e).data("type");
    if ("facebook" == i) ga_trackEventAll("SignUpTracking", "a-run", "d-desktop+s-form_fb", 0, 0);
    else if ("google" == i) ga_trackEventAll("SignUpTracking", "a-run", "d-desktop+s-form_google", 0, 0);
    return !0
}

function common_showLayerCookies() {
    if (null !== GetCookie("__utma")) return !1;
    $(document.body).prepend('<div class="cookies-msg">' + 'Cookies allow us to provide you with better services.  By using our services you agree to our use of cookies.' + ' <a class="link" href="/legal/cookies.php">' + 'More information' + "</a></div>")
}

function common_InitRoleFakeButtons(i, n) {
    if (n) var e = i;
    else e = document.body;
    $(e).on("click", ".app-role-radio-fake", function() {
        if (!n) i = $(".app-role-input-wrapper");
        var e = $(this),
            t = i.find(".app-role-radio-fake"),
            a = i.find(".app-role-radio-fake-other");
        if (t.data("selected", !1), e.data("selected", !0), a.find("input[type=radio]").prop("checked", !1), a.removeClass("strong"), t.removeClass("strong"), e.addClass("strong"), i.find(".app-capa-rol-select").hide(), a.show(), "male" == e.data("type")) i.find(".app-role-radio-fake[data-type=female]").removeClass("strong").find(".app-role-icon").removeClass("icon-female-auth-hover").addClass("icon-female-auth"), i.find(".app-simple-other-radio").prop("checked", !1), i.find(".app-role-radio-fake[data-type=male]").addClass("strong");
        else if ("female" == e.data("type")) i.find(".app-role-radio-fake[data-type=male]").removeClass("strong").find(".app-role-icon").removeClass("icon-male-auth-hover").addClass("icon-male-auth"), i.find(".app-simple-other-radio").prop("checked", !1), i.find(".app-role-radio-fake[data-type=female]").addClass("strong");
        i.find(".app-role-input").val(e.data("value")).change(), vendors_showCamposNovios(e.data("value"), e.closest("form"), !n ? null : i), i.find(".app-capa-rol-select").hide(), a.show()
    }), $(e).on("change", ".app-role-selector", function() {
        vendors_showCamposNovios($(this).val(), $(this).closest("form"), !n ? null : i)
    }), $(e).on("click", ".app-role-radio-fake-simple-other", function() {
        if (!n) i = $(".app-role-input-wrapper");
        $(this);
        var e = i.find(".app-role-radio-fake");
        e.removeClass("strong"), e.data("selected", !1), i.find(".app-simple-other-radio").prop("checked", !0), i.find(".app-role-radio-fake-other").find("input[type=radio]").prop("checked", !1), i.find(".app-role-icon").each(function(e, t) {
            var a = $(t);
            if (a.hasClass("icon-male-auth-hover")) a.removeClass("icon-male-auth-hover").addClass("icon-male-auth");
            else a.removeClass("icon-female-auth-hover").addClass("icon-female-auth")
        }), i.find(".app-role-input").val($(this).data("value")).change()
    }), $(e).on("click", ".app-role-radio-fake-other", function() {
        if (!n) i = $(".app-role-input-wrapper");
        var e = i.find(".app-role-radio-fake"),
            t = $(this);
        if (e.data("selected", !1), e.removeClass("strong"), i.find(".app-role-icon").each(function(e, t) {
                var a = $(t);
                if (a.hasClass("icon-male-auth-hover")) a.removeClass("icon-male-auth-hover").addClass("icon-male-auth");
                else a.removeClass("icon-female-auth-hover").addClass("icon-female-auth")
            }), t.data("hide-radio")) t.hide();
        t.addClass("strong").find("input[type=radio]").prop("checked", !0), i.find(".app-capa-rol-select").show();
        var a = $(this).closest("form");
        $("#divProvinciaBoda", a).hide(), i.find(".app-role-input").val($("#select-otros").val()).change()
    }), $(e).on("change", "#select-otros", function() {
        if (!n) i = $(".app-role-input-wrapper");
        i.find(".app-role-input").val($(this).val()).change()
    }), $(e).on("mouseenter", ".app-role-radio-fake", function() {
        if (!n) i = $(".app-role-input-wrapper");
        var e = $(this);
        if (e.addClass("strong"), "male" == e.data("type")) e.find(".app-role-icon").removeClass("icon-male-auth").addClass("icon-male-auth-hover");
        else if ("female" == e.data("type")) e.find(".app-role-icon").removeClass("icon-female-auth").addClass("icon-female-auth-hover")
    }), $(e).on("mouseleave", ".app-role-radio-fake", function() {
        if (!n) i = $(".app-role-input-wrapper");
        var e = $(this);
        if (e.data("value") != i.find(".app-role-input").val())
            if (e.removeClass("strong"), "male" == e.data("type")) e.find(".app-role-icon").removeClass("icon-male-auth-hover").addClass("icon-male-auth");
            else if ("female" == e.data("type")) e.find(".app-role-icon").removeClass("icon-female-auth-hover").addClass("icon-female-auth")
    }), $(e).on("mouseenter", ".app-role-radio-fake-other", function() {
        $(this).addClass("strong")
    }), $(e).on("mouseleave", ".app-role-radio-fake-other", function() {
        var e = $(this);
        if (!e.find("input[type=radio]:checked").length) e.removeClass("strong")
    })
}

function SetCookie(e, t) {
    var a = SetCookie.arguments,
        i = SetCookie.arguments.length,
        n = 3 < i ? a[3] : "/",
        o = 4 < i ? a[4] : null,
        r = 5 < i ? a[5] : !1,
        s = 6 < i ? a[6] : !1,
        l = new Date;
    if (s) {
        var c = l.getTime();
        c += 24 * s * 3600 * 1e3, l.setTime(c)
    } else l.setYear(9999);
    document.cookie = e + "=" + escape(t) + "; expires=" + l.toGMTString() + (null === n ? "/" : "; path=" + n) + (null === o ? "; domain=" + globals.Request_Cookie_domain : "; domain=" + o) + (!0 === r ? "; secure" : "")
}

function SetCookieTime(e, t, a) {
    var i = SetCookieTime.arguments,
        n = SetCookieTime.arguments.length,
        o = 3 < n ? i[3] : "/",
        r = 4 < n ? i[4] : null,
        s = 5 < n ? i[5] : !1,
        l = new Date;
    if (a) {
        var c = l.getTime();
        c += 24 * a * 3600 * 1e3, l.setTime(c)
    } else l.setYear(9999);
    document.cookie = e + "=" + escape(t) + "; expires=" + l.toGMTString() + (null === o ? "/" : "; path=" + o) + (null === r ? "; domain=" + globals.Request_Cookie_domain : "; domain=" + r) + (!0 === s ? "; secure" : "")
}

function SetCookieSession(e, t) {
    var a = SetCookieSession.arguments,
        i = SetCookieSession.arguments.length,
        n = 3 < i ? a[3] : "/",
        o = 4 < i ? a[4] : null,
        r = 5 < i ? a[5] : !1;
    document.cookie = e + "=" + escape(t) + (null === n || !n ? "/" : "; path=" + n) + (null === o ? "; domain=" + globals.Request_Cookie_domain : "; domain=" + o) + (!0 === r ? "; secure" : "")
}

function GetCookie(e) {
    var t = document.cookie.match("(^|;)\\s*" + e + "\\s*=\\s*([^;]+)");
    return t ? unescape(t.pop()) : null
}

function cookies_showContactarEmpCookies() {
    var e = document.frmContacto || document.frmContactoInline;
    if ("" === e.Nombre.value)
        if (null !== bodas.getCookieURIdecoded("pb_name")) e.Nombre.value = bodas.getCookieURIdecoded("pb_name");
    if ("" === e.Mail.value)
        if (null !== bodas.getCookieURIdecoded("pb_mail")) e.Mail.value = bodas.getCookieURIdecoded("pb_mail");
    if ("" === e.Telefono.value)
        if (null !== bodas.getCookieURIdecoded("pb_telefono")) e.Telefono.value = bodas.getCookieURIdecoded("pb_telefono");
    if (void 0 !== e.Fecha) {
        var t = e.Fecha;
        if ("" === t.value)
            if (null !== bodas.getCookieURIdecoded("pb_fecha")) t.value = bodas.getCookieURIdecoded("pb_fecha")
    }
    if (void 0 !== e.Comensales) {
        var a = $("#SolicComensales", e);
        if ("" === $(a).val())
            if (null !== bodas.getCookieURIdecoded("pb_comensales")) $(a).val(bodas.getCookieURIdecoded("pb_comensales"))
    }
    var i = $("#divVenueSaved", e);
    if (i)
        if (e.Mail.value.trim().length < 3 || cookies_verificaVenueSaved(e.Mail, "")) $(i).hide();
        else $(i).show();
    try {
        e.Nombre.focus()
    } catch (e) {}
}

function cookies_verificaVenueSaved(t, a) {
    if ("" === t.value) {
        if ("" !== a) alert(a), t.focus();
        return !1
    }
    var i = !1;
    return $.ajax({
        type: "POST",
        url: "/com-VerificaVenueSaved.php",
        data: {
            mail: escape(t.value)
        },
        async: !1,
        success: function(e) {
            if ("SAVED" == e.replace(/^\s*|\s*$/g, "")) i = !0;
            else {
                if ("" !== a) alert(a), t.focus();
                i = !1
            }
        }
    }), i
}

function parseJsonPtCookie() {
    try {
        return JSON.parse(GetCookie("pt")) || {}
    } catch (e) {
        return SetCookie("pt", ""), {}
    }
}

function trackEvent(e, t) {
    getPageTrackerReduced()._trackEvent(e, t)
}

function getPageTrackerReduced() {
    if (void 0 === window._gaq && void 0 === window._gat) return getMockGATraker();
    if (window.pageTrackerReduced) return window.pageTrackerReduced;
    if (window.asyncAnalytics) return window.pageTrackerReduced = getAsyncTracker("reduced"), window.pageTrackerReduced._setAccount(globals.Request_AnalyticsReduced_code), window.pageTrackerReduced;
    else if (void 0 !== window._gat) {
        if (window.pageTrackerReduced = window._gat._createTracker(globals.Request_AnalyticsReduced_code), !window.pageTrackerReduced) window.pageTrackerReduced = getMockGATraker();
        return window.pageTrackerReduced
    }
    return getMockGATraker()
}

function getPageTracker() {
    if (void 0 === window._gaq && void 0 === window._gat || 0 == globals.Request_Analytics_code) return getMockGATraker();
    if (window.pageTracker) return window.pageTracker;
    if (window.asyncAnalytics) return window.pageTracker = getAsyncTracker(), window.pageTracker._setAccount(globals.Request_Analytics_code), window.pageTracker;
    else if (void 0 !== window._gat) {
        if (window.pageTracker = window._gat._createTracker(globals.Request_Analytics_code), !window.pageTracker) window.pageTracker = getMockGATraker();
        return window.pageTracker
    }
    return getMockGATraker()
}

function getAsyncTracker(o) {
    if (o) o += ".";
    else o = "";
    return {
        _setAccount: function(e) {
            window._gaq.push([o + "_setAccount", e])
        },
        _trackEvent: function(e, t, a, i, n) {
            window._gaq.push([o + "_trackEvent", e, t, a, i, n])
        },
        _setCustomVar: function(e, t, a, i) {
            window._gaq.push([o + "_setCustomVar", e, t, a, i])
        },
        _initData: function() {},
        _trackPageview: function(e) {
            if (e) window._gaq.push([o + "_trackPageview", e]);
            else window._gaq.push([o + "_trackPageview"])
        },
        _setSiteSpeedSampleRate: function(e) {
            window._gaq.push([o + "_setSiteSpeedSampleRate", e])
        }
    }
}

function getMockGATraker() {
    return {
        _trackEvent: function() {},
        _setCustomVar: function() {},
        _initData: function() {},
        _trackPageview: function() {},
        _setAccount: function() {},
        _setSiteSpeedSampleRate: function() {}
    }
}

function trackAnalyticsGoal(e) {
    getPageTrackerReduced()._trackPageview(e)
}

function setZOrigen(e) {
    var t = {};
    if (null !== GetCookie("pt") && "undefined" !== GetCookie("pt")) t = parseJsonPtCookie();
    return t.o = e, SetCookieSession("pt", json_stringify(t)), !0
}

function setOrigenReduced(e) {
    var t = {};
    if (null !== GetCookie("pt") && "undefined" !== GetCookie("pt")) t = parseJsonPtCookie();
    return t.or = e, SetCookieSession("pt", json_stringify(t)), !0
}

function trackInfoLst(e, t) {
    var a = {};
    if (null !== GetCookie("pt") && "undefined" !== GetCookie("pt")) a = parseJsonPtCookie();
    return a.lt = e, a.ll = t, SetCookieSession("pt", json_stringify(a)), !0
}

function json_stringify(e) {
    var t = typeof e;
    if ("object" != t || null === e) {
        if ("string" == t) e = '"' + e + '"';
        return String(e)
    } else {
        var a, i, n = [],
            o = e && e.constructor == Array;
        for (a in e) {
            if ("string" == (t = typeof(i = e[a]))) i = '"' + i + '"';
            else if ("object" == t && null !== i) i = json_stringify(i);
            n.push((o ? "" : '"' + a + '":') + String(i))
        }
        return (o ? "[" : "{") + String(n) + (o ? "]" : "}")
    }
}

function trackPTrafico(e) {
    var t;
    if (setOrigenReduced(e), null !== GetCookie("pt") && "undefined" !== GetCookie("pt"))
        if (void 0 !== (t = parseJsonPtCookie()).id && null !== t.id) return;
    var a = '<img src="/utils-SetProveTrafico.php';
    if (location.search) a += location.search;
    else a += "?";
    if ("" !== location.search) a += "&";
    else a += "";
    if (-1 != location.href.indexOf("#")) queryaddword = location.href.split("#")[1], a += queryaddword + "&";
    if (null !== e) a += "ru=" + escape(e) + "&";
    a += "r=" + document.referrer.replace(new RegExp("&", "gi"), "|"), a += "&e=" + location.href.replace(new RegExp("&", "gi"), "|"), a += '" width="0" height="0" style="position:absolute;top:-100px">';
    var i = document.createElement("div");
    i.innerHTML = a, document.body.appendChild(i.firstChild)
}

function ga_trackEventAll(e, t, a, i, n, o) {
    UA_trackEvent(e, t, a, i, n, o);
    ga_trackEvent(getPageTracker(), e, t, a, i, n, o), ga_trackEvent(getPageTrackerReduced(), e, t, a, i, n, o)
}

function ga_trackPageviewAll(e, t) {
    if (getPageTracker()._trackPageview(e), getPageTrackerReduced()._trackPageview(t), "function" == typeof window.ga) ga("set", "dimension5", t), ga("set", "contentGroup1", t), ga("send", "pageview", e)
}

function ga_trackEvent(e, t, a, i, n, o, r) {
    if (!e) return !1;
    if (r)
        for (var s = Object.keys(r), l = 0; l < s.length; l++) {
            var c = s[l],
                d = r[c],
                p = c.replace("dimension", "");
            e._setCustomVar(+p, window.MAP_NAMES[p], d, 3)
        }
    return e._trackEvent(t, a, i, n, o)
}

function ga_crearIframeConversion(e) {
    var t = document.getElementsByTagName("body")[0],
        a = document.createElement("iframe");
    e = e + "-" + Math.floor(1e4 * Math.random()), a.setAttribute("src", "/landing-AdwordsSolic.php?id=" + e), a.setAttribute("id", e), a.style.display = "none", t.appendChild(a)
}

function UA_trackEvent(e, t, a, i, n, o) {
    if ("undefined" != typeof ga) {
        var r = GetCookie("USER_ID"),
            s = GetCookie("EMP_ID"),
            l = s ? "e" + s : r ? "u" + r : "auto";
        if ("auto" !== l) l = "{ 'userId': '" + l + "' }", ga("create", globals.Request_UniversalAnalytics_code, l);
        var c = {
                nonInteraction: +n
            },
            d = $.extend({}, c, o);
        if (ga("send", "event", e, t, a, i, d), globals.Request_AnalyticsMigrationEnabled) ga(globals.Request_AnalyticsMigrationTracker + ".send", "event", e, t, a, i, d)
    }
}

function ga_trackEventAllByData(e) {
    if (!e[0].eventAlreadyTracked) {
        e[0].eventAlreadyTracked = !0;
        var t = e.attr("data-track-c"),
            a = e.attr("data-track-a"),
            i = e.attr("data-track-l"),
            n = +e.data("track-v"),
            o = +e.data("track-ni"),
            r = e.data("track-cds");
        if (a && t && i) ga_trackEventAll(t, a, i, n, o, r || {})
    }
}

function getTrackingDeviceAndSectionFromReduced(e) {
    return {
        device: "desktop",
        section: e.slice(1).split("/").join("_")
    }
}
$(document).ready(function() {
    $("#app-common-layer").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal"), $(this).html("")
    });
    var e = $(".app-role-input-wrapper");
    if (1 < e.length) e.each(function() {
        common_InitRoleFakeButtons($(this), !0)
    });
    else common_InitRoleFakeButtons(e, !1);
    $(document.body).on("ifChanged", "input[name=Sexo]", function() {
        var e = $(this).val(),
            t = $("input[name='Edad']:checked").val(),
            a = $("#Grupo").val();
        if ($(".app-capa-sexo").removeClass("active"), 1 == e) {
            if ($(".form-input-hombre").addClass("active"), 1 == a) $(".add-guest-form .ico-guest").removeClass("bride men woman girl boy baby").addClass("groom");
            else if (1 == t) $(".add-guest-form .ico-guest").removeClass("groom bride woman girl boy baby").addClass("men");
            else if (2 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men woman girl baby").addClass("boy");
            else if (3 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men woman girl boy").addClass("baby")
        } else if (2 == e)
            if ($(".form-input-mujer").addClass("active"), 1 == a) $(".add-guest-form .ico-guest").removeClass("groom men woman girl boy baby").addClass("bride");
            else if (1 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men girl boy baby").addClass("woman");
        else if (2 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men woman boy baby").addClass("girl");
        else if (3 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men woman girl boy").addClass("baby")
    }), $(document.body).on("ifChanged", "input[name=Edad]", function() {
        var e = $(this).val(),
            t = $("input[name='Sexo']:checked").val(),
            a = $("#Grupo").val();
        if ($(".app-capa-edad").removeClass("active"), 1 == e) {
            if ($(".form-input-adulto").addClass("active"), 1 == t)
                if (1 == a) $(".add-guest-form .ico-guest").removeClass("bride men woman girl boy baby").addClass("groom");
                else $(".add-guest-form .ico-guest").removeClass("groom bride woman girl boy baby").addClass("men");
            else if (2 == t)
                if (1 == a) $(".add-guest-form .ico-guest").removeClass("groom men woman girl boy baby").addClass("bride");
                else $(".add-guest-form .ico-guest").removeClass("groom bride men girl boy baby").addClass("woman")
        } else if (2 == e) {
            if ($(".form-input-nino").addClass("active"), 1 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men woman girl baby").addClass("boy");
            else if (2 == t) $(".add-guest-form .ico-guest").removeClass("groom bride men woman boy baby").addClass("girl")
        } else if (3 == e) $(".form-input-bebe").addClass("active"), $(".add-guest-form .ico-guest").removeClass("groom bride men woman girl boy").addClass("baby")
    })
}), window.MAP_NAMES = {
    15: "vendor_id",
    16: "listing_id",
    17: "frm_insert",
    20: "sector_id",
    21: "group_id"
};
var analyticsManager = function() {
        var t = [];
        return {
            queueEvent: function(e) {
                t.push(e)
            },
            trackQueuedEvents: function() {
                for (var e in t) t[e]()
            }
        }
    }(),
    GtagTracking = {
        event: function(e, t) {
            var a = $.extend({}, {
                send_to: "adwords"
            }, t);
            if (window.gtag) window.gtag("event", e, a)
        }
    };

function AjaxFormManager(e, t, a, i, n, o, r) {
    this.form = $(e), this.onOk = i, this.onError = n, this.errDisplayMode = t, this.errDisplayFnc = a, this.progressFunction = o, this.clientValidation = r;
    var s = this;
    if (null == this.errDisplayMode) this.errDisplayMode = this.ERR_DISPLAY_STANDAR;
    if (0 < this.form.length) {
        var l = this.form[0].onsubmit;
        this.form[0].onsubmit = null
    }
    this.form.submit(function() {
        if ("undefined" != typeof tinyMCE) tinyMCE.triggerSave();
        if (null != l) {
            if (l.call(this)) s.doSubmit()
        } else s.doSubmit();
        return !1
    })
}

function fb_init(e) {
    if (!fbConnectLoaded) $.getScript("//connect.facebook.net/en_US/sdk.js", function() {
        if (FB.init({
                appId: globals.Request_FB_AppID,
                version: globals.fbGraphApiVersion,
                status: !0,
                cookie: !0,
                xfbml: !0,
                oauth: !0,
                channelUrl: window.location.protocol + "//" + globals.SUBDOMAIN_MAIL + "/utils-FbChannel.php"
            }), null != e) e()
    });
    else if (null != e) e()
}

function wpFbConnectLogin(e, t, a, i, n) {
    if (void 0 === t) t = function() {
        wpFbProcessLogin(e, a = a || !1, i = i || "/tools/Main", n = n || "")
    };
    return fb_init(function() {
        FB.login(function(e) {
            if (e.authResponse) ga_trackEventAll("LoginTracking", "a-run", "d-desktop+s-user_login_facebook", 0, !1), t(e.authResponse)
        }, {
            scope: "user_location, email"
        })
    }), !1
}

function wpFbProcessLogin(a, i, n, o) {
    FacebookLoginPromise().then(function(e) {
        if (e.success)
            if (common_teCOM("login_facebook_run"), a) {
                var t = $("input[name=urlR]").val();
                window.location = t || n
            } else ga_trackEventAll("Community", "login_facebook_run", getPageTrackerReduced().M, 0, 0), common_doLoginOkAction();
        else if (e.unsubscribed)
            if (a) window.location = "/users-login.php";
            else alert('A user with this email address already exists.'), $("#fb-loading").parent().html(""), $("p.or").html("");
        else if (e.signup) loadCapaFbcAlta(a, e.accessToken, i, n, o)
    })
}

function FbcLogin(t) {
    if (!t) t = "/tools/Main";
    return FacebookLoginPromise().then(function(e) {
        if (!e.success) window.location = "/users-login.php";
        else common_teCOM("login_facebook_run"), window.location = t
    })
}

function FacebookLoginPromise(e) {
    return $.ajax({
        url: "/com-FbLoginRun.php",
        data: {
            access_token: e
        },
        dataType: "json"
    })
}

function loadCapaFbcAlta(t, e, a, i, n) {
    return $.ajax({
        url: "/com-CapaFbcAlta.php",
        data: {
            defaultSignup: t ? 1 : 0,
            facebookLayoutSignup: a ? 1 : 0,
            token: e,
            urlAction: i,
            action: n
        }
    }).then(function(e) {
        if (a) $("#app-common-layer").html(e).modal("show");
        else if (!t) common_teCOM("capa_alta_facebook"), ga_trackEventAll("Community", "capa_alta_facebook", getPageTrackerReduced().M, 0, 0), $("#app-signup-layer-content").html(e);
        else common_teCOM("alta_facebook"), ga_trackEventAll("Community", "alta_facebook", getPageTrackerReduced().M, 0, 0), $("#app-signup-layer-content").html(e), $(".app-go-login-btn").attr("href", "/users-login.php"), $(".close").remove();
        common_specificApplyIcheck()
    })
}

function com_ShowFbPicture() {
    FB.getLoginStatus(function(e) {
        if ("connected" === e.status) com_LayerFbPicture();
        else FB.login(function(e) {
            if (e.authResponse) com_LayerFbPicture()
        })
    })
}

function com_LayerFbPicture() {
    common_openLayer("/com-ShowFbPicture.php", function() {
        common_teCOM("fbPicture_Show"), ga_trackEventAll("Community", "fbPicture_Show", getPageTrackerReduced().M, 0, 0)
    })
}

function unlinkFbAccount() {
    return common_teCOM("prefs_facebook_unlink"), $.post("/com-UnlinkFbAccount.php")
}
AjaxFormManager.prototype = {
        ERR_DISPLAY_STANDAR: 1,
        ERR_DISPLAY_ALERT: 2,
        ERR_DISPLAY_CUSTOM: 3,
        ERR_DISPLAY_BOX: 4,
        ERR_DISPLAY_BOX_NOSCROLL: 5,
        ERR_DISPLAY_BOX_INLINE: 6,
        doSubmit: function() {
            if ("function" == typeof this.clientValidation)
                if (!this.clientValidation()) return !1;
            var e = this.form.attr("action");
            data = null;
            var t = this;
            if (document.body.style.cursor = "wait", null != this.progressFunction) this.progressFunction(!0);

            function a(e) {
                if (null != t.progressFunction) t.progressFunction(!1);
                if (document.body.style.cursor = "default", t.form.find(".mensajeError").remove(), t.form.find(".conError").removeClass("conError"), 0 == e.errCode) t.doOk(e);
                else t.doError(e)
            }
            if (window.FormData && 0 < this.form.find("input[type=FILE]").length) data = new FormData, $.each(this.form.serializeArray(), function() {
                data.append(this.name, this.value)
            }), this.form.find("input[type=FILE]").each(function() {
                data.append(this.name, this.files[0])
            }), $.ajax({
                url: e,
                type: "POST",
                contentType: !1,
                data: data,
                processData: !1,
                cache: !1,
                success: a,
                dataType: "json"
            });
            else data = this.form.serialize(), $.post(e, data, a, "json")
        },
        doOk: function(e) {
            if (this.form.find(".errors").remove(), null != e.messages) $.each(e.messages, function(e, t) {
                if ("global" == e) {
                    if (0 < t.trim().length) alert(t);
                    return !1
                }
            });
            if (this.onOk) this.onOk(e);
            else if (null != e.redirect) {
                if (null != this.progressFunction) this.progressFunction(!0);
                window.location = e.redirect
            } else window.location.href = window.location.href
        },
        doError: function(e) {
            this.form.find(".errors").remove(), $(".alert-error").remove();
            var n = this;
            switch (this.errDisplayMode) {
                case this.ERR_DISPLAY_CUSTOM:
                    $.each(e.messages, this.errDisplayFnc);
                    break;
                case this.ERR_DISPLAY_ALERT:
                    $.each(e.messages, function(e, t) {
                        return alert(t), !1
                    });
                    break;
                case this.ERR_DISPLAY_BOX:
                case this.ERR_DISPLAY_BOX_NOSCROLL:
                    var o = this;
                    $.each(e.messages, function(e, t) {
                        if (0 == t.trim().length) return !0;
                        var a = $("[name=" + e + "]", n.form);
                        a.focus();
                        var i = a.parents(".app-common-ajaxform-section:first");
                        if (i.prepend('<div class="mt10 alert alert-error"><p>' + t + "</p></div>"), o.errDisplayMode == o.ERR_DISPLAY_BOX)
                            if (a.length) return $(document.body).animate({
                                scrollTop: i.offset().top - 10
                            }, 300), !1
                    });
                    break;
                case this.ERR_DISPLAY_BOX_INLINE:
                    o = this;
                    $.each(e.messages, function(e, t) {
                        if (0 == t.trim().length) return !0;
                        common_inputAlertwithMessage($("[name=" + e + "]", n.form), t)
                    });
                    break;
                default:
                    $.each(e.messages, function(e, t) {
                        var a = $("#" + e + "_parent", n.form);
                        if (0 < a.length) a.parent().append("<div class=\"mensajeError\" style='clear:left'>" + t + "</div>"), a.addClass("conError");
                        else $("[name=" + e + "]", n.form).parent().append('<p class="mensajeError">' + t + "</p>"), $("[name=" + e + "]", n.form).addClass("conError")
                    }), $.each(e.messages, function(e, t) {
                        var a = $("[name=" + e + "]", n.form);
                        if (a.focus(), a && 0 < a.length) return $.scrollTo(a, {
                            offset: {
                                top: -200
                            }
                        }), !1
                    })
            }
            var a = !1;
            if ($.each(e.messages, function(e, t) {
                    if ("global" == e) {
                        if (0 < t.trim().length) alert(t);
                        return !(a = !0)
                    }
                }), !a && this.errDisplayMode == this.ERR_DISPLAY_STANDAR) alert('Please complete the form with valid information.');
            if (null != this.onError) this.onError(e)
        }
    },
    function(o) {
        function r(e, t) {
            if (this.element = o(e), this.format = h.parseFormat(t.format || this.element.data("date-format") || "mm/dd/yyyy"), this.picker = o(h.template).appendTo("body").on({
                    click: o.proxy(this.click, this)
                }), this.isInput = this.element.is("input"), this.component = this.element.is(".date") ? this.element.find(".add-on") : !1, this.isInput) this.element.on({
                focus: o.proxy(this.show, this),
                keyup: o.proxy(this.update, this)
            });
            else if (this.component) this.component.on("click", o.proxy(this.show, this));
            else this.element.on("click", o.proxy(this.show, this));
            if (this.minViewMode = t.minViewMode || this.element.data("date-minviewmode") || 0, "string" == typeof this.minViewMode) switch (this.minViewMode) {
                case "months":
                    this.minViewMode = 1;
                    break;
                case "years":
                    this.minViewMode = 2;
                    break;
                default:
                    this.minViewMode = 0
            }
            if (this.viewMode = t.viewMode || this.element.data("date-viewmode") || 0, "string" == typeof this.viewMode) switch (this.viewMode) {
                case "months":
                    this.viewMode = 1;
                    break;
                case "years":
                    this.viewMode = 2;
                    break;
                default:
                    this.viewMode = 0
            }
            this.appendElement = t.appendElement || this.element.data("append-element") || 0, this.picker.append(o(this.appendElement).html()), this.startViewMode = this.viewMode, this.weekStart = t.weekStart || this.element.data("date-weekstart") || 0, this.weekEnd = 0 === this.weekStart ? 6 : this.weekStart - 1, this.onRender = t.onRender, this.fillDow(), this.fillMonths(), this.update(), this.showMode()
        }
        r.prototype = {
            constructor: r,
            show: function(e) {
                if (this.picker.show(), this.height = this.component ? this.component.outerHeight() : this.element.outerHeight(), this.place(), o(window).on("resize", o.proxy(this.place, this)), e) e.stopPropagation(), e.preventDefault();
                if (!this.isInput);
                var t = this;
                o(document).on("mousedown", function(e) {
                    if (0 == o(e.target).closest(".datepicker").length) t.hide()
                }), this.element.trigger({
                    type: "show",
                    date: this.date
                })
            },
            hide: function() {
                if (this.picker.hide(), o(window).off("resize", this.place), this.viewMode = this.startViewMode, this.showMode(), !this.isInput) o(document).off("mousedown", this.hide);
                this.element.trigger({
                    type: "hide",
                    date: this.date
                })
            },
            set: function() {
                var e = h.formatDate(this.date, this.format);
                if (!this.isInput) {
                    if (this.component) this.element.find("input").prop("value", e);
                    this.element.data("date", e)
                } else this.element.prop("value", e)
            },
            setValue: function(e) {
                if ("string" == typeof e) this.date = h.parseDate(e, this.format);
                else this.date = new Date(e);
                this.set(), this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0), this.fill()
            },
            place: function() {
                var e = this.component ? this.component.offset() : this.element.offset();
                this.picker.css({
                    top: e.top + this.height,
                    left: e.left
                })
            },
            update: function(e) {
                this.date = h.parseDate("string" == typeof e ? e : this.isInput ? this.element.prop("value") : this.element.data("date"), this.format), this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0), this.fill()
            },
            fillDow: function() {
                for (var e = this.weekStart, t = "<tr>"; e < this.weekStart + 7;) t += '<th class="dow">' + h.dates.daysMin[e++ % 7] + "</th>";
                t += "</tr>", this.picker.find(".datepicker-days thead").append(t)
            },
            fillMonths: function() {
                for (var e = "", t = 0; t < 12;) e += '<span class="month">' + h.dates.monthsShort[t++] + "</span>";
                this.picker.find(".datepicker-months td").append(e)
            },
            fill: function() {
                var e = new Date(this.viewDate),
                    t = e.getFullYear(),
                    a = e.getMonth(),
                    i = this.date.valueOf();
                this.picker.find(".datepicker-days th:eq(1)").text(h.dates.months[a] + " " + t);
                var n = new Date(t, a - 1, 28, 0, 0, 0, 0),
                    o = h.getDaysInMonth(n.getFullYear(), n.getMonth());
                n.setDate(o), n.setDate(o - (n.getDay() - this.weekStart + 7) % 7);
                var r = new Date(n);
                r.setDate(r.getDate() + 42), r = r.valueOf();
                for (var s, l, c, d = []; n.valueOf() < r;) {
                    if (n.getDay() === this.weekStart) d.push("<tr>");
                    if (s = this.onRender(n), l = n.getFullYear(), (c = n.getMonth()) < a && l === t || l < t) s += " old";
                    else if (a < c && l === t || t < l) s += " new";
                    if (n.valueOf() === i) s += " active";
                    if (d.push('<td class="day ' + s + '">' + n.getDate() + "</td>"), n.getDay() === this.weekEnd) d.push("</tr>");
                    n.setDate(n.getDate() + 1)
                }
                this.picker.find(".datepicker-days tbody").empty().append(d.join(""));
                var p = this.date.getFullYear(),
                    u = this.picker.find(".datepicker-months").find("th:eq(1)").text(t).end().find("span").removeClass("active");
                if (p === t) u.eq(this.date.getMonth()).addClass("active");
                d = "", t = parseInt(t - 5, 10);
                var m = this.picker.find(".datepicker-years").find("th:eq(1)").text(t + "-" + (t + 9)).end().find("td");
                t -= 1;
                for (var f = -1; f < 11; f++) d += '<span class="year' + (-1 === f || 10 === f ? " old" : "") + (p === t ? " active" : "") + '">' + t + "</span>", t += 1;
                m.html(d)
            },
            click: function(e) {
                e.stopPropagation(), e.preventDefault();
                var t = o(e.target).closest("span, td, th");
                if (1 === t.length) switch (t[0].nodeName.toLowerCase()) {
                    case "th":
                        switch (t[0].className) {
                            case "switch":
                                this.showMode(1);
                                break;
                            case "prev":
                            case "next":
                                this.viewDate["set" + h.modes[this.viewMode].navFnc].call(this.viewDate, this.viewDate["get" + h.modes[this.viewMode].navFnc].call(this.viewDate) + h.modes[this.viewMode].navStep * ("prev" === t[0].className ? -1 : 1)), this.fill(), this.set()
                        }
                        break;
                    case "span":
                        if (t.is(".month")) {
                            var a = t.parent().find("span").index(t);
                            this.viewDate.setMonth(a)
                        } else {
                            var i = parseInt(t.text(), 10) || 0;
                            this.viewDate.setFullYear(i)
                        }
                        if (1 == this.viewMode) this.date = new Date(this.viewDate), this.element.trigger({
                            type: "changeDate",
                            date: this.date,
                            viewMode: h.modes[this.viewMode].clsName
                        });
                        this.showMode(-1), this.fill(), this.set();
                        break;
                    case "td":
                        if (t.is(".day") && !t.is(".disabled")) {
                            var n = parseInt(t.text(), 10) || 1;
                            a = this.viewDate.getMonth();
                            if (t.is(".old")) a -= 1;
                            else if (t.is(".new")) a += 1;
                            i = this.viewDate.getFullYear();
                            this.date = new Date(i, a, n, 0, 0, 0, 0), this.viewDate = new Date(i, a, Math.min(28, n), 0, 0, 0, 0), this.fill(), this.set(), this.element.trigger({
                                type: "changeDate",
                                date: this.date,
                                viewMode: h.modes[this.viewMode].clsName
                            })
                        }
                }
            },
            mousedown: function(e) {
                e.stopPropagation(), e.preventDefault()
            },
            showMode: function(e) {
                if (e) this.viewMode = Math.max(this.minViewMode, Math.min(2, this.viewMode + e));
                this.picker.find(">div").hide().filter(".datepicker-" + h.modes[this.viewMode].clsName).show()
            }
        }, o.fn.datepicker = function(i, n) {
            return this.each(function() {
                var e = o(this),
                    t = e.data("datepicker"),
                    a = "object" == typeof i && i;
                if (!t) e.data("datepicker", t = new r(this, o.extend({}, o.fn.datepicker.defaults, a)));
                if ("string" == typeof i) t[i](n)
            })
        }, o.fn.datepicker.defaults = {
            onRender: function(e) {
                return ""
            }
        }, o.fn.datepicker.Constructor = r;
        var h = {
            modes: [{
                clsName: "days",
                navFnc: "Month",
                navStep: 1
            }, {
                clsName: "months",
                navFnc: "FullYear",
                navStep: 1
            }, {
                clsName: "years",
                navFnc: "FullYear",
                navStep: 10
            }],
            dates: {
                days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                daysShort: ['Sun', 'Mon', 'Mar', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                daysMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            isLeapYear: function(e) {
                return e % 4 == 0 && e % 100 != 0 || e % 400 == 0
            },
            getDaysInMonth: function(e, t) {
                return [31, h.isLeapYear(e) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][t]
            },
            parseFormat: function(e) {
                var t = e.match(/[.\/\-\s].*?/),
                    a = e.split(/\W+/);
                if (!t || !a || 0 === a.length) throw new Error("Invalid date format.");
                return {
                    separator: t,
                    parts: a
                }
            },
            parseDate: function(e, t) {
                var a, i = e.split(t.separator);
                if ((e = new Date).setHours(0), e.setMinutes(0), e.setSeconds(0), e.setMilliseconds(0), i.length === t.parts.length) {
                    for (var n = e.getFullYear(), o = e.getDate(), r = e.getMonth(), s = 0, l = t.parts.length; s < l; s++) switch (a = parseInt(i[s], 10) || 1, t.parts[s]) {
                        case "dd":
                        case "d":
                            o = a, e.setDate(a);
                            break;
                        case "mm":
                        case "m":
                            r = a - 1, e.setMonth(a - 1);
                            break;
                        case "yy":
                            n = 2e3 + a, e.setFullYear(2e3 + a);
                            break;
                        case "yyyy":
                            n = a, e.setFullYear(a)
                    }
                    e = new Date(n, r, o, 0, 0, 0)
                }
                return e
            },
            formatDate: function(e, t) {
                var a = {
                    d: e.getDate(),
                    m: e.getMonth() + 1,
                    yy: e.getFullYear().toString().substring(2),
                    yyyy: e.getFullYear()
                };
                a.dd = (a.d < 10 ? "0" : "") + a.d, a.mm = (a.m < 10 ? "0" : "") + a.m;
                e = [];
                for (var i = 0, n = t.parts.length; i < n; i++) e.push(a[t.parts[i]]);
                return e.join(t.separator)
            },
            headTemplate: '<thead><tr><th class="prev">&lsaquo;</th><th colspan="5" class="switch"></th><th class="next">&rsaquo;</th></tr></thead>',
            contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
        };
        h.template = '<div class="datepicker dropdown-menu"><div class="datepicker-days"><table class=" table-condensed">' + h.headTemplate + '<tbody></tbody></table></div><div class="datepicker-months"><table class="table-condensed">' + h.headTemplate + h.contTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + h.headTemplate + h.contTemplate + "</table></div></div>"
    }(window.jQuery),
    function(u, a) {
        var t = "collapser",
            i = {
                target: "next",
                mode: "words",
                speed: "slow",
                truncate: 10,
                ellipsis: "...",
                effect: "fade",
                controlBtn: "",
                showText: "Show more",
                hideText: "Hide text",
                showClass: "show-class",
                hideClass: "hide-class",
                atStart: "hide",
                lockHide: !1,
                dynamic: !1,
                changeText: !1,
                beforeShow: null,
                afterShow: null,
                beforeHide: null,
                afterHide: null
            };

        function n(e, t) {
            var a = this;
            if (a.o = u.extend({}, i, t), a.e = u(e), "function" == typeof common_isInternetExplorer8 && common_isInternetExplorer8()) return a.e.show(), !1;
            if (a.init(), !a.e.is(":visible")) a.e.show()
        }
        n.prototype = {
            init: function() {
                var e, t = this;
                t.mode = t.o.mode, t.remaining = {}, t.ctrlHtml = ' <a href="#" data-ctrl class="' + (!u.isFunction(t.o.controlBtn) ? t.o.controlBtn : "") + '"></a>', u(t.e).each(function() {
                    u(this).data("oCnt", t.e.html());
                    var e = u.isFunction(t.o.atStart) ? t.o.atStart.call(t.e) : t.o.atStart;
                    if ("hide" == (e = void 0 !== t.e.attr("data-start") ? t.e.attr("data-start") : e)) t.hide(t.e, 0);
                    else t.show(t.e, 0)
                }), u(a).on("resize", function() {
                    if (t.o.dynamic && "lines" == t.mode) clearTimeout(e), e = setTimeout(function() {
                        t.reInit(t.e)
                    }, 100)
                })
            },
            show: function(e, t) {
                var a = this,
                    i = u(e);
                if (void 0 === t) t = a.o.speed;

                function n() {
                    if (u.isFunction(a.o.afterShow)) a.o.afterShow.call(a.e, a)
                }
                if (u.isFunction(a.o.beforeShow)) a.o.beforeShow.call(a.e, a);
                switch (a.mode) {
                    case "chars":
                    case "words":
                        var o = i.height();
                        i.html(i.data("tHTML"));
                        var r = i.height();
                        i.height(o), i.animate({
                            height: r
                        }, t, function() {
                            i.height("auto"), n()
                        }).removeClass(a.o.hideClass).addClass(a.o.showClass), i.data("tHTML", i.html());
                        break;
                    case "lines":
                        if (0 == i.children("div").length) i.wrapInner("<div>");
                        var s = i.children("div"),
                            l = s.height(),
                            c = s.html(i.data("oCnt")).css("height", "").height();
                        s.css("height", l);
                        s.animate({
                            height: c
                        }, t, function() {
                            s.height("auto"), n()
                        }), i.removeClass(a.o.hideClass).addClass(a.o.showClass);
                        break;
                    case "block":
                        a.blockMode(i, "show", t, n)
                }
                if ((a.status = 1) == a.o.lockHide) return i.find("[data-ctrl]").remove(), "";
                if ("block" == a.mode) i.off("click.coll").on("click.coll", function(e) {
                    e.preventDefault(), a.hide(i)
                });
                else {
                    if (0 == i.find("[data-ctrl]").length && !u.isFunction(a.o.controlBtn)) i.append(a.ctrlHtml);
                    a.ctrlBtn = u.isFunction(a.o.controlBtn) ? a.o.controlBtn.call(a.e) : u(i.find("[data-ctrl]")), a.ctrlBtn.off("click.coll").on("click.coll", function(e) {
                        e.preventDefault(), a.hide(i)
                    }).html(a.o.hideText)
                }
            },
            hide: function(e, t) {
                var a = this,
                    i = u(e);
                if (void 0 === t) t = a.o.speed;

                function n() {
                    if (u.isFunction(a.o.afterHide)) a.o.afterHide.call(a.e, a)
                }
                if (u.isFunction(a.o.beforeHide)) a.o.beforeHide.call(a.e, a);
                switch (i.find("[data-ctrl]").remove(), a.mode) {
                    case "chars":
                        var o = u.trim(i.text());
                        if (a.remaining.chars = o.length - a.o.truncate, o.length > a.o.truncate) i.data("tHTML", i.html()), o = a.pad(o.slice(0, a.o.truncate), o.slice(a.o.truncate, o.length)), i.html(o).removeClass(a.o.showClass).addClass(a.o.hideClass), n();
                        break;
                    case "words":
                        var r = (o = u.trim(i.text())).split(" ");
                        if (a.remaining.words = r.length - a.o.truncate, r.length > a.o.truncate) i.data("tHTML", i.html()), o = a.pad(r.slice(0, a.o.truncate).join(" "), r.slice(a.o.truncate, r.length).join(" ")), i.html(o).removeClass(a.o.showClass).addClass(a.o.hideClass), n();
                        break;
                    case "lines":
                        if (0 == i.children("div").length) i.wrapInner("<div>");
                        var s = i.children("div").css("height", "");
                        s.html(s.text());
                        var l = s.height();
                        if (void 0 === i.data("lHeight")) temp = s.clone(), lHeight = temp.text("a").insertAfter(s).height(), i.data("lHeight", lHeight), s.next().remove();
                        else lHeight = i.data("lHeight");
                        if (lines = l / lHeight, a.remaining.lines = lines - a.o.truncate, 0 < a.remaining.lines) {
                            if (s.css("overflow", "hidden"), s.animate({
                                    height: lHeight * a.o.truncate
                                }, t).data("tHeight", l), i.removeClass(a.o.showClass).addClass(a.o.hideClass), 0 == i.find("[data-ctrl]").length && !u.isFunction(a.o.controlBtn)) i.append(a.ctrlHtml);
                            n()
                        }
                        break;
                    case "block":
                        a.blockMode(i, "hide", t, n)
                }
                if (a.status = 0, "block" == a.mode) i.unbind("click.coll").bind("click.coll", function(e) {
                    e.preventDefault(), a.show(i)
                });
                else {
                    a.ctrlBtn = u.isFunction(a.o.controlBtn) ? a.o.controlBtn.call(a.e) : u(i.find("[data-ctrl]")), a.ctrlBtn.off("click.coll").on("click.coll", function(e) {
                        e.preventDefault(), a.show(i)
                    }).html(a.o.showText);
                    var c = a.o.showText,
                        d = {
                            chars: ["character", "characters"],
                            words: ["word", "words"],
                            lines: ["lines", "lines"]
                        },
                        p = a.remaining[a.mode] + (1 == a.remaining[a.mode] ? " " + d[a.mode][0] : " " + d[a.mode][1]);
                    c = c.replace("%s", p), a.ctrlBtn.html(c)
                }
            },
            pad: function(e, t) {
                return e + '<span class="coll-ellipsis">' + this.o.ellipsis + "</span>" + (!u.isFunction(this.o.ctrlBtn) ? this.ctrlHtml : "") + '<span class="coll-hidden" style="display:none">' + t + "</span>"
            },
            blockMode: function(e, t, a, i) {
                var n = this,
                    o = ["fadeOut", "slideUp", "fadeIn", "slideDown"],
                    r = "fade" == n.o.effect ? 0 : 1,
                    s = "hide" == t ? o[r] : o[2 + r];
                if (!u.isFunction(n.o.target)) {
                    if (u.fn[n.o.target]) u(e)[n.o.target]()[s](a, i)
                } else n.o.target.call(n.e)[s](a, i);
                if ("show" == t) {
                    if (e.removeClass(n.o.showClass).addClass(n.o.hideClass), n.o.changeText) e.text(n.o.hideText)
                } else if (e.removeClass(n.o.hideClass).addClass(n.o.showClass), n.o.changeText) e.text(n.o.showText)
            },
            reInit: function(e) {
                var t = this;
                if (e.find("[data-ctrl]").remove(), t.mode, 1) e.html(t.e.data("oCnt"));
                if (0 == t.status) t.hide(e, 0);
                else t.show(e, 0)
            }
        }, u.fn[t] = function(e) {
            return this.each(function() {
                if (!u.data(this, t)) u.data(this, t, new n(this, e))
            })
        }
    }(jQuery, window, document), fbConnectLoaded = !1, window.fbAsyncInit = function() {
        fbConnectLoaded = !0
    }, $(document).ready(function() {
        $(document.body).on("click", ".app-facebook-button", function() {
            if (!$(this).hasClass("noloader")) {
                var e = $(this).parent().html(),
                    t = $("<img />").attr("src", globals.subdomain_cdn_img + "/img/ajax-loader-bar-blue.gif");
                $(this).parent().html(t), setTimeout(function() {
                    t.parent().html(e)
                }, 1e4)
            }
        })
    });
var GoogleLogin = function() {
        var e;

        function t() {
            if (window.globals.googleLoginClientId) return a().then(function(e) {
                return $.post("/auth/google/login", {
                    idToken: e
                })
            })
        }

        function a() {
            var t = $.Deferred();

            function a(e) {
                t.reject(e)
            }
            return i().then(function(e) {
                return e.signIn().then(function(e) {
                    t.resolve(e.getAuthResponse().id_token)
                }, a)
            }, a), t.promise()
        }

        function i() {
            if (window.globals.googleLoginClientId)
                if (e) return $.when().then(function() {
                    return e
                });
                else return function() {
                    if (window.gapi && window.gapi.auth2) return $.when();
                    return $.ajax({
                        url: "https://apis.google.com/js/api:client.js",
                        dataType: "script",
                        cache: !0
                    }).then(function() {
                        var e = $.Deferred();
                        return window.gapi.load("auth2", function() {
                            e.resolve()
                        }), e.promise()
                    })
                }().then(function() {
                    return e = window.gapi.auth2.init({
                        client_id: window.globals.googleLoginClientId,
                        cookiepolicy: "single_host_origin"
                    })
                })
        }

        function n(e, t) {
            var a = {
                idToken: e,
                isLayerSignup: t
            };
            return $.get("/auth/google/signup", a)
        }
        return {
            registerEvents: function() {
                $(document.body).on("click", ".app-google-login", function() {
                    t().then(function(e) {
                        if (e.success) {
                            var t = $("input[name=urlR]").val();
                            window.location = t || "/tools/Main"
                        } else if (e.signup) n(e.idToken).then(function(e) {
                            $("#app-signup-layer-content").html(e)
                        });
                        else if (e.message) alert(e.message)
                    })
                }), $(document.body).on("click", ".app-google-layer-login", function() {
                    t().then(function(e) {
                        if (e.success) common_doLoginOkAction();
                        else if (e.signup) n(e.idToken, !0).then(function(e) {
                            $("#app-signup-layer-content").html(e)
                        });
                        else if (e.message) alert(e.message)
                    })
                })
            },
            registerMobileEvents: function() {
                $(document.body).on("click", ".app-google-login", function() {
                    switch ($(this).data("platform")) {
                        case "ios":
                        case "ios10":
                            iOSAppUsersProxyGoogleLogin();
                            break;
                        case "android":
                            androidAppUsersProxy.googleLogin();
                            break;
                        default:
                            t().then(function(e) {
                                if (e.success) window.location = "/tools/Main";
                                else if (e.signup) window.location = "/auth/google/signup?idToken=" + e.idToken;
                                else if (e.message) alert(e.message)
                            })
                    }
                }), $(document.body).on("click", ".app-google-layer-login", function() {
                    switch ($(this).data("platform")) {
                        case "ios":
                        case "ios10":
                            iOSAppUsersProxyGoogleLogin();
                            break;
                        case "android":
                            androidAppUsersProxy.googleLogin();
                            break;
                        default:
                            t().then(function(e) {
                                if (e.success) modal.close(), document.onLoginOk(), $(".app-mobile-user-menu-box").html(e.headerHtml);
                                else if (e.signup) window.location = "/auth/google/signup?idToken=" + e.idToken;
                                else if (e.message) alert(e.message)
                            })
                    }
                })
            },
            login: t,
            init: i,
            link: function() {
                if (window.globals.googleLoginClientId) return a().then(function(e) {
                    return $.post("/auth/google/link", {
                        idToken: e
                    })
                })
            },
            getCurrentUser: function() {
                if (e.isSignedIn.get()) return e.currentUser.get().getBasicProfile();
                else return {}
            }
        }
    }(),
    modal, scrollPosition;
! function(m) {
    m.modal = function(e) {
        var r = {
                url: null,
                urlForm: null,
                origen: "",
                rol: "",
                inputs: {},
                ajaxParams: {},
                backdrop: !1,
                template: "default",
                autoShow: !0,
                title: "",
                html: "",
                focus: !0,
                closeButton: !0,
                modalClass: "",
                callback: function() {},
                onClose: function() {},
                onBeforeClose: function() {}
            },
            s = {},
            l = this,
            c = null,
            d = null,
            p = m(document.body),
            u = "";
        return l.open = function() {
            if (c.fadeIn(), s.focus) setTimeout(function() {
                c.find("input:first").focus()
            }, 200);
            c.trigger("show.bodas.modal")
        }, l.getModal = function() {
            return c
        }, l.getDefaultTemplate = function() {
            var e = "";
            if (s.title) e = '<div class="modal-header">' + u, e += '<p class="title">' + s.title + "</p>", e += "</div>";
            else e = u;
            return '<div class="modal-layer-wrapper">' + e + '       <div class="app-modal-content" />   </div>'
        }, l.getSuggestTemplate = function() {
            return '<div class="modal-layer-wrapper">       <div class="modal-header modal-header-suggest">' + u + '           <p class="title">' + s.title + '</p>           <input type="text">       </div>   </div>   <div class="modal-layer-wrapper">       <div class="suggest-results app-modal-content">           <ul class="panel-list app-mobile-modal-results" />       </div>   </div>'
        }, l.getCroppieProfileTemplate = function() {
            var e = 'Do not crop',
                t = "",
                a = "";
            if ("my-wedding" === s.origen || "invitations" === s.origen) t = '<input type="hidden" id="rol" name="rol" value="' + s.rol + '">';
            var i = '<div class="pure-u-1 mt20"><span data-dismiss="modal" aria-hidden="true" class="pointer color-grey app-croppie-no-crop-upload-button pointer">' + e + "</span></div>";
            if ("owners" === s.origen) i = "";
            return m.each(s.inputs, function(e, t) {
                a += '<input type="hidden" id="' + e + '" name="' + e + '" value="' + t + '">'
            }), '<div class="app-croppie-container modal-dialog modal-layer-croppie">       <div class="modal-content">           <div class="modal-header">' + u + '               <h2 id="tool-modal-header">' + s.title + '</h2>           </div>           <div class="modal-body">               <div class="pb30 text-center">                   <form id="imageCroppie" name="imageCroppie" action="' + s.urlForm + '" method="POST">                       <input type="hidden" id="origen" name="origen" value="' + s.origen + '">' + a + t + '                       <div class="app-croppie-preview com-perfil-croppie model"></div>                       <button type="button" class="pure-u-1-3 app-croppie-upload-button btn-outline outline-red">' + 'Crop' + "</button>" + i + "                   </form>               </div>           </div>       </div>   </div>"
        }, l.getOwnersTemplate = function() {
            'Do not crop';
            return '<div class="modal-dialog modal-layer-croppie modal-layer-owners">       <div class="modal-content">           <div class="modal-header">' + u + '               <h2 id="tool-modal-header">' + s.title + '</h2>           </div>           <div class="modal-body">               <div class="pb30 text-center">                   <form id="imageCroppie" name="imageCroppie" action="' + s.urlForm + '" method="POST">                       <input type="hidden" id="fname" name="fname" value="' + s.fname + '">                       <input type="hidden" id="origen" name="origen" value="' + s.origen + '">                       <div class="app-croppie-preview com-perfil-croppie model"></div>                       <button type="button" class="pure-u-1-3 app-submit-img-owners btn-outline outline-red">' + 'Crop' + "</button>                   </form>               </div>           </div>       </div>   </div>"
        }, l.getFullScreenTemplate = function() {
            return '<div class="modal-layer-fullscreen">       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icon icon-close" aria-hidden="true"></i></button>       <div class="modal-full-content app-modal-content">       </div>   </div>'
        }, l.close = function() {
            if (s.onBeforeClose(), p.attr("style", "position:initial;height:initial;width:initial;"), p.scrollTop(scrollPosition, 10), p.removeClass("modal-open"), s.backdrop) p.find(".modal-backdrop[data-modal-id='" + s.modalId + "']").remove();
            c.remove(), s.onClose()
        }, l.init = function(e) {
            scrollPosition = p.scrollTop(), e = "function" == typeof s ? {
                callback: e
            } : e, (s = m.extend({}, r, e || {})).modalId = (new Date).getTime() + "-" + Math.floor(9999 * Math.random());
            var t = m(".app-mobile-modal");
            if (t.length) t.remove();
            if (s.closeButton) u = '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            var a = "";
            if (s.backdrop) {
                var i = m(".modal:visible").css("z-index"),
                    n = "";
                if (i && i < 1099) n = "z-index:" + (+i + 1);
                a = '<div class="modal-backdrop fade in" data-modal-id="' + s.modalId + '" style="' + n + '"></div>'
            }
            c = m('<div class="modal modal-' + s.template + " app-mobile-modal " + s.modalClass + '" style="' + n + '1"></div>'), p.append(c), p.append(a);
            switch (s.template) {
                case "fullscreen":
                    c.html(l.getFullScreenTemplate());
                    break;
                case "croppie":
                    c.html(l.getCroppieProfileTemplate());
                    break;
                case "owners":
                    c.html(l.getOwnersTemplate());
                    break;
                default:
                    c.html(l.getDefaultTemplate())
            }
            if (d = c.find(".app-modal-content"), s.closeButton) c.find("button:first").on("click", function() {
                l.close()
            });
            if (s.backdrop) p.on("click.backdrop", function(e) {
                if ("static" !== s.backdrop) {
                    var t = s.template;
                    if (!t || "default" == t) t = "wrapper";
                    var a = p.find(".modal-layer-" + t);
                    if ("croppie" !== t && !a.is(e.target) && 0 === a.has(e.target).length) l.close(), p.off("click.backdrop")
                }
            });
            if (p.attr("style", "position:fixed;width:100%;height:" + m(window).height() + "px"), s.url) d.load(s.url, s.ajaxParams, function() {
                s.callback()
            });
            else if (s.html) {
                var o = m("<div />").addClass("wrapper wrapper--unit");
                o.html(s.html), d.html(o), s.callback()
            } else s.callback();
            if (s.autoShow) l.open();
            return l
        }, new l.init(e)
    }
}(jQuery),
function(e) {
    var t = function(s, l) {
        "use strict";
        if (l.getElementsByClassName) {
            var O, N = l.documentElement,
                F = s.Date,
                i = s.HTMLPictureElement,
                B = "addEventListener",
                j = "getAttribute",
                U = s[B],
                z = s.setTimeout,
                o = s.requestAnimationFrame || z,
                c = s.requestIdleCallback,
                H = /^picture$/i,
                n = ["load", "error", "lazyincluded", "_lazyloaded"],
                a = {},
                V = Array.prototype.forEach,
                G = function(e, t) {
                    return a[t] || (a[t] = new RegExp("(\\s|^)" + t + "(\\s|$)")), a[t].test(e[j]("class") || "") && a[t]
                },
                q = function(e, t) {
                    G(e, t) || e.setAttribute("class", (e[j]("class") || "").trim() + " " + t)
                },
                W = function(e, t) {
                    var a;
                    (a = G(e, t)) && e.setAttribute("class", (e[j]("class") || "").replace(a, " "))
                },
                Y = function(t, a, e) {
                    var i = e ? B : "removeEventListener";
                    e && Y(t, a), n.forEach(function(e) {
                        t[i](e, a)
                    })
                },
                J = function(e, t, a, i, n) {
                    var o = l.createEvent("CustomEvent");
                    return o.initCustomEvent(t, !i, !n, a || {}), e.dispatchEvent(o), o
                },
                Q = function(e, t) {
                    var a;
                    !i && (a = s.picturefill || O.pf) ? a({
                        reevaluate: !0,
                        elements: [e]
                    }) : t && t.src && (e.src = t.src)
                },
                X = function(e, t) {
                    return (getComputedStyle(e, null) || {})[t]
                },
                r = function(e, t, a) {
                    for (a = a || e.offsetWidth; a < O.minSize && t && !e._lazysizesWidth;) a = t.offsetWidth, t = t.parentNode;
                    return a
                },
                K = function() {
                    var t, a, i = [],
                        n = function() {
                            var e;
                            for (t = !0, a = !1; i.length;) e = i.shift(), e[0].apply(e[1], e[2]);
                            t = !1
                        };
                    return function(e) {
                        t ? e.apply(this, arguments) : (i.push([e, this, arguments]), a || (a = !0, (l.hidden ? z : o)(n)))
                    }
                }(),
                Z = function(a, e) {
                    return e ? function() {
                        K(a)
                    } : function() {
                        var e = this,
                            t = arguments;
                        K(function() {
                            a.apply(e, t)
                        })
                    }
                },
                ee = function(e) {
                    var a, i = 0,
                        n = 125,
                        t = 999,
                        o = t,
                        r = function() {
                            a = !1, i = F.now(), e()
                        },
                        s = c ? function() {
                            c(r, {
                                timeout: o
                            }), o !== t && (o = t)
                        } : Z(function() {
                            z(r)
                        }, !0);
                    return function(e) {
                        var t;
                        (e = e === !0) && (o = 66), a || (a = !0, t = n - (F.now() - i), 0 > t && (t = 0), e || 9 > t && c ? s() : z(s, t))
                    }
                },
                te = function(e) {
                    var t, a, i = 99,
                        n = function() {
                            t = null, e()
                        },
                        o = function() {
                            var e = F.now() - a;
                            i > e ? z(o, i - e) : (c || n)(n)
                        };
                    return function() {
                        a = F.now(), t || (t = z(o, i))
                    }
                },
                e = function() {
                    var c, d, p, u, m, t, f, h, g, v, b, $, _, y, w, o = /^img$/i,
                        C = /^iframe$/i,
                        k = "onscroll" in s && !/glebot/.test(navigator.userAgent),
                        x = 0,
                        S = 0,
                        T = 0,
                        A = 0,
                        I = function(e) {
                            T--, e && e.target && Y(e.target, I), (!e || 0 > T || !e.target) && (T = 0)
                        },
                        P = function(e, t) {
                            var a, i = e,
                                n = "hidden" == X(l.body, "visibility") || "hidden" != X(e, "visibility");
                            for (g -= t, $ += t, v -= t, b += t; n && (i = i.offsetParent) && i != l.body && i != N;) n = (X(i, "opacity") || 1) > 0, n && "visible" != X(i, "overflow") && (a = i.getBoundingClientRect(), n = b > a.left && v < a.right && $ > a.top - 1 && g < a.bottom + 1);
                            return n
                        },
                        e = function() {
                            var e, t, a, i, n, o, r, s, l;
                            if ((m = O.loadMode) && 8 > T && (e = c.length)) {
                                t = 0, A++, null == y && ("expand" in O || (O.expand = N.clientHeight > 500 ? 500 : 400), _ = O.expand, y = _ * O.expFactor), y > S && 1 > T && A > 3 && m > 2 ? (S = y, A = 0) : S = m > 1 && A > 2 && 6 > T ? _ : x;
                                for (; e > t; t++)
                                    if (c[t] && !c[t]._lazyRace)
                                        if (k)
                                            if ((s = c[t][j]("data-expand")) && (o = 1 * s) || (o = S), l !== o && (f = innerWidth + o * w, h = innerHeight + o, r = -1 * o, l = o), a = c[t].getBoundingClientRect(), ($ = a.bottom) >= r && (g = a.top) <= h && (b = a.right) >= r * w && (v = a.left) <= f && ($ || b || v || g) && (p && 3 > T && !s && (3 > m || 4 > A) || P(c[t], o))) {
                                                if (L(c[t]), n = !0, T > 9) break
                                            } else !n && p && !i && 4 > T && 4 > A && m > 2 && (d[0] || O.preloadAfterLoad) && (d[0] || !s && ($ || b || v || g || "auto" != c[t][j](O.sizesAttr))) && (i = d[0] || c[t]);
                                else L(c[t]);
                                i && !n && L(i)
                            }
                        },
                        a = ee(e),
                        E = function(e) {
                            q(e.target, O.loadedClass), W(e.target, O.loadingClass), Y(e.target, R)
                        },
                        i = Z(E),
                        R = function(e) {
                            i({
                                target: e.target
                            })
                        },
                        M = function(t, a) {
                            try {
                                t.contentWindow.location.replace(a)
                            } catch (e) {
                                t.src = a
                            }
                        },
                        D = function(e) {
                            var t, a, i = e[j](O.srcsetAttr);
                            (t = O.customMedia[e[j]("data-media") || e[j]("media")]) && e.setAttribute("media", t), i && e.setAttribute("srcset", i), t && (a = e.parentNode, a.insertBefore(e.cloneNode(), e), a.removeChild(e))
                        },
                        r = Z(function(e, t, a, i, n) {
                            var o, r, s, l, c, d;
                            (c = J(e, "lazybeforeunveil", t)).defaultPrevented || (i && (a ? q(e, O.autosizesClass) : e.setAttribute("sizes", i)), r = e[j](O.srcsetAttr), o = e[j](O.srcAttr), n && (s = e.parentNode, l = s && H.test(s.nodeName || "")), d = t.firesLoad || "src" in e && (r || o || l), c = {
                                target: e
                            }, d && (Y(e, I, !0), clearTimeout(u), u = z(I, 2500), q(e, O.loadingClass), Y(e, R, !0)), l && V.call(s.getElementsByTagName("source"), D), r ? e.setAttribute("srcset", r) : o && !l && (C.test(e.nodeName) ? M(e, o) : e.src = o), (r || l) && Q(e, {
                                src: o
                            })), K(function() {
                                e._lazyRace && delete e._lazyRace, W(e, O.lazyClass), (!d || e.complete) && (d ? I(c) : T--, E(c))
                            })
                        }),
                        L = function(e) {
                            var t, a = o.test(e.nodeName),
                                i = a && (e[j](O.sizesAttr) || e[j]("sizes")),
                                n = "auto" == i;
                            (!n && p || !a || !e.src && !e.srcset || e.complete || G(e, O.errorClass)) && (t = J(e, "lazyunveilread").detail, n && ae.updateElem(e, !0, e.offsetWidth), e._lazyRace = !0, T++, r(e, t, n, i, a))
                        },
                        n = function() {
                            if (!p) {
                                if (F.now() - t < 999) return void z(n, 999);
                                var e = te(function() {
                                    O.loadMode = 3, a()
                                });
                                p = !0, O.loadMode = 3, a(), U("scroll", function() {
                                    3 == O.loadMode && (O.loadMode = 2), e()
                                }, !0)
                            }
                        };
                    return {
                        _: function() {
                            t = F.now(), c = l.getElementsByClassName(O.lazyClass), d = l.getElementsByClassName(O.lazyClass + " " + O.preloadClass), w = O.hFac, U("scroll", a, !0), U("resize", a, !0), s.MutationObserver ? new MutationObserver(a).observe(N, {
                                childList: !0,
                                subtree: !0,
                                attributes: !0
                            }) : (N[B]("DOMNodeInserted", a, !0), N[B]("DOMAttrModified", a, !0), setInterval(a, 999)), U("hashchange", a, !0), ["focus", "mouseover", "click", "load", "transitionend", "animationend", "webkitAnimationEnd"].forEach(function(e) {
                                l[B](e, a, !0)
                            }), /d$|^c/.test(l.readyState) ? n() : (U("load", n), l[B]("DOMContentLoaded", a), z(n, 2e4)), a(c.length > 0)
                        },
                        checkElems: a,
                        unveil: L
                    }
                }(),
                ae = function() {
                    var a, o = Z(function(e, t, a, i) {
                            var n, o, r;
                            if (e._lazysizesWidth = i, i += "px", e.setAttribute("sizes", i), H.test(t.nodeName || ""))
                                for (n = t.getElementsByTagName("source"), o = 0, r = n.length; r > o; o++) n[o].setAttribute("sizes", i);
                            a.detail.dataAttr || Q(e, a.detail)
                        }),
                        i = function(e, t, a) {
                            var i, n = e.parentNode;
                            n && (a = r(e, n, a), i = J(e, "lazybeforesizes", {
                                width: a,
                                dataAttr: !!t
                            }), i.defaultPrevented || (a = i.detail.width, a && a !== e._lazysizesWidth && o(e, n, i, a)))
                        },
                        e = function() {
                            var e, t = a.length;
                            if (t)
                                for (e = 0; t > e; e++) i(a[e])
                        },
                        t = te(e);
                    return {
                        _: function() {
                            a = l.getElementsByClassName(O.autosizesClass), U("resize", t)
                        },
                        checkElems: t,
                        updateElem: i
                    }
                }(),
                d = function() {
                    d.i || (d.i = !0, ae._(), e._())
                };
            return function() {
                var e, t = {
                    lazyClass: "lazyload",
                    loadedClass: "lazyloaded",
                    loadingClass: "lazyloading",
                    preloadClass: "lazypreload",
                    errorClass: "lazyerror",
                    autosizesClass: "lazyautosizes",
                    srcAttr: "data-src",
                    srcsetAttr: "data-srcset",
                    sizesAttr: "data-sizes",
                    minSize: 40,
                    customMedia: {},
                    init: !0,
                    expFactor: 1.5,
                    hFac: .8,
                    loadMode: 2
                };
                O = s.lazySizesConfig || s.lazysizesConfig || {};
                for (e in t) e in O || (O[e] = t[e]);
                s.lazySizesConfig = O, z(function() {
                    O.init && d()
                })
            }(), {
                cfg: O,
                autoSizer: ae,
                loader: e,
                init: d,
                uP: Q,
                aC: q,
                rC: W,
                hC: G,
                fire: J,
                gW: r,
                rAF: K
            }
        }
    }(e, e.document);
    e.lazySizes = t, "object" == typeof module && module.exports && (module.exports = t)
}(window);
var PusherManager = function() {
    var o, r, s, l, c, d, p, u, m = null,
        f = !1,
        h = null,
        g = null,
        e = 9e5,
        v = !1,
        b = !1,
        _ = !1,
        y = !1,
        t = !1,
        n = !1,
        w = !1,
        C = !1,
        k = !1,
        x = !1,
        S = !1,
        T = !1,
        A = !1,
        I = !1,
        P = !1,
        a = null,
        E = null,
        R = null,
        M = !1,
        D = 1,
        L = !1,
        O = !1,
        N = null,
        F = !1,
        B = !1,
        j = !1,
        U = null,
        z = null,
        H = "CONCIERGE_TS_MC",
        V = 1;

    function G(e, t) {
        if (null == o) return $.when();
        o.disconnect(), $("#app-chat-container").html("");
        var a = JSON.parse(e);
        if (r = t || !1) Pusher.log = function(e) {
            if (window.console && window.console.log) window.console.log(e)
        };
        if ((o = new Pusher(globals.Request_Pusher_Key, {
                authEndpoint: "/pusher/pusherAuth.php",
                cluster: globals.Request_Pusher_Cluster,
                encrypted: !0
            })).connection.bind("connected", function() {
                m = o.connection.socket_id
            }), "user" == a.type) s = parseInt(a.id), a.name, a.avatar, a.avatarSvg, Q(), p = "user", u = s;
        if ("vendor" == a.type) l = parseInt(a.id), a.name, a.avatar, X(), p = "vendor", u = l;
        if ("anonymous" == a.type) {
            if ("concierge-vendor" === R.get("pusher-fromType")) SetCookieSession("PUSHER", 1);
            c = GuidManager.init(), a.name, a.avatar, Z(), p = "anonymous", u = c
        }
        if ("anonymous-vendor" == a.type) {
            if ("concierge" === R.get("pusher-fromType")) SetCookieSession("PUSHER", 1);
            c = GuidManager.init(), a.name, a.avatar, K(), p = "anonymous-vendor", u = c
        }
        return common_flushLocalStorage(), ge()
    }

    function q() {
        if (!f)
            if ("anonymous" == p || "user" == p) $.ajax({
                type: "POST",
                url: "/pusher/pusherConcierge.php",
                data: {
                    type: p,
                    idItem: u,
                    url: document.location.href
                },
                success: function(e) {
                    if (e.trigger) {
                        h = oe(e.concierge), fe(e.concierge), ce(e.concierge, !1, e.showGlobe, !0), ne(ee() + 1, e.showGlobe, !0),
                            function(e, t, a) {
                                if (e = e.replace(/(<([^>]+)>)/gi, ""), 105 < (e = $("<textarea />").html(e).text()).length) e = e.substring(0, 105) + "...";
                                if (b) androidAppUsersProxy.appTriggerPusher(e, t, a);
                                else if (_) action = "PUSHER_TRIGGER", data = window.btoa(JSON.stringify({
                                    message: e,
                                    avatar: t,
                                    showGlobe: a
                                })), iOSAppUsersProxyCommon(action + "|" + data + "|||")
                            }(e.concierge.body, e.concierge.actor.avatar, e.showGlobe), t = !0
                    } else xe(), t = !1
                }
            });
            else $.ajax({
                type: "POST",
                url: "/pusher/pusherConciergeVendor.php",
                data: {
                    type: p,
                    idItem: u,
                    url: document.location.href
                },
                success: function(e) {
                    if (e.trigger) {
                        if (h = oe(e.concierge), 0 == e.lastConversation.length) {
                            fe(e.concierge), ce(e.concierge, !1, e.showGlobe, !0);
                            var t = 1,
                                a = !0
                        } else {
                            te(e.numPending);
                            t = e.numPending, a = !1;
                            e.lastConversation.forEach(function(e, t) {
                                if (e.fromId == u && e.fromType == p) ue(e, !0);
                                else ce(e, !0)
                            })
                        }
                        ne(t, e.showGlobe, a)
                    }
                }
            })
    }

    function W(e) {
        z = e
    }

    function Y() {
        E = window.setTimeout(function() {
            o.disconnect(), $("#app-chat-container").hide(),
                function() {
                    if (b) androidAppUsersProxy.appDeactivatePusher();
                    else if (_) action = "PUSHER_DEACTIVATE", iOSAppUsersProxyCommon(action + "||||")
                }()
        }, e)
    }

    function J() {
        if (null !== E) window.clearTimeout(E);
        Y()
    }

    function Q() {
        var e = o.subscribe("private-user-" + s);
        if (!T) e.bind("message", function(e) {
            if (!v) $.titleAlert("-> " + e.body.replace(/(<([^>]+)>)/gi, ""), {
                stopOnFocus: !0,
                duration: 0,
                interval: 500
            });
            var t = oe(e);
            if (null == ie()) h = t, ve(e.idConversation, h, "minimized").then(function() {
                pe(t, !1), B = !1, ke("minimized", e.actor.avatar, ee(), e.idConversation), Se(e.body, ee(), e.idConversation)
            });
            else if ("open" == ie() && h && $(h).data("idconversation") == e.idConversation) ce(e), Se(e.body, ee(), e.idConversation);
            else h = t, ve(e.idConversation, h, ie()).then(function() {
                if ("minimized" == ie() || "hidden" == ie()) pe(t, !1);
                if ("hidden" == ie()) $(".app-chat-launcher", h).show(), B = !1, ke("minimized", e.actor.avatar, ee(), e.idConversation), ae("minimized");
                Se(e.body, ee(), e.idConversation), we()
            });
            J()
        }), e.bind("update", function(e) {
            var t = "app-" + e.toType + "-" + e.toId,
                a = $("#" + t, "#app-chat-container");
            if ($(a).length) ue(e)
        }), e.bind("status", function(e) {
            if ("writing" === e.status && z === e.idConversation) le()
        });
        if (!A && !k) e.bind("lead", function(e) {
            ! function(e) {
                var t = e.url,
                    a = e.text,
                    i = e.idLead,
                    n = Boolean(e.increaseCounter);
                if (v) common_app_notification_users_callback(a, t, i, !0, n, k, e);
                else {
                    var o = "<p>" + 'You have a new message' + "</p><p>" + 'Don\'t forget to read it!' + "</p>",
                        r = $("#app-pusher-vendors-users-notification-alert");
                    if (0 < $(".app-users-solicitudes-response-form").length && $("input[name=id_solicitud]", ".app-users-solicitudes-response-form").val() == i || 0 == $(".app-users-solicitudes-response-form").length && 0 < $(".app-users-solicitud-" + i).length) {
                        if (e.actor.avatar) e.actorImgUrl = e.actor.avatar;
                        desktop_showPushNotification(r, Ae(o, e.actorImgUrl, e.numUnreadMsgLead, e.actorAvatarSvg, t)), $.ajax({
                            url: "/tools/VendorsSolicAjaxRefresh?idSolicitud=" + i,
                            cache: !1,
                            success: function(e) {
                                var t = $(".app-sol-reply:first");
                                $(e).insertBefore(t).hide().slideToggle("slow"), $.titleAlert("-> " + a.replace(/(<([^>]+)>)/gi, ""), {
                                    stopOnFocus: !0,
                                    duration: 0,
                                    interval: 500
                                }), we()
                            }
                        })
                    } else {
                        if (o = _s('You have a new message from %s.', e.actorName) + ' <span class="link">' + 'Read message' + "</span>", e.text) o = e.text + ' <span class="link">' + 'Read message' + "</span>";
                        if (e.actor.avatar) e.actorImgUrl = e.actor.avatar;
                        if (desktop_showPushNotification(r, Ae(o, e.actorImgUrl, e.numUnreadMsgLead, e.actorAvatarSvg, t)), n) {
                            Ie($(".header-joined-inbox"))
                        }
                        we(),
                            function(e, t, a) {
                                if (void 0 === t) t = "lead";
                                var i = $("#mesaje" + e);
                                if ("lead" == t) {
                                    if (0 < i.length) {
                                        var n = i.find(".inboxMessage__nameBlock").find('span[class!="inboxMessage__nameBlockVendor"]'),
                                            o = "";
                                        if (!n.length) o = "(1)";
                                        else o = n.html();
                                        var r = o.substr(1);
                                        if (!(r = parseInt(r.substr(0, r.length - 1))).isNaN) {
                                            if (n.length) n.html("(" + (r + 1) + ")");
                                            else i.find(".inboxMessage__nameBlock").append("<span>(" + (r + 1) + ")</span>");
                                            if (!i.hasClass("inboxMessage--noread")) i.addClass("inboxMessage--noread"), i.find(".inboxMessage__previewBlockTitle").addClass("inboxMessage__previewBlockTitle--noread"), i.find(".inboxMessage__previewBlockContent").addClass("inboxMessage__previewBlockContent--noread");
                                            if (a.body) i.find(".inboxMessage__previewBlockContent").html(a.body)
                                        }
                                    }
                                } else if ("read" == t)
                                    if (0 < i.length)
                                        if (i.hasClass("inboxMessage--noread")) i.removeClass("inboxMessage--noread")
                            }(i, "lead", e)
                    }
                }
            }(e)
        }), e.bind("user", function(e) {
            ! function(e) {
                var t = e.url,
                    a = e.body;
                if (v) common_app_notification_users_callback(a, t, null, !0, !0, k, e);
                else {
                    t = t.replace("https://" + globals.subdomainMobile, "https://" + globals.subdomain), desktop_showPushNotification($("#app-pusher-vendors-users-notification-alert"), '<div class="newMessageAlert app-link" data-href="' + t + '"><div class="newMessageAlert__content">' + a + "</div></div>"), Ie($(".header-joined-inbox")), we()
                }
            }(e)
        })
    }

    function X() {
        var e = o.subscribe("private-vendor-" + l);
        if (!T) e.bind("message", function(e) {
            oe(e), ce(e), J()
        }), e.bind("update", function(e) {
            var t = "app-" + e.toType + "-" + e.toId,
                a = $("#" + t, "#app-chat-container");
            if ($(a).length) ue(e)
        }), e.bind("status", function(e) {
            if ("writing" === e.status && z === e.idConversation) le()
        });
        if (!A) e.bind("lead", function(e) {
            Te(e)
        }), e.bind("adminAction", function(e) {
            Te(e)
        })
    }

    function K() {
        var e = o.subscribe("private-anonymous-vendor-" + c);
        if (!T) e.bind("message", function(e) {
            oe(e), ce(e), J()
        }), e.bind("update", function(e) {
            var t = "app-" + e.toType + "-" + e.toId,
                a = $("#" + t, "#app-chat-container");
            if ($(a).length) ue(e)
        }), e.bind("status", function(e) {
            if ("writing" === e.status && z === e.idConversation) le()
        });
        if (!A) e.bind("lead", function(e) {
            Te(e)
        }), e.bind("adminAction", function(e) {
            Te(e)
        })
    }

    function Z() {
        var e = o.subscribe("private-anonymous-" + c);
        if (!T) e.bind("message", function(e) {
            if (!v) $.titleAlert("-> " + e.body.replace(/(<([^>]+)>)/gi, ""), {
                stopOnFocus: !0,
                duration: 0,
                interval: 500
            });
            var t = oe(e);
            if (null == ie()) h = t, ve(e.idConversation, h, "minimized").then(function() {
                pe(t, !1), B = !1, ke("minimized", e.actor.avatar, ee(), e.idConversation), Se(e.body, ee(), e.idConversation)
            });
            else if ("open" == ie() && h && $(h).data("idconversation") == e.idConversation) ce(e), Se(e.body, ee(), e.idConversation);
            else h = t, ve(e.idConversation, h, ie()).then(function() {
                if ("minimized" == ie() || "hidden" == ie()) pe(t, !1);
                if ("hidden" == ie()) $(".app-chat-launcher", h).show(), B = !1, ke("minimized", e.actor.avatar, ee(), e.idConversation), ae("minimized");
                Se(e.body, ee(), e.idConversation), we()
            });
            J()
        }), e.bind("update", function(e) {
            var t = "app-" + e.toType + "-" + e.toId,
                a = $("#" + t, "#app-chat-container");
            if ($(a).length) ue(e)
        }), e.bind("status", function(e) {
            if ("writing" === e.status && z === e.idConversation) le()
        })
    }

    function ee() {
        var e = 0;
        if (M)
            if (null == (e = R.get("pusher-pending"))) e = 0;
        return e
    }

    function te(e) {
        if (M) R.set("pusher-pending", e)
    }

    function ae(e) {
        if (M) R.set("pusher-status", e);
        J()
    }

    function ie() {
        var e = null;
        if (M) e = R.get("pusher-status");
        return e
    }

    function ne(e, t, a) {
        if (t = void 0 !== t ? t : !0, a = void 0 !== a ? a : !1, h && "hidden" == !ie()) $(".app-chat-launcher", h).show();
        var i = $(".app-chat-num-messages"),
            n = $(".app-chat-num-messages", ".app-chat-conversation"),
            o = $(".app-chat-num-messages", ".app-chat-launcher");
        if ($(i).removeClass("bounce-once"), a) {
            if ($(o).html(e).show(), t) $(o).addClass("bounce-once");
            if (1 == e) $(n).html("").hide();
            else if ($(n).html(e - 1).show(), t) $(n).addClass("bounce-once")
        } else if (0 == e) $(i).html("").hide();
        else if ($(i).html(e).show(), t) $(i).addClass("bounce-once")
    }

    function oe(e) {
        var t = $("#app-chat-container"),
            a = t.find("#app-" + e.fromType + "-" + e.fromId);
        if (a.length) return a;
        pendigTotal = ee(), status = ie();
        var i, n = "";
        if ("close" == status || "hidden" == status) n = " dnone";
        if (b || _) i = j;
        else if (void 0 !== s) i = !0;
        else i = v;
        if (t.append('<div id="app-' + e.fromType + "-" + e.fromId + '" data-fromtype="' + e.fromType + '" data-fromid="' + e.fromId + '" data-idconversation="' + e.idConversation + '" class="app-chat-container-top">    <div class="chat-launcher app-chat-launcher' + n + '">        <div class="chat-launcher-button' + (P ? " chat-launcher-button--bottom" : "") + '">            <img class="app-chat-avatar" src="' + e.actor.avatar + '" />            <span class="app-chat-num-messages chat-message-count dnone">' + pendigTotal + '</span>        </div>        <div class="chat-launcher-preview">            <div class="app-conversation-summary">            </div>        </div>   </div>   <div class="chat-conversation app-chat-conversation">      <div class="chat-header">          <div class="app-controls-menu chat-controls chat-controls-left">' + (F ? ' <div class="chat-control-btn app-chat-menu">' : '<div class="">') + (F ? ' <span class="chat-ui chat-menu"></span>' : "") + (F ? ' <span class="app-chat-num-messages chat-message-count">' + pendigTotal + "</span>" : "") + '              </div>          </div>          <span class="app-chat-name chat-name">' + e.actor.name + '</span>          <div class="chat-controls chat-controls-right">              <span class="chat-control-btn app-chat-min "><span class="chat-ui chat-min"></span></span>' + (i ? ' <span class="chat-control-btn app-chat-close"><span class="chat-ui chat-close"></span></span>' : "") + '          </div>      </div>      <div class="app-chat-history chat-history">          <div class="app-chat-conversations chat-messages"></div>      </div>      <div class="app-conversation-parts app-mobile-nel-scrollfix chat-messages app-scroll-calculate"></div>      <div class="composer-container chat-message-send">          <div class="app-chat-writing-alert">' + '%s is writing...'.replace("%s", e.actor.name) + '</div>          <form method="POST" class="app-chat-form-' + e.fromType + '" data-type="' + p + '" data-id="' + u + '">              <div class="composer-textarea-container">                  <textarea class="app-no-tiny" name="comment" placeholder="' + 'Write your message...' + '"></textarea>' + (v ? '     <div class="chat-submit"> <span class="app-chat-form-submit btn btn-primary">' + 'Send' + "</span> </div>" : "") + "              </div>" + (!v ? '<div class="app-chat-hint chat-send-hint">' + 'Press enter to send the message' + "</div>" : "") + "          </form>      </div>   </div></div>"), v) enableNelScrollFix();
        return function(a) {
            var e = $(".app-chat-conversation", a);
            $(".app-conversation-parts", a);
            status = ie(), $(".app-chat-launcher", a).on("click", function() {
                if ($(this).css("display", "none").removeClass("init"), v && !_) re();
                if ($(".app-chat-conversation", a).addClass("active"), $(".app-chat-num-messages", a).parent().removeClass("fadein").removeClass("fadeout"), !v) $(".app-chat-conversation", a).find("textarea").focus();
                ye({
                    id: null,
                    idConversation: $(a).data("idconversation"),
                    toType: p,
                    toId: u
                }), Ce(e), ae("open")
            }), $(".app-chat-min", a).on("click", function() {
                if (0 < $(".app-conversation-parts").find(".message-outcome").length) Ee();

                function e() {
                    if ($(".app-chat-conversation", a).removeClass("active"), $(".app-chat-launcher", a).removeClass("init").css("display", "block"), $(".app-conversation-summary", a).html().trim())
                        if (v) $(".app-conversation-summary", a).parent().removeClass("fadein").addClass("fadeout");
                        else $(".app-conversation-summary", a).parent().removeClass("fadeout").addClass("fadein");
                    else $(".app-conversation-summary", a).parent().removeClass("fadein").addClass("fadeout")
                }
                if (w) setTimeout(e, 300);
                else e();
                if (v) se();
                ae("minimized"), $(".app-conversation-summary", a).parent().removeClass("fadeout"),
                    function() {
                        if (b)
                            if (k) androidAppUsersProxy.appMinimizePusher(ee(), x);
                            else androidAppUsersProxy.appMinimizePusher(ee());
                        else if (_) action = "PUSHER_MINIMIZE", data = window.btoa(JSON.stringify({
                            numPendingMessages: ee(),
                            hasActiveConversations: x
                        })), iOSAppUsersProxyCommon(action + "|" + data + "|||")
                    }()
            }), $(".app-chat-close", a).on("click", function() {
                function e() {
                    $(".app-chat-conversation", a).fadeOut("fast", function() {
                        $(".app-chat-conversation", a).removeClass("active").show(), $(".app-chat-launcher", a).hide(), $(".app-chat-history", a).removeClass("active"), $(".app-chat-conversations", a).html("")
                    })
                }
                if (w) setTimeout(e, 300);
                else e();
                if (Pe(), v) se();
                if (ae("hidden"), j) ! function() {
                    if (b) androidAppUsersProxy.appHideAndClosePusher(ee());
                    else if (_) action = "PUSHER_HIDE_AND_CLOSE", data = window.btoa(JSON.stringify({
                        numPendingMessages: ee()
                    })), iOSAppUsersProxyCommon(action + "|" + data + "|||");
                    else if ("undefined" != typeof isUsersAppVersion && isUsersAppVersion)
                        if (isAppUsersNativePlatformIOS) action = "PUSHER_HIDE_AND_CLOSE", data = window.btoa(JSON.stringify({
                            numPendingMessages: ee()
                        })), iOSAppUsersProxyCommon(action + "|" + data + "|||");
                        else androidAppUsersProxy.appHideAndClosePusher(ee())
                }();
                else xe()
            }), $(".app-chat-menu", a).on("click", function() {
                var e = $(a).data("fromtype"),
                    t = $(a).data("fromid");
                $.ajax({
                    type: "POST",
                    url: "/pusher/pusherMenu.php",
                    data: {
                        type: p,
                        idItem: u,
                        typeConcierge: e,
                        idConcierge: t
                    },
                    success: function(e) {
                        _e(e.menu, a), te(e.numPending), ne(e.numPending)
                    }
                })
            }), $("textarea[name='comment']", a).keyup(function(e) {
                if (13 == e.keyCode)
                    if ("" == $(this).val().trim()) $(this).val("");
                    else {
                        if (!v && common_isIOS()) document.activeElement.blur();
                        $(this).closest("form").trigger("submit")
                    }
                if (!v && !I) setTimeout(function() {
                    $(".app-chat-hint").addClass("active")
                }, 1e3), I = !0
            }), $(".app-chat-form-submit", a).on("click", function(e) {
                e.preventDefault(), e.stopPropagation();
                var t = jQuery.Event("keyup");
                t.keyCode = 13, $("textarea[name='comment']", a).trigger(t)
            })
        }(a = t.find("#app-" + e.fromType + "-" + e.fromId)), a
    }

    function re() {
        mobile_hide_menu($("#app-mobile-layer-settings"), "left", {}, !0), mobile_hide_menu($("#app-mobile-layer-user"), "right", {}, !0), $(document.body).attr("style", "overflow:hidden; position:fixed;width:100%;height:" + $(window).height() + "px"), blockFullscreen()
    }

    function se() {
        if (!$(document.body).hasClass("listener-fullscreen-page")) $(document.body).attr("style", "position:initial;height:initial;width:initial;");
        unblockFullscreen()
    }

    function le(e) {
        e = void 0 !== e ? e : !1;
        var t = $(".app-chat-writing-alert");
        if (e) {
            if (t.is(":visible")) clearTimeout(U), t.slideUp(), U = null;
            return !0
        }
        if (U) clearTimeout(U), U = null;
        else t.slideDown();
        U = setTimeout(function() {
            t.slideUp(), U = null
        }, 6e3)
    }

    function ce(e, t, a, i) {
        t = void 0 !== t ? t : !1, a = void 0 !== a ? a : !0, i = void 0 !== i ? i : !1, le(!0);
        var n = "app-" + e.fromType + "-" + e.fromId,
            o = $("#" + n, "#app-chat-container");
        if ("" == $(o).data("idconversation")) $(o).data("idconversation", e.idConversation);
        var r = !0;
        if (t || $(h).data("idconversation") == e.idConversation) {
            if (me(o, e), 0 == $(".app-conversation-parts > div", $(o)).length || $(".app-conversation-parts > div", $(o)).last().hasClass("message-outcome") || $(".app-conversation-parts > div", $(o)).last().hasClass("chat-message-welcome") || $(".app-conversation-parts > div", $(o)).last().hasClass("chat__separator")) $(".app-conversation-parts", $(o)).append('<div class="chat-message message-income">    <div class="chat-message-avatar">        <img src="' + e.actor.avatar + '" width="50" height="50" alt="' + e.actor.name + '" />    </div>    <div class="chat-message-globe">' + e.body.replace(/(?:\r\n|\r|\n)/g, "<br/>") + '        <div class="chat__timestamp">' + e.publishedTime + "</div>    </div></div>");
            else $(".app-conversation-parts", $(o)).last().append('    <div class="chat-message chat-aggregate message-income">        <div class="chat-message-globe">' + e.body.replace(/(?:\r\n|\r|\n)/g, "<br/>") + '        <div class="chat__timestamp">' + e.publishedTime + "</div>    </div></div>");
            var s = e.body.replace(/(<([^>]+)>)/gi, "");
            if (105 < s.length) s = s.substring(0, 105) + "...";
            if ($(".app-conversation-summary", $(o)).html(s), a) pe(o, t);
            if ($(".app-chat-name", $(o)).html(e.actor.name), $(".app-chat-avatar", $(o)).attr("src", e.actor.avatar), $e(o), r = !1, !t && ("open" == ie() || "minimized" == ie() || "hidden" == ie())) we()
        }
        if (null != e.numPending) te(e.numPending);
        if (!t && (r || "close" == ie() || "minimized" == ie() || "hidden" == ie())) {
            if (null != e.numPending) ne(e.numPending, a)
        } else if (!t && !i) ye(e, a)
    }

    function de(e) {
        if (v) {
            var t = $(".app-mobile-user-menu-box").find(".app-mobile-user-menu-link");
            if (0 < t.length) ! function(e, t) {
                mobile_updateUserBadge(e, t)
            }(t, e)
        } else {
            var a = $(".app-header-envelope-inbox");
            if (0 < a.length) Ie(a, e)
        }
    }

    function pe(e, t) {
        if (!t) {
            if ($(".app-conversation-summary", $(e)).parent().removeClass("fadeout").addClass("fadein"), a) clearTimeout(a);
            a = setTimeout(function() {
                $(".app-conversation-summary", $(e)).parent().removeClass("fadein").addClass("fadeout")
            }, 3e3)
        }
    }

    function ue(e, t) {
        t = void 0 !== t ? t : !1;
        var a = "app-" + e.toType + "-" + e.toId,
            i = $("#" + a, "#app-chat-container");
        me(i, e);
        var n = 0 == $(".app-conversation-parts > div", $(i)).length || $(".app-conversation-parts > div", $(i)).last().hasClass("message-income") || $(".app-conversation-parts > div", $(i)).last().hasClass("chat-message-welcome") || $(".app-conversation-parts > div", $(i)).last().hasClass("chat__separator");
        if (t || $(h).data("idconversation") == e.idConversation) $(".app-conversation-parts", $(i)).last().append('<div class="chat-message ' + (0 == n ? "chat-aggregate " : "") + 'message-outcome">    <div class="chat-message-globe">' + e.body + '        <div class="chat__timestamp">' + e.publishedTime + "</div>    </div></div>"), $e(i)
    }

    function me(e, t) {
        if (null == g || t.publishedDate != g) $(".app-conversation-parts", $(e)).append('<div class="chat__separator"><span>' + t.publishedDate + "</span></div>"), g = t.publishedDate
    }

    function fe(e) {
        var t = "app-" + e.fromType + "-" + e.fromId,
            a = $("#" + t, "#app-chat-container");
        if (1 == e.conciergeTemplate) $(".app-conversation-parts", $(a)).append('<div class="chat-message-welcome">    <p class="title">' + 'WeddingWire Support' + "</p>    <p>" + 'I\'d like to help you choose the ideal vendor for your dream wedding. Free assistance to find the best services in your area. Ask us!' + '</p>    <div class="chat-legal"><a class="app-pusher-link" href="' + globals.Request_Url_Condiciones_Legales + '#concierge">' + 'WeddingWire terms of use' + "</a></div></div>");
        else if (2 == e.conciergeTemplate) $(".app-conversation-parts", $(a)).append('<div class="chat-message-welcome">    <p class="title">' + 'HELP FOR VENDORS' + "</p>    <p>" + 'We want to help you manage your Storefront to make sure you get the most out of your presence on WeddingWire. Do you have a question? Ask us!' + '</p>    <div class="chat-legal"><a class="app-pusher-link" href="' + globals.Request_Url_Condiciones_Legales + '">' + 'WeddingWire terms of use' + "</a></div></div>")
    }

    function he(e, t) {
        if (t = void 0 !== t ? t : !0, pendigTotal = ee(), ne(pendigTotal), t) $(".app-chat-launcher", e).trigger("click")
    }

    function ge() {
        var e = $.when();
        if (M) {
            var t = R.get("pusher-idConversation"),
                a = R.get("pusher-status"),
                i = R.get("pusher-fromId"),
                n = R.get("pusher-fromType");
            if (! function(e) {
                    return Number(e) === e && e % 1 == 0
                }(t) && "close" != a) a = null, R.remove("pusher-status"), R.remove("pusher-idConversation");
            else W(t);
            if ("open" == a || "minimized" == a || "hidden" == a) {
                var o = R.get("pusher-actorName"),
                    r = R.get("pusher-actorAvatar");
                return oe({
                    idConversation: t,
                    fromType: n,
                    fromId: i,
                    type: p,
                    idItem: u,
                    actor: {
                        name: o,
                        avatar: r
                    }
                }), h = $("#app-" + n + "-" + i, "#app-chat-container"), f = !0, ve(t, h, a).then(function() {
                    ke(a, r, ee(), t)
                })
            } else if ("close" == a) {
                ! function() {
                    if (M) R.remove("pusher-idConversation");
                    W(null), h = $("#app-closed"), f = !0, status = ie();
                    var e = ee(),
                        t = $("#app-closed", "#app-chat-container");
                    if ($(t).length) return $(".app-chat-close", t).trigger("click", [{
                        notifyApp: !1
                    }]), ne(e), $(t).show();
                    if ($("#app-chat-container").append('<div id="app-closed" class="app-chat-container-top">    <div class="chat-launcher app-chat-launcher dnone">        <div class="chat-launcher-button closed' + (P ? " chat-launcher-button--bottom" : "") + '"></div>        <span class="app-chat-num-messages chat-message-count">' + e + '</span>   </div>   <div class="chat-conversation app-chat-conversation">      <div class="chat-header">          <span class="chat-name">' + 'Chats' + '</span>          <div class="chat-controls chat-controls-right">              <span class="app-chat-close chat-control-btn"><span class="chat-ui chat-close"></span></span>          </div>      </div>      <div class="app-chat-history chat-history">          <div class="app-chat-conversations chat-messages"></div>      </div>      <div class="app-conversation-parts chat-messages app-mobile-nel-scrollfix"></div>      <div class="composer-container chat-message-send">      </div>   </div></div>'), ne(e), v) enableNelScrollFix();
                    var a = $("#app-closed", "#app-chat-container");
                    $(".app-chat-launcher", a).on("click", function() {
                        if ($(this).css("display", "none").removeClass("init"), v) re();
                        $(".app-chat-conversation", a).addClass("active").find("textarea").focus(), $.ajax({
                            type: "POST",
                            url: "/pusher/pusherMenu.php",
                            data: {
                                type: p,
                                idItem: u
                            },
                            success: function(e) {
                                _e(e.menu, a), te(e.numPending), ne(e.numPending)
                            }
                        })
                    }), $(".app-chat-close", a).on("click", function(e, t) {
                        if ($(".app-chat-conversation", a).removeClass("active"), $(".app-chat-launcher", a).css("display", "block"), Pe(), v) se();
                        ae("minimized"),
                            function() {
                                if (b) androidAppUsersProxy.appClosePusher(ee());
                                else if (_) action = "PUSHER_CLOSE", data = window.btoa(JSON.stringify({
                                    numPendingMessages: ee()
                                })), iOSAppUsersProxyCommon(action + "|" + data + "|||")
                            }()
                    })
                }();
                r = R.get("pusher-actorAvatar");
                ke(a, r, ee(), null)
            }
        }
        return e
    }

    function ve(a, i, n) {
        return n = n || null, $.ajax({
            type: "POST",
            url: "/pusher/pusherHistory.php",
            data: {
                type: p,
                idItem: u,
                idConversation: a
            },
            success: function(e) {
                var t = e.numUnreadMsgUser;
                if (0 < t) de(t);
                if (D = e.statusConcierge, g = null, $(".app-conversation-parts", $(i)).html(""), 0 < e.messageDefault[0].body.length && ("anonymous" == p || "user" == p)) ce(e.messageDefault[0], !0);
                if (e.history.forEach(function(e, t) {
                        if (e.fromId == u && e.fromType == p) ue(e, !0);
                        else ce(e, !0)
                    }), te(e.numPending), ne(e.numPending), be(i, a, n), "open" == n)
                    if (w || !C) $(".app-chat-launcher", i).trigger("click")
            }
        })
    }

    function be(e, t, a) {
        if (M)
            if ($(e).data("idconversation", t), R.set("pusher-idConversation", parseInt(t)), R.set("pusher-fromId", $(e).data("fromid")), R.set("pusher-fromType", $(e).data("fromtype")), R.set("pusher-actorAvatar", $(".app-chat-avatar", e).attr("src")), R.set("pusher-actorName", $(".app-chat-name", e).html()), null != a) R.set("pusher-status", a);
        W(t)
    }

    function $e(e) {
        var t = $(".app-conversation-parts", e);
        if (t.length)
            if (_) setTimeout(function() {
                t[0].scrollTop = t[0].scrollHeight
            }, 250);
            else t[0].scrollTop = t[0].scrollHeight
    }

    function _e(e, o) {
        if ($(".app-chat-conversations", o).html(""), e.forEach(function(e, t) {
                var a = 0 == e.pendingMessages ? "dnone" : "";
                $(".app-chat-conversations", o).append('<div class="app-chat-history-conversation chat-panel chat-message message-income" data-id="' + e.id + '" data-toid="' + e.toId + '" data-totype="' + e.toType + '">    <div class="chat-message-avatar">        <img class="app-chat-avatar" src="' + e.actorAvatar + '" width="50" height="50" alt="' + e.actorName + '" />        <span class="chat-message-count ' + a + '">' + e.pendingMessages + '</span>    </div>    <div class="chat-message-info">        <span class="app-chat-name chat-message-name">' + e.actorName + '</span>        <span class="chat-message-subject">' + (e.lastMessage ? e.lastMessage : e.asunto) + '</span>        <span class="chat-message-lastmessage">' + e.fechaLastMessage + "</span>    </div></div>")
            }), F) $(".app-chat-history", o).append('<div class="app-chat-button chat-btn-new-message">    <span class="btn btn-primary btn-medium app-chat-new-conversation">        <i class="fa fa-comment-o"></i> ' + 'New chat' + "    </span></div>");
        $(".app-chat-new-conversation", o).on("click", function(e) {
            var t = "concierge",
                a = 1;
            if ("vendor" == p) t = "concierge-vendor", a = 2;
            $.ajax({
                type: "POST",
                url: "/pusher/pusherNew.php",
                data: {
                    fromType: t,
                    fromId: "admin"
                },
                success: function(e) {
                    var t = {
                        idConversation: "",
                        fromType: e.fromType,
                        fromId: e.fromId,
                        type: p,
                        idItem: u,
                        actor: e.actor,
                        conciergeTemplate: a
                    };
                    e.actor.name, N = e.actor.avatar, D = e.statusConcierge, L = !0, (h = oe(t)).data("idconversation", ""), $(".app-chat-history", o).removeClass("active"), $(".app-chat-conversations", o).html(""), $(".app-chat-button", o).remove(), $(".app-conversation-parts", h).html(""), $(".app-conversation-summary", h).html(""), $(".app-chat-launcher", h).trigger("click"), fe(t), $("#app-closed").hide(), $(".app-controls-menu").show(), $(".app-chat-min").show()
                }
            })
        }), $(".app-chat-history", o).addClass("active"), $(".app-controls-menu").hide(), $(".app-chat-min").hide(), $(".app-chat-history-conversation", o).on("click", function(e) {
            var t = $(this).data("totype"),
                a = $(this).data("toid"),
                i = $(this).data("id"),
                n = {
                    idConversation: i,
                    fromType: t,
                    fromId: a,
                    type: p,
                    idItem: u,
                    actor: {
                        name: $(".app-chat-name", this).html(),
                        avatar: $(".app-chat-avatar", this).attr("src")
                    }
                };
            n.actor.name, N = n.actor.avatar, L = !0,
                function(e, t, a) {
                    if (a = a || !1, be(t, e, "open"), a || $(t).data("idconversation") != e) return ve(e, t, "open").then(function() {
                        he(t, !1)
                    });
                    else return he(t), $.when()
                }(i, h = oe(n), !0).then(function() {
                    if ($(".app-chat-history", o).removeClass("active"), $(".app-chat-conversations", o).html(""), $(".app-chat-button", o).remove(), "app-closed" == $(o).attr("id")) $(".app-chat-conversation", o).removeClass("active"), $(".app-chat-launcher", o).show();
                    $("#app-closed").hide(), $(".app-controls-menu").show(), $(".app-chat-min").show()
                })
        })
    }

    function ye(e, t) {
        t = void 0 !== t ? t : !0, $.ajax({
            type: "POST",
            url: "/pusher/pusherMarkAsRead.php",
            data: {
                idMessage: e.id,
                type: e.toType,
                idItem: e.toId,
                idConversation: e.idConversation
            },
            success: function(e) {
                if (null != e.numPending) te(e.numPending), ne(e.numPending, t),
                    function(a) {
                        $.ajax({
                            type: "GET",
                            url: "/utils-HeaderUnreadedMessagesAjax.php",
                            success: function(e) {
                                var t;
                                if (null != e.numUnread) t = parseInt(e.numUnread);
                                else t = parseInt(a);
                                de(t)
                            }
                        })
                    }(e.numPending)
            }
        })
    }

    function we() {
        if (!b && !_) {
            var e = new Audio(globals.subdomain_cdn_img + "/assets/audio/blop.wav");
            try {
                e.play()
            } catch (e) {}
        }
    }

    function Ce(e) {
        if (L && (2 == D || 3 == D || 4 == D) && 0 == $(".app-chat-warning", e).length) {
            if (2 == D || 3 == D)
                if ("vendor" == p)
                    if (O) $(e).append('<div class="app-chat-warning chat-warning">    <div class="chat-warning-content">        <span class="app-chat-warning-close chat-warning-close">&times;</span>        <img class="img-circle rounded" src="' + N + '" width="60" height="60" />        <h2 class="fs18">' + 'Sorry, I can\'t help you right now' + "</h2>        <p>" + 'Questions? Email <a href=\'mailto:support@weddingwire.ca\'>support@weddingwire.ca</a>' + "</p>    </div></div>");
                    else $(e).append('<div class="app-chat-warning chat-warning">    <div class="chat-warning-content">        <span class="app-chat-warning-close chat-warning-close">&times;</span>        <img class="img-circle rounded" src="' + N + '" width="60" height="60" />        <h2 class="fs18">' + 'Sorry, I can\'t help you right now' + "</h2>        <p>" + 'Online support service from Monday-Friday, 9am-6pm.' + "</p>        <p>" + 'Questions? Email <a href=\'mailto:support@weddingwire.ca\'>support@weddingwire.ca</a>' + "</p>    </div></div>");
            else if (O) $(e).append('<div class="app-chat-warning chat-warning">    <div class="chat-warning-content">        <img class="img-circle rounded" src="' + N + '" width="60" height="60" />        <h2 class="fs18">' + 'Sorry, I can\'t help you right now' + "</h2>        <p>" + 'Questions? Email <a href=\'mailto:support@weddingwire.ca\'>support@weddingwire.ca</a>.' + "</p>    </div></div>");
            else $(e).append('<div class="app-chat-warning chat-warning">    <div class="chat-warning-content">        <img class="img-circle rounded" src="' + N + '" width="60" height="60" />        <h2 class="fs18">' + 'Sorry, I can\'t help you right now' + "</h2>        <p>" + 'Online support service hours are from Monday to Friday from 9am to 6pm.' + "</p>        <p>" + 'Questions? Email <a href=\'mailto:support@weddingwire.ca\'>support@weddingwire.ca</a>.' + "</p>    </div></div>");
            else if ("vendor" == p) $(e).append('<div class="app-chat-warning chat-warning">    <div class="chat-warning-content">        <span class="app-chat-warning-close chat-warning-close">&times;</span>        <img class="img-circle rounded" src="' + N + '" width="60" height="60" />        <h2>' + 'Outside of operating hours' + "</h2>        <p>" + 'Sorry, I can\'t help you right now but I will be back shortly.' + "</p>        <p>" + 'Questions? Email <a href=\'mailto:support@weddingwire.ca\'>support@weddingwire.ca</a>' + "</p>    </div></div>");
            else $(e).append('<div class="app-chat-warning chat-warning">    <div class="chat-warning-content">        <img class="img-circle rounded" src="' + N + '" width="60" height="60" />        <h2>' + 'Outside of operating hours' + "</h2>        <p>" + 'Sorry, I can\'t help you right now but I will be back shortly.' + "</p>        <p>" + 'Questions? Email <a href=\'mailto:support@weddingwire.ca\'>support@weddingwire.ca</a>.' + "</p>    </div></div>");
            if ($(".app-chat-warning-close", e).on("click", function() {
                    $(this).parent().parent().remove()
                }), v) e.find(".app-conversation-parts").addClass("app-mobile-nel-scrollfix"), enableNelScrollFix();
            L = !1
        }
    }

    function ke(e, t, a, i) {
        if (n = !0, !B) {
            if (b) androidAppUsersProxy.appInitPusher(e, t, a, i);
            else if (_) action = "PUSHER_INIT", data = window.btoa(JSON.stringify({
                status: e,
                avatar: t,
                numPendingMessages: a,
                idConversation: i
            })), iOSAppUsersProxyCommon(action + "|" + data + "|||")
        } else B = !1
    }

    function xe() {
        if (b) androidAppUsersProxy.appHidePusher();
        else if (_) action = "PUSHER_HIDE", iOSAppUsersProxyCommon(action + "||||");
        else if ("undefined" != typeof isUsersAppVersion && isUsersAppVersion)
            if (isAppUsersNativePlatformIOS) action = "PUSHER_HIDE", iOSAppUsersProxyCommon(action + "||||");
            else androidAppUsersProxy.appHidePusher()
    }

    function Se(e, t, a) {
        if (e = e.replace(/(<([^>]+)>)/gi, ""), 105 < (e = $("<textarea />").html(e).text()).length) e = e.substring(0, 105) + "...";
        if (b) androidAppUsersProxy.appMessagePusher(e, t, a);
        else if (_) action = "PUSHER_MESSAGE", data = window.btoa(JSON.stringify({
            message: e,
            numPendingMessages: t,
            idConversation: a
        })), iOSAppUsersProxyCommon(action + "|" + data + "|||")
    }

    function Te(e) {
        var t, a, i = e.url,
            n = e.text,
            o = e.idLead;
        if (v) t = i.replace("https://" + globals.subdomain, "https://" + globals.subdomainMobile), mobile_vendors_notification_newLead_callback(n, t, o);
        else {
            if ("51" == globals.idProject) {
                if (i = i.replace("https://" + globals.subdomainMobile + "/vendors", "https://" + globals.subdomain + "/vendors"), "m.weddingwire.com" == globals.subdomainMobile) i = i.replace("https://app.weddingwire.com/vendors", "https://" + globals.subdomain + "/vendors")
            } else i = i.replace("https://" + globals.subdomainMobile, "https://" + globals.subdomain);
            if (t = i.replace("apps/empresas/", ""), 0 < $(".app-vendors-solicitudes-response-form").length && $("input[name=id_solicitud]", ".app-vendors-solicitudes-response-form").val() == o) {
                a = $("#app-pusher-vendors-users-notification-alert");
                var r = "<p>" + 'You have a new message' + "</p><p>" + 'Don\'t forget to read it!' + "</p>";
                if (e.actorAvatarSvg) $(a).html(Ae(r, e.actorImgUrl, e.numUnreadMsgLead, e.actorAvatarSvg, t)).fadeIn(400);
                else $(a).html(Ae(r, e.actorImgUrl, e.numUnreadMsgLead, e.actorAvatarSvg, t)).fadeIn(400);
                setTimeout(function() {
                    $(a).fadeOut("fast")
                }, 5e3), $.ajax({
                    url: "/emp-AdminSolicitudesShowAjaxRefresh.php?idSolicitud=" + o,
                    cache: !1,
                    success: function(e) {
                        var t = $(".app-sol-reply:first");
                        if ($(t).find(".tag-pending")) $(t).find(".tag-pending").remove();
                        $(".app-admin-conversation-new-msg").remove(), $(e).insertBefore(t).hide().fadeIn("slow"), we(), $.titleAlert("-> " + n.replace(/(<([^>]+)>)/gi, ""), {
                            stopOnFocus: !0,
                            duration: 0,
                            interval: 500
                        })
                    }
                })
            } else {
                a = $("#app-pusher-vendors-users-notification-alert");
                r = n;
                if (-1 == n.indexOf('Read message')) r = n + ' <span class="link">' + 'Read message' + "</span>";
                $(a).html(Ae(r, e.actorImgUrl, e.numUnreadMsgLead, e.actorAvatarSvg, t)).fadeIn(400), setTimeout(function() {
                        $(a).fadeOut("fast")
                    }, 5e3), we(),
                    function(a) {
                        $.ajax({
                            url: "/emp-AdminSolicitudesGetPendingAjax.php",
                            cache: !1,
                            success: function(e) {
                                if (e) {
                                    var t = $("#menu");
                                    if (t.length && t.hasClass("app-menu")) {
                                        if (t.find(".app-header-inbox-counter").length && "undefined" !== e && 0 < e / 1) {
                                            t.find(".app-header-inbox-counter").addClass("counter").html(e)
                                        }
                                    } else if (a.find("a").hasClass("adminNav__item"))
                                        if (0 < a.find(".app-vendors-admin-nav-item-count").length) a.find(".app-vendors-admin-nav-item-count").html(e);
                                        else a.find(".adminNav__itemIcon").append("<span class='adminNav__itemCount app-vendors-admin-nav-item-count'>1</span>");
                                    else if (0 < a.find(".vendors-admin-nav-item-count").length) a.find(".vendors-admin-nav-item-count").html(e);
                                    else a.find("a").append("<span class='vendors-admin-nav-item-count dark'>1</span>")
                                }
                            }
                        })
                    }($(".app-vendor-menu-requests")),
                    function(e, t) {
                        if (0 < $(".app-vendor-message-" + e).length) {
                            var a = $(".app-vendor-message-" + e),
                                i = a.find(".admin-home-sol-name > span, .adminHomeSol__name > span"),
                                n = i.html().substr(1);
                            if (!(n = parseInt(n.substr(0, n.length - 1))).isNaN) {
                                if (i.html("(" + (n + 1) + ")"), a.hasClass("adminHomeSol__item") && !a.hasClass("adminHomeSol__item--new")) a.addClass("adminHomeSol__item--new");
                                else if (!a.hasClass("new")) a.addClass("new");
                                if (t.body) a.find(".adminHomeSol__description").html(t.body)
                            }
                        }
                    }(o, e)
            }
        }
    }

    function Ae(e, t, a, i, n) {
        var o = function(e, t) {
                if (t) {
                    var a = $("<div></div>").append(t);
                    return a.find(".chat-message-avatar").removeClass("chat-message-avatar"), a.html()
                }
                if (e) return '<img class="newMessageAlert__image border ' + ("vendor" == p ? "avatar-thumb" : "") + '" src="' + e + '" width="56" />';
                return ""
            }(t, i),
            r = " newMessageAlert__avatar--vendor";
        if ("vendor" == p)
            if (i) r = " newMessageAlert__avatar--alias";
            else r = " newMessageAlert__avatar--user";
        return '<div class="newMessageAlert app-link" data-href="' + n + '"><div class="newMessageAlert__avatar' + r + '">' + o + '<span class="counter">' + a + '</span></div><div class="newMessageAlert__content">' + e + "</div></div>"
    }

    function Ie(e, t) {
        common_getUserNumPendingMessages(e, t)
    }

    function Pe() {
        if (0 == $(".app-conversation-parts", h).find(".message-outcome").length) bodas.setCookieTime(H, "1", V)
    }

    function Ee() {
        x = !0
    }
    return {
        init: function(e, t, a) {
            R = new window.Basil({
                namespace: "concierge",
                expireDays: 1,
                storages: ["local", "cookie"]
            }), M = R.check("local") || R.check("cookie"), d = e;
            var i = JSON.parse(e);
            if (a) v = !!a.isMobile, b = !!a.isAppAndroid, _ = !!a.isAppIos, S = !!a.forceMinimizeChat, y = !!a.isAppReferrerEnabled, !!a.chatNeedsSpecialClass, T = !!a.disableChat, A = !!a.disableUserVendorNotifications, j = !!a.appShowCloseButton, w = !!a.isAppSpecialChatPage, C = !!a.isAppBarsEnabled, P = !!a.fixedBar, k = !!a.isAppNativeApiEnabled;
            if ("CL" == globals.Request_Country) O = !0;
            if (M) {
                var n = R.get("pusher-TTL");
                if (null != n)
                    if (864e5 < Date.now() - n) R.reset();
                R.set("pusher-TTL", Date.now())
            }
            if (S && "open" == ie()) ae("minimized");
            else if (k) ae("open");
            if (r = t || !1) Pusher.log = function(e) {
                if (window.console && window.console.log) window.console.log(e)
            };
            if ((o = new Pusher(globals.Request_Pusher_Key, {
                    authEndpoint: "/pusher/pusherAuth.php",
                    cluster: globals.Request_Pusher_Cluster,
                    encrypted: !0
                })).connection.bind("connected", function() {
                    m = o.connection.socket_id
                }), Y(), "user" == i.type) s = parseInt(i.id), i.name, i.avatar, i.avatarSvg, Q(), p = "user", u = s;
            if ("vendor" == i.type) l = parseInt(i.id), i.name, i.avatar, X(), p = "vendor", u = l;
            if ("anonymous" == i.type) {
                if ("concierge-vendor" === R.get("pusher-fromType")) SetCookieSession("PUSHER", 1);
                c = GuidManager.init(), i.name, i.avatar, Z(), p = "anonymous", u = c
            }
            if ("anonymous-vendor" == i.type) {
                if ("concierge" === R.get("pusher-fromType")) SetCookieSession("PUSHER", 1);
                c = GuidManager.init(), i.name, i.avatar, K(), p = "anonymous-vendor", u = c
            }
            if (common_flushLocalStorage(), !T) ge()
        },
        reset: G,
        reload: function() {
            return n = !1, G(d, r).then(function() {
                if (!n)
                    if (t) return q(), !1;
                    else return xe(), !0;
                return !1
            })
        },
        initConcierge: q,
        initConversation: function(e, t, a, i, n) {
            if (!_ && !b || w || !C) {
                L = !0, oe({
                    idConversation: a,
                    fromType: e,
                    fromId: t,
                    type: p,
                    idItem: u,
                    actor: {
                        name: i,
                        avatar: N = n
                    }
                }), ve(a, h = $("#app-" + e + "-" + t, "#app-chat-container"), "open"), f = !0, $("#app-closed").hide(), bodas.deleteCookie(H), xe(), B = !0
            } else ! function(e, t) {
                if (b) androidAppUsersProxy.appRunJavascriptPusher(e, t);
                else if (_) action = "PUSHER_RUN_JAVASCRIPT", data = window.btoa(JSON.stringify({
                    command: e,
                    avatar: t
                })), iOSAppUsersProxyCommon(action + "|" + data + "|||")
            }("PusherManager.initConversation('" + e + "', '" + t + "', '" + a + "', '" + i + "', '" + n + "');", n)
        },
        replyChat: function(e, t) {
            var a = function() {
                    function e(e) {
                        if (e < 10) e = "0" + e;
                        return e
                    }
                    return date = new Date, dateTime = e(date.getHours()) + ":" + e(date.getMinutes()), dateTime
                }(),
                i = function() {
                    function e(e) {
                        if (e < 10) e = "0" + e;
                        return e
                    }
                    return date = new Date, dateTime = e(date.getDate()) + "/" + e(date.getMonth() + 1) + "/" + date.getFullYear(), dateTime
                }();
            if (null == g || i != g) e.append('<div class="chat__separator"><span>' + i + "</span></div>"), g = i;
            var n = t.body.replace(/</g, "&lt;").replace(/>/g, "&gt;"),
                o = 0 == $("> div", $(e)).length || $("> div", $(e)).last().hasClass("message-income") || $("> div", $(e)).last().hasClass("chat-message-welcome") || $("> div", $(e)).last().hasClass("chat__separator");
            $(e).last().append('<div class="chat-message ' + (0 == o ? "chat-aggregate " : "") + 'message-outcome">    <div class="chat-message-globe">' + n + '       <div class="chat__timestamp">' + a + "</div>    </div></div>"), $e(e.parent()), J()
        },
        getSocketId: function() {
            return m
        },
        updateConversation: function(e, t) {
            be($(e).closest(".app-chat-container-top"), t)
        },
        showContactar: function(e, t, a) {
            if (a) document.location.href = "/emp-Form.php?id_empresa=" + t + "&frmInsert=53";
            else ! function(e, t, a) {
                a = a || "post";
                var i = document.createElement("form");
                for (var n in i.setAttribute("method", a), i.setAttribute("action", e), t)
                    if (t.hasOwnProperty(n)) {
                        var o = document.createElement("input");
                        o.setAttribute("type", "hidden"), o.setAttribute("name", n), o.setAttribute("value", t[n]), i.appendChild(o)
                    }
                document.body.appendChild(i), i.submit()
            }(e, {
                showContactar: 1
            })
        },
        minimizeChat: function() {
            ae("minimized")
        },
        forzeMinimizeChat: function(e) {
            if (e = void 0 !== e ? e : !1, null != o) {
                var t = ie();
                if ("close" == t) {
                    if ($(".app-chat-conversation", "#app-closed").hasClass("active")) $(".app-chat-close", "#app-closed").trigger("click"), !0
                } else if ("open" == t) {
                    if ($(".app-chat-min:visible", "#app-concierge-admin")) $(".app-chat-min", "#app-concierge-admin").trigger("click");
                    else $(".app-chat-close", "#app-concierge-admin").trigger("click");
                    !0
                }
            }
        },
        flush: function() {
            if (M) {
                var e = R.keys();
                for (i = 0; i < e.length; i++) R.remove(e[i]), console.log(e[i])
            }
        },
        forceBottomScroll: function() {
            var e = $(".app-scroll-calculate"),
                t = $("body").height() + 120;
            e.animate({
                scrollTop: t
            }, 250)
        },
        showConcierge: function() {
            if (_ || b)
                if (!y) return !0;
                else if (0 < document.referrer.indexOf(globals.Request_Cookie_domain + "/") || !/.*--e\d+/.test(document.location.pathname)) return !0;
            else {
                if (!f || "hidden" == ie()) xe();
                return !1
            }
            return (0 < document.referrer.indexOf(globals.Request_Cookie_domain + "/") || !/.*--e\d+/.test(document.location.pathname)) && !(0 < document.location.search.indexOf("appInstall=0"))
        },
        showLayerStatusConcierge: function(e, t, a) {
            L = !0, D = t, N = a, Ce($(e).closest(".app-chat-conversation"))
        },
        openCurrentChat: function(e, t, a, i) {
            if (xe(), h && h.length) $(".app-chat-launcher", h).trigger("click");
            else {
                ! function() {
                    var e = "concierge",
                        a = 1;
                    if ("vendor" == p) e = "concierge-vendor", a = 2;
                    $.ajax({
                        type: "POST",
                        url: "/pusher/pusherNew.php",
                        data: {
                            fromType: e,
                            fromId: "admin"
                        },
                        success: function(e) {
                            var t = {
                                idConversation: "",
                                fromType: e.fromType,
                                fromId: e.fromId,
                                type: p,
                                idItem: u,
                                actor: e.actor,
                                conciergeTemplate: a
                            };
                            e.actor.name, N = e.actor.avatar, D = e.statusConcierge, L = !0, (h = oe(t)).data("idconversation", ""), $(".app-chat-history", parent).removeClass("active"), $(".app-chat-conversations", parent).html(""), $(".app-chat-button", parent).remove(), $(".app-conversation-parts", h).html(""), $(".app-conversation-summary", h).html(""), $(".app-chat-launcher", h).trigger("click"), fe(t), $("#app-closed").hide(), $(".app-controls-menu").show(), $(".app-chat-min").show()
                        }
                    })
                }()
            }
        },
        appHideBars: function() {
            if (b && !C);
            else if (_ && !C) iOSAppUsersProxyAppShowBars(0)
        },
        appInitPusher: function(e, t, a, i) {
            if (b || _) B = !1, ke(e, t, a, i)
        },
        activateConversation: Ee
    }
}();
$(document).ready(function() {
        $(document.body).on("submit", ".app-chat-form-vendor", function(e) {
            e.preventDefault();
            var a = $(this),
                t = ($(this).data("type"), $(this).data("id")),
                i = $(this).find("textarea[name='comment']"),
                n = i.val();
            return $.ajax({
                type: "POST",
                url: "/tools/VendorsSolicRun",
                data: {
                    is_mobile: 1,
                    Comentario: n,
                    id_solicitud: t,
                    socketId: PusherManager.getSocketId()
                },
                success: function(e) {},
                beforeSend: function(e) {
                    var t = {
                        body: n,
                        published: "ahora"
                    };
                    PusherManager.replyChat($(a).closest(".app-chat-conversation").find(".app-conversation-parts"), t), i.val("")
                }
            }), !1
        }), $(document.body).on("submit", ".app-chat-form-user", function(e) {
            e.preventDefault();
            var a = $(this),
                t = ($(this).data("type"), $(this).data("id")),
                i = $(this).find("textarea[name='comment']"),
                n = i.val();
            return $.ajax({
                type: "POST",
                url: "/emp-AdminSolicitudesShowRun.php",
                data: {
                    Comentario: n,
                    id_solicitud: t,
                    socketId: PusherManager.getSocketId()
                },
                success: function(e) {},
                beforeSend: function(e) {
                    var t = {
                        body: n,
                        published: "ahora"
                    };
                    PusherManager.replyChat($(a).closest(".app-chat-conversation").find(".app-conversation-parts"), t), i.val("")
                }
            }), !1
        });
        $(document.body).on("submit", ".app-chat-form-concierge", function(e) {
            e.preventDefault();
            var t, a = $(this),
                i = $(this).data("type"),
                n = $(this).data("id"),
                o = $(this).find("textarea[name='comment']"),
                r = o.val(),
                s = $(this).closest(".app-chat-container-top").data("idconversation"),
                l = {
                    body: r
                };
            return PusherManager.replyChat(a.closest(".app-chat-conversation").find(".app-conversation-parts"), l), o.val(""), $(document).queue((t = s, function(e) {
                (function(t) {
                    if (!t) t = a.closest(".app-chat-container-top").data("idconversation");
                    return $.ajax({
                        type: "POST",
                        url: "/pusher/pusherReply.php",
                        data: {
                            type: i,
                            idItem: n,
                            idConcierge: "admin",
                            comentario: r,
                            idConversation: t,
                            socketId: PusherManager.getSocketId(),
                            url: document.location.href
                        },
                        success: function(e) {
                            if (!t) PusherManager.updateConversation(a, e.idConversation);
                            if (1 != e.statusConcierge) PusherManager.showLayerStatusConcierge(a, e.statusConcierge, e.conciergeAvatar)
                        }
                    })
                })(t).then(e, e)
            })), !1
        }), $(document.body).on("submit", ".app-chat-form-concierge-vendor", function(e) {
            e.preventDefault();
            var t, a = $(this),
                i = $(this).data("type"),
                n = $(this).data("id"),
                o = $(this).find("textarea[name='comment']"),
                r = o.val(),
                s = $(this).closest(".app-chat-container-top").data("idconversation"),
                l = {
                    body: r
                };
            return PusherManager.replyChat(a.closest(".app-chat-conversation").find(".app-conversation-parts"), l), o.val(""), $(document).queue((t = s, function(e) {
                (function(t) {
                    if (!t) t = a.closest(".app-chat-container-top").data("idconversation");
                    return $.ajax({
                        type: "POST",
                        url: "/pusher/pusherReply.php",
                        data: {
                            type: i,
                            idItem: n,
                            idConcierge: "admin",
                            comentario: r,
                            idConversation: t,
                            socketId: PusherManager.getSocketId(),
                            url: document.location.href
                        },
                        success: function(e) {
                            if (!t) PusherManager.updateConversation(a, e.idConversation);
                            if (1 != e.statusConcierge) PusherManager.showLayerStatusConcierge(a, e.statusConcierge, e.conciergeAvatar)
                        }
                    })
                })(t).then(e, e)
            })), !1
        })
    }),
    function(n) {
        n.titleAlert = function(e, t) {
            if (n.titleAlert._running) n.titleAlert.stop();
            if (n.titleAlert._settings = t = n.extend({}, n.titleAlert.defaults, t), !t.requireBlur || !n.titleAlert.hasFocus) {
                t.originalTitleInterval = t.originalTitleInterval || t.interval, n.titleAlert._running = !0, n.titleAlert._initialText = document.title, document.title = e;
                var a = !0,
                    i = function() {
                        if (n.titleAlert._running) a = !a, document.title = a ? e : n.titleAlert._initialText, n.titleAlert._intervalToken = setTimeout(i, a ? t.interval : t.originalTitleInterval)
                    };
                if (n.titleAlert._intervalToken = setTimeout(i, t.interval), t.stopOnMouseMove) n(document).mousemove(function(e) {
                    n(this).unbind(e), n.titleAlert.stop()
                });
                if (0 < t.duration) n.titleAlert._timeoutToken = setTimeout(function() {
                    n.titleAlert.stop()
                }, t.duration)
            }
        }, n.titleAlert.defaults = {
            interval: 500,
            originalTitleInterval: null,
            duration: 0,
            stopOnFocus: !0,
            requireBlur: !1,
            stopOnMouseMove: !1
        }, n.titleAlert.stop = function() {
            if (n.titleAlert._running) clearTimeout(n.titleAlert._intervalToken), clearTimeout(n.titleAlert._timeoutToken), document.title = n.titleAlert._initialText, n.titleAlert._timeoutToken = null, n.titleAlert._intervalToken = null, n.titleAlert._initialText = null, n.titleAlert._running = !1, n.titleAlert._settings = null
        }, n.titleAlert.hasFocus = !0, n.titleAlert._running = !1, n.titleAlert._intervalToken = null, n.titleAlert._timeoutToken = null, n.titleAlert._initialText = null, n.titleAlert._settings = null, n.titleAlert._focus = function() {
            if (n.titleAlert.hasFocus = !0, n.titleAlert._running && n.titleAlert._settings.stopOnFocus) {
                var e = n.titleAlert._initialText;
                n.titleAlert.stop(), setTimeout(function() {
                    if (!n.titleAlert._running) document.title = ".", document.title = e
                }, 1e3)
            }
        }, n.titleAlert._blur = function() {
            n.titleAlert.hasFocus = !1
        }, n(window).bind("focus", n.titleAlert._focus), n(window).bind("blur", n.titleAlert._blur)
    }(jQuery);
var Toastada = function(n) {
    var o, r = function(e) {
            return '<div id="toast-container" class="toast-container ' + (e = e || "") + '"></div>'
        },
        s = [],
        i = 0;

    function l(e, t) {
        var a = this;
        this.id = function() {
            function e() {
                return (65536 * (1 + Math.random()) | 0).toString(16).substring(1)
            }
            return e() + e() + "-" + e() + "-" + e() + "-" + e() + "-" + e() + e() + e()
        }(), this.messageText = t, this.type = e, this.delaySecs = i, this.build = function() {
            return '<div id="toast-' + a.id + '"  class="toast toast-' + a.type + '">' + a.messageText + '<span class="app-toast-btn-close toast-button-close">&times;</span></div>'
        }
    }

    function a(e, t, a) {
        if (function(e) {
                if (!o || 0 == o.length) n(document.body).append(r(e)), o = n("#toast-container")
            }(a), i = function(e) {
                for (var t = 0; t < s.length; t++)
                    if (e == s[t].messageText) return s[t]
            }(t)) return i;
        var i = new l(e, t);
        return s.push(i), i
    }
    return l.prototype.show = function() {
        var e = this,
            t = n(e.build()),
            a = o.find("#toast-" + e.id);
        if (a.length) {
            if (a.show(), e.timeoutId) clearTimeout(e.timeoutId)
        } else o.prepend(t), t.on("swipe", function() {
            e.hide()
        }).find(".app-toast-btn-close").on("click", function() {
            e.hide()
        });
        if (0 < e.delaySecs) e.timeoutId = setTimeout(function() {
            e.hide()
        }, 1e3 * e.delaySecs);
        return this
    }, l.prototype.hide = function() {
        return n("#toast-" + this.id).fadeOut(), this
    }, l.prototype.delete = function() {
        return n("#toast-" + this.id).hide(), this
    }, l.prototype.duration = function(e) {
        if ("number" != typeof e) e = 0;
        return this.delaySecs = e, this
    }, l.prototype.message = function(e) {
        return this.messageText = e, this
    }, {
        success: function(e, t) {
            return a("success", e, t)
        },
        info: function(e, t) {
            return a("info", e, t)
        },
        warn: function(e, t) {
            return a("warn", e, t)
        },
        error: function(e, t) {
            return a("error", e, t)
        },
        custom: function(e, t) {
            return a("custom", e, t)
        },
        clearAll: function() {
            for (var e in s) s[e].hide();
            s = []
        },
        deleteAll: function() {
            for (var e in s) s[e].delete();
            s = []
        },
        defaultDuration: function(e) {
            if (void 0 === e) return i;
            i = e
        }
    }
}(jQuery);
jQuery.trumbowyg = {
        langs: {
            en: {
                viewHTML: "View HTML",
                undo: "Undo",
                redo: "Redo",
                formatting: "Formatting",
                p: "Paragraph",
                blockquote: "Quote",
                code: "Code",
                header: "Header",
                bold: "Bold",
                italic: "Italic",
                strikethrough: "Stroke",
                underline: "Underline",
                strong: "Strong",
                em: "Emphasis",
                del: "Deleted",
                superscript: "Superscript",
                subscript: "Subscript",
                unorderedList: "Unordered list",
                orderedList: "Ordered list",
                insertImage: "Insert Image",
                link: "Link",
                createLink: "Insert link",
                unlink: "Remove link",
                justifyLeft: "Align Left",
                justifyCenter: "Align Center",
                justifyRight: "Align Right",
                justifyFull: "Align Justify",
                horizontalRule: "Insert horizontal rule",
                removeformat: "Remove format",
                fullscreen: "Fullscreen",
                close: "Close",
                submit: "Confirm",
                reset: "Cancel",
                required: "Required",
                description: "Description",
                title: "Title",
                text: "Text",
                target: "Target"
            }
        },
        plugins: {},
        svgPath: null,
        hideButtonTexts: null
    },
    function(o, p, u, m) {
        "use strict";
        m.fn.trumbowyg = function(e, t) {
            var a = "trumbowyg";
            if (e === Object(e) || !e) return this.each(function() {
                if (!m(this).data(a)) m(this).data(a, new n(this, e))
            });
            if (1 === this.length) try {
                var i = m(this).data(a);
                switch (e) {
                    case "execCmd":
                        return i.execCmd(t.cmd, t.param, t.forceCss);
                    case "openModal":
                        return i.openModal(t.title, t.content);
                    case "closeModal":
                        return i.closeModal();
                    case "openModalInsert":
                        return i.openModalInsert(t.title, t.fields, t.callback);
                    case "saveRange":
                        return i.saveRange();
                    case "getRange":
                        return i.range;
                    case "getRangeText":
                        return i.getRangeText();
                    case "restoreRange":
                        return i.restoreRange();
                    case "enable":
                        return i.toggleDisable(!1);
                    case "disable":
                        return i.toggleDisable(!0);
                    case "destroy":
                        return i.destroy();
                    case "empty":
                        return i.empty();
                    case "html":
                        return i.html(t)
                }
            } catch (e) {}
            return !1
        };
        var n = function(e, t) {
            var a = this,
                i = "trumbowyg-icons",
                n = m.trumbowyg;
            if (a.doc = e.ownerDocument || u, a.$ta = m(e), a.$c = m(e), null != (t = t || {}).lang || null != m.trumbowyg.langs[t.lang]) a.lang = m.extend(!0, {}, m.trumbowyg.langs.en, m.trumbowyg.langs[t.lang]);
            else a.lang = m.trumbowyg.langs.en;
            a.hideButtonTexts = null != n.hideButtonTexts ? n.hideButtonTexts : t.hideButtonTexts;
            var o = null != m.trumbowyg.svgPath ? m.trumbowyg.svgPath : t.svgPath;
            if (a.hasSvg = !1 !== o, a.svgPath = a.doc.querySelector("base") ? p.location.href.split("#")[0] : "", 0 === m("#" + i, a.doc).length && !1 !== o) {
                if (null == o) try {
                    throw new Error
                } catch (e) {
                    var r = e.stack.split("\n");
                    for (var s in r)
                        if (r[s].match(/http[s]?:\/\//)) {
                            (o = r[Number(s)].match(/((http[s]?:\/\/.+\/)([^\/]+\.js))(\?.*)?:/)[1].split("/")).pop(), o = o.join("/") + "/ui/icons.svg";
                            break
                        }
                }
                var l = a.doc.createElement("div");
                l.id = i, a.doc.body.insertBefore(l, a.doc.body.childNodes[0]), m.ajax({
                    async: !0,
                    type: "GET",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "xml",
                    url: o,
                    data: null,
                    beforeSend: null,
                    complete: null,
                    success: function(e) {
                        l.innerHTML = (new XMLSerializer).serializeToString(e.documentElement)
                    }
                })
            }

            function c() {
                return (p.chrome || p.Intl && Intl.v8BreakIterator) && "CSS" in p
            }
            var d = a.lang.header;
            if (a.btnsDef = {
                    viewHTML: {
                        fn: "toggle"
                    },
                    undo: {
                        isSupported: c,
                        key: "Z"
                    },
                    redo: {
                        isSupported: c,
                        key: "Y"
                    },
                    p: {
                        fn: "formatBlock"
                    },
                    blockquote: {
                        fn: "formatBlock"
                    },
                    h1: {
                        fn: "formatBlock",
                        title: d + " 1"
                    },
                    h2: {
                        fn: "formatBlock",
                        title: d + " 2"
                    },
                    h3: {
                        fn: "formatBlock",
                        title: d + " 3"
                    },
                    h4: {
                        fn: "formatBlock",
                        title: d + " 4"
                    },
                    subscript: {
                        tag: "sub"
                    },
                    superscript: {
                        tag: "sup"
                    },
                    bold: {
                        key: "B",
                        tag: "b"
                    },
                    italic: {
                        key: "I",
                        tag: "i"
                    },
                    underline: {
                        tag: "u"
                    },
                    strikethrough: {
                        tag: "strike"
                    },
                    strong: {
                        fn: "bold",
                        key: "B"
                    },
                    em: {
                        fn: "italic",
                        key: "I"
                    },
                    del: {
                        fn: "strikethrough"
                    },
                    createLink: {
                        tag: "a"
                    },
                    unlink: {},
                    insertImage: {},
                    justifyLeft: {
                        tag: "left",
                        forceCss: !0
                    },
                    justifyCenter: {
                        tag: "center",
                        forceCss: !0
                    },
                    justifyRight: {
                        tag: "right",
                        forceCss: !0
                    },
                    justifyFull: {
                        tag: "justify",
                        forceCss: !0
                    },
                    unorderedList: {
                        fn: "insertUnorderedList",
                        tag: "ul"
                    },
                    orderedList: {
                        fn: "insertOrderedList",
                        tag: "ol"
                    },
                    horizontalRule: {
                        fn: "insertHorizontalRule"
                    },
                    removeformat: {},
                    fullscreen: {
                        class: "trumbowyg-not-disable"
                    },
                    close: {
                        fn: "destroy",
                        class: "trumbowyg-not-disable"
                    },
                    formatting: {
                        dropdown: ["p", "blockquote", "h1", "h2", "h3", "h4"],
                        ico: "p"
                    },
                    link: {
                        dropdown: ["createLink", "unlink"]
                    }
                }, a.o = m.extend(!0, {}, {
                    lang: "en",
                    useComposition: !0,
                    fixedBtnPane: !1,
                    fixedFullWidth: !1,
                    autogrow: !1,
                    prefix: "trumbowyg-",
                    semantic: !0,
                    resetCss: !1,
                    removeformatPasted: !1,
                    tagsToRemove: [],
                    btnsGrps: {
                        design: ["bold", "italic", "underline", "strikethrough"],
                        semantic: ["strong", "em", "del"],
                        justify: ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
                        lists: ["unorderedList", "orderedList"]
                    },
                    btns: [
                        ["viewHTML"],
                        ["undo", "redo"],
                        ["formatting"], "btnGrp-semantic", ["superscript", "subscript"],
                        ["link"],
                        ["insertImage"], "btnGrp-justify", "btnGrp-lists", ["horizontalRule"],
                        ["removeformat"],
                        ["fullscreen"]
                    ],
                    btnsDef: {},
                    inlineElementsSelector: "a,abbr,acronym,b,caption,cite,code,col,dfn,dir,dt,dd,em,font,hr,i,kbd,li,q,span,strikeout,strong,sub,sup,u",
                    pasteHandlers: [],
                    imgDblClickHandler: function() {
                        return !1
                    },
                    plugins: {}
                }, t), a.disabled = a.o.disabled || "TEXTAREA" === e.nodeName && e.disabled, t.btns) a.o.btns = t.btns;
            else if (!a.o.semantic) a.o.btns[4] = "btnGrp-design";
            m.each(a.o.btnsDef, function(e, t) {
                a.addBtnDef(e, t)
            }), a.eventNamespace = "trumbowyg-event", a.keys = [], a.tagToButton = {}, a.tagHandlers = [], a.pasteHandlers = [].concat(a.o.pasteHandlers), a.init()
        };
        n.prototype = {
            init: function() {
                var e = this;
                e.height = e.$ta.height(), e.initPlugins();
                try {
                    e.doc.execCommand("enableObjectResizing", !1, !1), e.doc.execCommand("defaultParagraphSeparator", !1, "p")
                } catch (e) {}
                e.buildEditor(), e.buildBtnPane(), e.fixedBtnPaneEvents(), e.buildOverlay(), setTimeout(function() {
                    if (e.disabled) e.toggleDisable(!0);
                    e.$c.trigger("tbwinit")
                })
            },
            addBtnDef: function(e, t) {
                this.btnsDef[e] = t
            },
            buildEditor: function() {
                var i = this,
                    t = i.o.prefix,
                    e = "";
                if (i.$box = m("<div/>", {
                        class: t + "box " + t + "editor-visible " + t + i.o.lang + " trumbowyg"
                    }), i.isTextarea = i.$ta.is("textarea"), i.isTextarea) e = i.$ta.val(), i.$ed = m("<div/>"), i.$box.insertAfter(i.$ta).append(i.$ed, i.$ta);
                else i.$ed = i.$ta, e = i.$ed.html(), i.$ta = m("<textarea/>", {
                    name: i.$ta.attr("id"),
                    height: i.height
                }).val(e), i.$box.insertAfter(i.$ed).append(i.$ta, i.$ed), i.syncCode();
                if (i.$ta.addClass(t + "textarea").attr("tabindex", -1), i.$ed.addClass(t + "editor").attr({
                        contenteditable: !0,
                        dir: i.lang._dir || "ltr"
                    }).html(e), i.o.tabindex) i.$ed.attr("tabindex", i.o.tabindex);
                if (i.$c.is("[placeholder]")) i.$ed.attr("placeholder", i.$c.attr("placeholder"));
                if (i.o.resetCss) i.$ed.addClass(t + "reset-css");
                if (!i.o.autogrow) i.$ta.add(i.$ed).css("min-height", i.height).css("max-height", i.height + 250);
                i.semanticCode();
                var a, n = !1,
                    o = !1;
                i.$ed.on("dblclick", "img", i.o.imgDblClickHandler).on("keydown", function(e) {
                    if (o = i.o.useComposition && 229 === e.which, e.ctrlKey) {
                        n = !0;
                        var t = i.keys[String.fromCharCode(e.which).toUpperCase()];
                        try {
                            return i.execCmd(t.fn, t.param), !1
                        } catch (e) {}
                    }
                }).on("keyup input", function(e) {
                    if (!(37 <= e.which && e.which <= 40)) {
                        if (e.ctrlKey && (89 === e.which || 90 === e.which)) i.$c.trigger("tbwchange");
                        else if (!n && 17 !== e.which && !o) i.semanticCode(!1, 13 === e.which), i.$c.trigger("tbwchange");
                        setTimeout(function() {
                            n = !1
                        }, 200)
                    }
                }).on("mouseup keydown keyup", function() {
                    clearTimeout(a), a = setTimeout(function() {
                        i.updateButtonPaneStatus()
                    }, 50)
                }).on("focus blur", function(e) {
                    if (i.$c.trigger("tbw" + e.type), "blur" === e.type) m("." + t + "active-button", i.$btnPane).removeClass(t + "active-button " + t + "active")
                }).on("cut", function() {
                    setTimeout(function() {
                        i.semanticCode(!1, !0), i.$c.trigger("tbwchange")
                    }, 0)
                }).on("paste", function(a) {
                    if (i.o.removeformatPasted) {
                        a.preventDefault();
                        try {
                            var t = p.clipboardData.getData("Text");
                            try {
                                i.doc.selection.createRange().pasteHTML(t)
                            } catch (e) {
                                i.doc.getSelection().getRangeAt(0).insertNode(i.doc.createTextNode(t))
                            }
                        } catch (e) {
                            i.execCmd("insertText", (a.originalEvent || a).clipboardData.getData("text/plain"))
                        }
                    }
                    m.each(i.pasteHandlers, function(e, t) {
                        t(a)
                    }), setTimeout(function() {
                        i.semanticCode(!1, !0), i.$c.trigger("tbwpaste", a)
                    }, 0)
                }), i.$ta.on("keyup paste", function() {
                    i.$c.trigger("tbwchange")
                }), i.$box.on("keydown", function(e) {
                    if (27 === e.which && 1 === m("." + t + "modal-box", i.$box).length) return i.closeModal(), !1
                })
            },
            buildBtnPane: function() {
                var n = this,
                    o = n.o.prefix,
                    r = n.$btnPane = m("<div/>", {
                        class: o + "button-pane"
                    });
                m.each(n.o.btns, function(e, t) {
                    try {
                        var a = t.split("btnGrp-");
                        if (null != a[1]) t = n.o.btnsGrps[a[1]]
                    } catch (e) {}
                    if (!m.isArray(t)) t = [t];
                    var i = m("<div/>", {
                        class: o + "button-group " + (0 <= t.indexOf("fullscreen") ? o + "right" : "")
                    });
                    m.each(t, function(e, t) {
                        try {
                            var a;
                            if (n.isSupportedBtn(t)) a = n.buildBtn(t);
                            i.append(a)
                        } catch (e) {}
                    }), r.append(i)
                }), n.$box.prepend(r)
            },
            buildBtn: function(e) {
                var a = this,
                    t = a.o.prefix,
                    i = a.btnsDef[e],
                    n = i.dropdown,
                    o = null != i.hasIcon ? i.hasIcon : !0,
                    r = a.lang[e] || e,
                    s = m("<button/>", {
                        type: "button",
                        class: t + e + "-button " + (i.class || "") + (!o ? " " + t + "textual-button" : ""),
                        html: a.hasSvg && o ? '<svg><use xlink:href="' + a.svgPath + "#" + t + (i.ico || e).replace(/([A-Z]+)/g, "-$1").toLowerCase() + '"/></svg>' : a.hideButtonTexts ? "" : i.text || i.title || a.lang[e] || e,
                        title: (i.title || i.text || r) + (i.key ? " (Ctrl + " + i.key + ")" : ""),
                        tabindex: -1,
                        mousedown: function() {
                            if (!n || m("." + e + "-" + t + "dropdown", a.$box).is(":hidden")) m("body", a.doc).trigger("mousedown");
                            if (a.$btnPane.hasClass(t + "disable") && !m(this).hasClass(t + "active") && !m(this).hasClass(t + "not-disable")) return !1;
                            else return a.execCmd((n ? "dropdown" : !1) || i.fn || e, i.param || e, i.forceCss || !1), !1
                        }
                    });
                if (n) {
                    s.addClass(t + "open-dropdown");
                    var l = t + "dropdown",
                        c = m("<div/>", {
                            class: l + "-" + e + " " + l + " " + t + "fixed-top",
                            "data-dropdown": e
                        });
                    m.each(n, function(e, t) {
                        if (a.btnsDef[t] && a.isSupportedBtn(t)) c.append(a.buildSubBtn(t))
                    }), a.$btnPane.append(c.hide())
                } else if (i.key) a.keys[i.key] = {
                    fn: i.fn || e,
                    param: i.param || e
                };
                if (!n) a.tagToButton[(i.tag || e).toLowerCase()] = e;
                return s
            },
            buildSubBtn: function(e) {
                var t = this,
                    a = t.o.prefix,
                    i = t.btnsDef[e],
                    n = null != i.hasIcon ? i.hasIcon : !0;
                if (i.key) t.keys[i.key] = {
                    fn: i.fn || e,
                    param: i.param || e
                };
                return t.tagToButton[(i.tag || e).toLowerCase()] = e, m("<button/>", {
                    type: "button",
                    class: a + e + "-dropdown-button" + (i.ico ? " " + a + i.ico + "-button" : ""),
                    html: t.hasSvg && n ? '<svg><use xlink:href="' + t.svgPath + "#" + a + (i.ico || e).replace(/([A-Z]+)/g, "-$1").toLowerCase() + '"/></svg>' + (i.text || i.title || t.lang[e] || e) : i.text || i.title || t.lang[e] || e,
                    title: i.key ? " (Ctrl + " + i.key + ")" : null,
                    style: i.style || null,
                    mousedown: function() {
                        return m("body", t.doc).trigger("mousedown"), t.execCmd(i.fn || e, i.param || e, i.forceCss || !1), !1
                    }
                })
            },
            isSupportedBtn: function(e) {
                try {
                    return this.btnsDef[e].isSupported()
                } catch (e) {}
                return !0
            },
            buildOverlay: function() {
                var e = this;
                return e.$overlay = m("<div/>", {
                    class: e.o.prefix + "overlay"
                }).css({
                    top: e.$btnPane.outerHeight(),
                    height: e.$ed.outerHeight() + 1 + "px"
                }).appendTo(e.$box), e.$overlay
            },
            showOverlay: function() {
                m(p).trigger("scroll"), this.$overlay.fadeIn(200), this.$box.addClass(this.o.prefix + "box-blur")
            },
            hideOverlay: function() {
                this.$overlay.fadeOut(50), this.$box.removeClass(this.o.prefix + "box-blur")
            },
            fixedBtnPaneEvents: function() {
                var n = this,
                    o = n.o.fixedFullWidth,
                    r = n.$box;
                if (n.o.fixedBtnPane) n.isFixed = !1, m(p).on("scroll." + n.eventNamespace + " resize." + n.eventNamespace, function() {
                    if (r) {
                        n.syncCode();
                        var e = m(p).scrollTop(),
                            t = r.offset().top + 1,
                            a = n.$btnPane,
                            i = a.outerHeight() - 2;
                        if (0 < e - t && e - t - n.height < 0) {
                            if (!n.isFixed) n.isFixed = !0, a.css({
                                position: "fixed",
                                top: 0,
                                left: o ? "0" : "auto",
                                zIndex: 7
                            }), m([n.$ta, n.$ed]).css({
                                marginTop: a.height()
                            });
                            a.css({
                                width: o ? "100%" : r.width() - 1 + "px"
                            }), m("." + n.o.prefix + "fixed-top", r).css({
                                position: o ? "fixed" : "absolute",
                                top: o ? i : e - t + i + "px",
                                zIndex: 15
                            })
                        } else if (n.isFixed) n.isFixed = !1, a.removeAttr("style"), m([n.$ta, n.$ed]).css({
                            marginTop: 0
                        }), m("." + n.o.prefix + "fixed-top", r).css({
                            position: "absolute",
                            top: i
                        })
                    }
                })
            },
            toggleDisable: function(e) {
                var t = this,
                    a = t.o.prefix;
                if (t.disabled = e) t.$ta.attr("disabled", !0);
                else t.$ta.removeAttr("disabled");
                t.$box.toggleClass(a + "disabled", e), t.$ed.attr("contenteditable", !e)
            },
            destroy: function() {
                var e = this,
                    t = e.o.prefix,
                    a = e.height;
                if (e.isTextarea) e.$box.after(e.$ta.css({
                    height: a
                }).val(e.html()).removeClass(t + "textarea").show());
                else e.$box.after(e.$ed.css({
                    height: a
                }).removeClass(t + "editor").removeAttr("contenteditable").html(e.html()).show());
                e.$ed.off("dblclick", "img"), e.destroyPlugins(), e.$box.remove(), e.$c.removeData("trumbowyg"), m("body").removeClass(t + "body-fullscreen"), e.$c.trigger("tbwclose"), m(p).off("scroll." + e.eventNamespace + " resize." + e.eventNamespace)
            },
            empty: function() {
                this.$ta.val(""), this.syncCode(!0)
            },
            toggle: function() {
                var e = this,
                    t = e.o.prefix;
                e.semanticCode(!1, !0), setTimeout(function() {
                    if (e.doc.activeElement.blur(), e.$box.toggleClass(t + "editor-hidden " + t + "editor-visible"), e.$btnPane.toggleClass(t + "disable"), m("." + t + "viewHTML-button", e.$btnPane).toggleClass(t + "active"), e.$box.hasClass(t + "editor-visible")) e.$ta.attr("tabindex", -1);
                    else e.$ta.removeAttr("tabindex")
                }, 0)
            },
            dropdown: function(e) {
                var t = this,
                    a = t.doc,
                    i = t.o.prefix,
                    n = m("[data-dropdown=" + e + "]", t.$btnPane),
                    o = m("." + i + e + "-button", t.$btnPane),
                    r = n.is(":hidden");
                if (m("body", a).trigger("mousedown"), r) {
                    o.offset().left;
                    o.addClass(i + "active"), n.css({
                        position: "absolute",
                        top: t.$btnPane.height() + 5 + "px"
                    }).show(), m(p).trigger("scroll"), m("body", a).on("mousedown." + t.eventNamespace, function() {
                        m("." + i + "dropdown", a).hide(), m("." + i + "active", a).removeClass(i + "active"), m("body", a).off("mousedown." + t.eventNamespace)
                    })
                }
            },
            html: function(e) {
                if (null != e) return this.$ta.val(e), this.syncCode(!0), this;
                else return this.$ta.val()
            },
            syncTextarea: function() {
                this.$ta.val(0 < this.$ed.text().trim().length || 0 < this.$ed.find("hr,img,embed,iframe,input").length ? this.$ed.html() : "")
            },
            syncCode: function(e) {
                var t = this;
                if (!e && t.$ed.is(":visible")) t.syncTextarea();
                else t.$ed.html(t.$ta.val());
                if (t.o.autogrow)
                    if (t.height = t.$ed.height(), t.height !== t.$ta.css("height")) t.$ta.css({
                        height: t.height
                    }), t.$c.trigger("tbwresize")
            },
            semanticCode: function(e, t) {
                var a = this;
                if (a.saveRange(), a.syncCode(e), m(a.o.tagsToRemove.join(","), a.$ed).remove(), a.o.semantic) {
                    if (a.semanticTag("b", "strong"), a.semanticTag("i", "em"), t) {
                        var i = a.o.inlineElementsSelector,
                            n = ":not(" + i + ")";
                        a.$ed.contents().filter(function() {
                            return 3 === this.nodeType && 0 < this.nodeValue.trim().length
                        }).wrap("<span data-tbw/>");
                        var o = function(e) {
                            if (0 !== e.length) {
                                var t = e.nextUntil(n).addBack().wrapAll("<p/>").parent(),
                                    a = t.nextAll(i).first();
                                t.next("br").remove(), o(a)
                            }
                        };
                        o(a.$ed.children(i).first()), a.semanticTag("div", "p", !0), a.$ed.find("p").filter(function() {
                            if (a.range && this === a.range.startContainer) return !1;
                            else return 0 === m(this).text().trim().length && 0 === m(this).children().not("br,span").length
                        }).contents().unwrap(), m("[data-tbw]", a.$ed).contents().unwrap(), a.$ed.find("p:empty").each(function() {
                            var e = m(this);
                            if ("<br>" !== e.html()) e.remove()
                        })
                    }
                    a.restoreRange(), a.syncTextarea()
                }
            },
            semanticTag: function(e, t, a) {
                m(e, this.$ed).each(function() {
                    var e = m(this);
                    if (e.wrap("<" + t + "/>"), a) m.each(e.prop("attributes"), function() {
                        e.parent().attr(this.name, this.value)
                    });
                    e.contents().unwrap()
                })
            },
            createLink: function() {
                for (var e, a = this, t = a.doc.getSelection(), i = t.focusNode;
                    ["A", "DIV"].indexOf(i.nodeName) < 0;) i = i.parentNode;
                if (i && "A" === i.nodeName) {
                    var n = m(i);
                    e = n.attr("href"), n.attr("title"), n.attr("target");
                    var o = a.doc.createRange();
                    o.selectNode(i), t.addRange(o)
                }
                a.saveRange(), a.openModalInsert(a.lang.createLink, {
                    url: {
                        label: "URL",
                        required: !0,
                        value: e
                    },
                    text: {
                        label: a.lang.text,
                        value: a.getRangeText()
                    }
                }, function(e) {
                    if (0 !== e.url.indexOf("https://") && 0 !== e.url.indexOf("http://")) e.url = "http://" + e.url;
                    var t = m(['<a href="', e.url, '">', e.text, "</a>"].join(""));
                    return a.range.deleteContents(), a.range.insertNode(t[0]), !0
                })
            },
            createLinkRaw: function(e) {
                for (var t = this.doc.getSelection(), a = t.focusNode;
                    ["A", "DIV"].indexOf(a.nodeName) < 0;) a = a.parentNode;
                if (a && "A" === a.nodeName) {
                    var i = m(a);
                    i.attr("href"), i.attr("title"), i.attr("target");
                    var n = this.doc.createRange();
                    n.selectNode(a), t.addRange(n)
                }
                if (0 !== e.url.indexOf("https://") && 0 !== e.url.indexOf("http://")) e.url = "http://" + e.url;
                var o = m(['<a href="', e.url, '">', e.text, "</a>"].join(""));
                return this.range.deleteContents(), this.range.insertNode(o[0]), !0
            },
            unlink: function() {
                var e = this.doc.getSelection(),
                    t = e.focusNode;
                if (e.isCollapsed) {
                    for (;
                        ["A", "DIV"].indexOf(t.nodeName) < 0;) t = t.parentNode;
                    if (t && "A" === t.nodeName) {
                        var a = this.doc.createRange();
                        a.selectNode(t), e.addRange(a)
                    }
                }
                this.execCmd("unlink", void 0, void 0, !0)
            },
            insertImage: function() {
                var t = this;
                t.saveRange(), t.openModalInsert(t.lang.insertImage, {
                    url: {
                        label: "URL",
                        required: !0
                    },
                    alt: {
                        label: t.lang.description,
                        value: t.getRangeText()
                    }
                }, function(e) {
                    return t.execCmd("insertImage", e.url), m('img[src="' + e.url + '"]:not([alt])', t.$box).attr("alt", e.alt), !0
                })
            },
            fullscreen: function() {
                var e, t = this.o.prefix,
                    a = t + "fullscreen";
                this.$box.toggleClass(a), e = this.$box.hasClass(a), m("body").toggleClass(t + "body-fullscreen", e), m(p).trigger("scroll"), this.$c.trigger("tbw" + (e ? "open" : "close") + "fullscreen")
            },
            execCmd: function(t, a, e, i) {
                var n = this;
                if (i = !!i || "", "dropdown" !== t) n.$ed.focus();
                try {
                    n.doc.execCommand("styleWithCSS", !1, e || !1)
                } catch (e) {}
                try {
                    n[t + i](a)
                } catch (e) {
                    try {
                        t(a)
                    } catch (e) {
                        if ("insertHorizontalRule" === t) a = void 0;
                        else if ("formatBlock" === t && (-1 !== o.userAgent.indexOf("MSIE") || -1 !== o.appVersion.indexOf("Trident/"))) a = "<" + a + ">";
                        if (n.doc.execCommand(t, !1, a), n.syncCode(), "insertImage" != t) n.semanticCode(!1, !0)
                    }
                    if ("dropdown" !== t) n.updateButtonPaneStatus(), n.$c.trigger("tbwchange")
                }
            },
            openModal: function(e, t) {
                var a = this,
                    i = a.o.prefix;
                if (0 < m("." + i + "modal-box", a.$box).length) return !1;
                a.saveRange(), a.showOverlay(), a.$btnPane.addClass(i + "disable");
                var n = m("<div/>", {
                    class: i + "modal " + i + "fixed-top"
                }).css({
                    top: a.$btnPane.height()
                }).appendTo(a.$box);
                a.$overlay.one("click", function() {
                    return n.trigger("tbwcancel"), !1
                });
                var o = m("<form/>", {
                        action: "",
                        html: t
                    }).on("submit", function() {
                        return n.trigger("tbwconfirm"), !1
                    }).on("reset", function() {
                        return n.trigger("tbwcancel"), !1
                    }),
                    r = m("<div/>", {
                        class: i + "modal-box",
                        html: o
                    }).css({
                        top: "-" + a.$btnPane.outerHeight() + "px",
                        opacity: 0
                    }).appendTo(n).animate({
                        top: 0,
                        opacity: 1
                    }, 100);
                return m("<span/>", {
                    text: e,
                    class: i + "modal-title"
                }).prependTo(r), n.height(r.outerHeight() + 10), m("input:first", r).focus(), a.buildModalBtn("submit", r), a.buildModalBtn("reset", r), m(p).trigger("scroll"), n
            },
            buildModalBtn: function(e, t) {
                var a = this.o.prefix;
                return m("<button/>", {
                    class: a + "modal-button " + a + "modal-" + e,
                    type: e,
                    text: this.lang[e] || e
                }).appendTo(m("form", t))
            },
            closeModal: function() {
                var e = this,
                    t = e.o.prefix;
                e.$btnPane.removeClass(t + "disable"), e.$overlay.off();
                var a = m("." + t + "modal-box", e.$box);
                a.animate({
                    top: "-" + a.height()
                }, 100, function() {
                    a.parent().remove(), e.hideOverlay()
                }), e.restoreRange()
            },
            openModalInsert: function(e, t, a) {
                var r = this,
                    s = r.o.prefix,
                    l = r.lang,
                    c = "",
                    d = "tbwconfirm";
                return m.each(t, function(e, t) {
                    var a = t.label,
                        i = t.name || e,
                        n = t.attributes || {},
                        o = Object.keys(n).map(function(e) {
                            return e + '="' + n[e] + '"'
                        }).join(" ");
                    c += '<label><input type="' + (t.type || "text") + '" name="' + i + '" value="' + (t.value || "").replace(/"/g, "&quot;") + '"' + o + '><span class="' + s + 'input-infos"><span>' + (!a ? l[e] ? l[e] : e : l[a] ? l[a] : a) + "</span></span></label>"
                }), r.openModal(e, c).on(d, function() {
                    var i = m("form", m(this)),
                        n = !0,
                        o = {};
                    if (m.each(t, function(e, t) {
                            var a = m('input[name="' + e + '"]', i);
                            if ("checkbox" === a.attr("type").toLowerCase()) o[e] = a.is(":checked");
                            else o[e] = m.trim(a.val());
                            if (t.required && "" === o[e]) n = !1, r.addErrorOnModalField(a, r.lang.required);
                            else if (t.pattern && !t.pattern.test(o[e])) n = !1, r.addErrorOnModalField(a, t.patternError)
                        }), n)
                        if (r.restoreRange(), a(o, t)) r.syncCode(), r.$c.trigger("tbwchange"), r.closeModal(), m(this).off(d)
                }).one("tbwcancel", function() {
                    m(this).off(d), r.closeModal()
                })
            },
            addErrorOnModalField: function(e, t) {
                var a = this.o.prefix,
                    i = e.parent();
                e.on("change keyup", function() {
                    i.removeClass(a + "input-error")
                }), i.addClass(a + "input-error").find("input+span").append(m("<span/>", {
                    class: a + "msg-error",
                    text: t
                }))
            },
            saveRange: function() {
                var e = this,
                    t = e.doc.getSelection();
                if (e.range = null, t.rangeCount) {
                    var a, i = e.range = t.getRangeAt(0),
                        n = e.doc.createRange();
                    n.selectNodeContents(e.$ed[0]), n.setEnd(i.startContainer, i.startOffset), a = (n + "").length, e.metaRange = {
                        start: a,
                        end: a + (i + "").length
                    }
                }
            },
            restoreRange: function() {
                var e, t = this,
                    a = t.metaRange,
                    i = t.range,
                    n = t.doc.getSelection();
                if (i) {
                    if (a && a.start !== a.end) {
                        var o, r = 0,
                            s = [t.$ed[0]],
                            l = !1,
                            c = !1;
                        for (e = t.doc.createRange(); !c && (o = s.pop());)
                            if (3 === o.nodeType) {
                                var d = r + o.length;
                                if (!l && a.start >= r && a.start <= d) e.setStart(o, a.start - r), l = !0;
                                if (l && a.end >= r && a.end <= d) e.setEnd(o, a.end - r), c = !0;
                                r = d
                            } else
                                for (var p = o.childNodes, u = p.length; 0 < u;) u -= 1, s.push(p[u])
                    }
                    n.removeAllRanges(), n.addRange(e || i)
                }
            },
            getRangeText: function() {
                return this.range + ""
            },
            updateButtonPaneStatus: function() {
                var o = this,
                    r = o.o.prefix,
                    e = o.getTagsRecursive(o.doc.getSelection().focusNode),
                    s = r + "active-button " + r + "active";
                m("." + r + "active-button", o.$btnPane).removeClass(s), m.each(e, function(e, t) {
                    var a = o.tagToButton[t.toLowerCase()],
                        i = m("." + r + a + "-button", o.$btnPane);
                    if (0 < i.length) i.addClass(s);
                    else try {
                        var n = (i = m("." + r + "dropdown ." + r + a + "-dropdown-button", o.$box)).parent().data("dropdown");
                        m("." + r + n + "-button", o.$box).addClass(s)
                    } catch (e) {}
                })
            },
            getTagsRecursive: function(a, i) {
                var n = this;
                if (i = i || [], a && a.parentNode) a = a.parentNode;
                else return i;
                var e = a.tagName;
                if ("DIV" === e) return i;
                if ("P" === e && "" !== a.style.textAlign) i.push(a.style.textAlign);
                return m.each(n.tagHandlers, function(e, t) {
                    i = i.concat(t(a, n))
                }), i.push(e), n.getTagsRecursive(a, i)
            },
            initPlugins: function() {
                var a = this;
                a.loadedPlugins = [], m.each(m.trumbowyg.plugins, function(e, t) {
                    if (!t.shouldInit || t.shouldInit(a)) {
                        if (t.init(a), t.tagHandler) a.tagHandlers.push(t.tagHandler);
                        a.loadedPlugins.push(t)
                    }
                })
            },
            destroyPlugins: function() {
                m.each(this.loadedPlugins, function(e, t) {
                    if (t.destroy) t.destroy()
                })
            }
        }
    }(navigator, window, document, jQuery),
    function(s) {
        "use strict";
        var t = {};
        s.extend(!0, s.trumbowyg, {
            langs: {
                en: {
                    insertLinkBodas: "Insert Link"
                }
            },
            plugins: {
                insertLinkBodas: {
                    init: function(r) {
                        r.o.plugins.insertLinkBodas = s.extend(!0, {}, t, r.o.plugins.insertLinkBodas || {});
                        var e = {
                            fn: function() {
                                var e = window.getSelection(),
                                    t = e.toString(),
                                    a = e.focusNode.parentNode;
                                if ("A" == a.nodeName) var i = a.href;
                                if (void 0 === i) i = "";
                                var n = '<div class="modal-dialog"><div class="modal-content"><div class="p20 border-bottom text-center"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h2>' + 'Add link' + '</h2></div><form id="app-insert-link-form" name="newLinkForm" data-trumbo-selector="#' + r.$c[0].id + '"><div class="p20 bg"><p>' + 'Link' + '</p><div class="input-group"><input type="text" name="link" value="' + i + '"></div><p>' + 'Text' + '</p><div class="input-group"><input type="text" name="linkName" value="' + t + '"></div></div><div class="p20"><button class="btn-flat red" type="submit">' + 'Insert' + "</button></div></form></div></div>",
                                    o = s("#app-common-layer").html(n);
                                r.execCmd("saveRange"), o.modal()
                            }
                        };
                        r.addBtnDef("insertLinkBodas", e)
                    }
                }
            }
        })
    }(jQuery);