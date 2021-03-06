! function(t, e) {
    "object" == typeof module && module.exports ? module.exports.Preloadr = e() : t.Preloadr = e()
}("undefined" != typeof window ? window : this, function() {
    "use strict";
    var s = {},
        a = window.document.documentElement;
    return s.stack = {}, s.status = "", s.loaded = function() {
        return "loaded" === s.status
    }, s.add = function(t) {
        s.stack[t] = !1
    }, s.check = function() {
        var t = !0;
        for (var e in s.stack)
            if (!0 !== s.stack[e]) {
                t = !1;
                break
            }
        return t
    }, s.complete = function(t) {
        if (!1 === s.stack[t]) {
            s.stack[t] = !0;
            var e = new CustomEvent("evolvethemes-preloadr-element-" + t + "-loaded");
            a.dispatchEvent(e), !s.loaded() && s.check() && s.show()
        }
    }, s.show = function() {
        setTimeout(function() {
            s.setStatus("loaded"), a.classList.remove("evolvethemes-preloadr-not-loaded")
        }, 10)
    }, s.setStatus = function(t) {
        var e = "evolvethemes-preloadr-status-",
            o = a.className.split(" ").filter(function(t) {
                return 0 !== t.lastIndexOf(e, 0)
            });
        if (s.status = t, s.status) {
            o.push(e + s.status);
            var n = new CustomEvent("evolvethemes-preloadr-" + s.status);
            a.dispatchEvent(n)
        }
        a.className = o.join(" ").trim()
    }, s.init = function(t) {
        s.stack = {}, t.forEach(function(t) {
                s.stack[t] = !1
            }),
            function() {
                function t(t, e) {
                    e = e || {
                        bubbles: !1,
                        cancelable: !1,
                        detail: void 0
                    };
                    var o = document.createEvent("CustomEvent");
                    return o.initCustomEvent(t, e.bubbles, e.cancelable, e.detail), o
                }
                t.prototype = window.Event.prototype, window.CustomEvent = t
            }(), a.classList.add("evolvethemes-preloadr-not-loaded"), s.setStatus("loading")
    }, s
});
