function _(selector) {
    if (selector) {
        if (window === this)
            return new _(selector);
        this._selector = selector;
        var elements = document.querySelectorAll(this._selector);
        return (1 === elements.length) ? elements[0] : elements;
    }
    return new _();
}
/*
class _ {
    public static about = {
        Version: '0.0.0.1'
    };

    private _e: Array;
    private _selector: string;

    constructor(selector: string) {

        if (window === this) {
            return new _(selector);
        }

        this._selector = selector;
        // this._e = document.getElementById(id);
        this._e = document.querySelectorAll(this._selector);
        return (1 === this._e.length) ? this._e[0] : this._e;
    };

    public doSomething() {
        return this;
    };
}
*/
var Sess = (function () {
    function Sess() {
        var tmp = localStorage.getItem('_sess');
        if (tmp) {
            this.data = JSON.parse(tmp);
        }
        else {
            this.data = {};
            this.save();
        }
    }
    ;
    Sess.prototype.get = function (key) {
        return ('undefined' === typeof this.data[key]) ? null : this.data[key];
    };
    Sess.prototype.set = function (key, data) {
        this.data[key] = data;
        this.save();
    };
    Sess.prototype.save = function () {
        localStorage.setItem('_sess', JSON.stringify(this.data));
    };
    Sess.prototype.getBase64 = function () {
        return btoa(JSON.stringify(this.data));
    };
    return Sess;
}());
function _ajax(url, callback) {
    var xmlhttp = new XMLHttpRequest();
    var data = _sess.getBase64();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === XMLHttpRequest.DONE) {
            if (200 === xmlhttp.status) {
                var result = void 0;
                try {
                    result = JSON.parse(xmlhttp.responseText);
                }
                catch (e) {
                    result = xmlhttp.responseText;
                }
                if ('function' === typeof callback)
                    callback(result);
            }
            else {
                console.error('XMLHttpRequest returned: ' + xmlhttp.status);
            }
        }
    };
    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('_sess=' + data);
}
function dataLoad(args) {
    var url = '';
    var params = [];
    _('#loader').style.display = 'block';
    if (arguments.length) {
        for (var i = 0, len = arguments.length; i < len; i++) {
            if (typeof arguments[i] === 'string') {
                params.push(arguments[i]);
            }
            else {
                console.log(typeof arguments[i], arguments[i]);
            }
        }
        if (params.length) {
            url += '?' + params.join('&');
        }
    }
    _ajax(url, dataResponce);
}
function dataResponce(responce) {
    var r;
    if ('object' !== typeof responce) {
        console.error('invalid responce of type ' + typeof responce);
        return;
    }
    if (!(responce instanceof Array)) {
        responce = [responce];
    }
    for (var i = 0, len = responce.length; i < len; i++) {
        r = responce[i];
        if (r.selector) {
            if (r.template && r.data) {
                _(r.selector).innerHTML = Mustache.render(r.template, r);
            }
            else if ('undefined' !== typeof r.html) {
                _(r.selector).innerHTML = r.html;
            }
            else if ('undefined' !== typeof r.text) {
                if ('undefined' !== typeof document[r.selector]) {
                    document[r.selector] = r.text;
                }
                else {
                    _(r.selector).innerText = r.text;
                }
            }
            else {
                console.warn(r);
            }
        }
        else if (r.url) {
            history.pushState(r, '', r.url);
        }
        else {
            console.error(r);
        }
    }
    _('#loader').style.display = 'none';
    // console.log(JSON.stringify(responce, null, '\t'));
}
function __click(e) {
    e = e || event;
    var el = e.target || e.srcElement;
    var tg = null;
    var href = null;
    if ((el.nodeName || el.tagName).toLowerCase() === 'a') {
        tg = el;
    }
    else {
        do {
            el = el.parentNode;
            if (!el) {
                break;
            }
            if ((el.nodeName || el.tagName).toLowerCase() === 'a') {
                tg = el;
                break;
            }
        } while (true);
    }
    href = tg.getAttribute('href');
    if (tg && href && 0 !== href.indexOf('#')) {
        e.preventDefault();
        e.stopPropagation();
        console.warn('CLICK: ' + href.replace(/^\/+|\/+$/g, ''));
        dataLoad(href.replace(/^\/+|\/+$/g, ''));
        return false;
    }
}
function _click(e) {
    _stop(e);
    var tag = (this.nodeName || this.tagName).toLowerCase();
    if ('a' === tag) {
        var href = this.getAttribute('href');
        if ('#' === href)
            return false;
        if (href && 0 !== href.indexOf('#')) {
            console.warn('CLICK: ' + href.replace(/^\/+|\/+$/g, ''));
            dataLoad(href.replace(/^\/+|\/+$/g, ''));
            return false;
        }
    }
    else if ('button' === tag) {
        var classList = this.className.split(/\s+/);
        for (var _i = 0, classList_1 = classList; _i < classList_1.length; _i++) {
            var c = classList_1[_i];
            if ('function' === typeof clickers[c]) {
                clickers[c](this);
            }
        }
        console.log(classList);
    }
    else {
        console.error('Unsupported tag: ' + tag);
    }
}
function _stop(event) {
    event.preventDefault();
    event.stopPropagation();
}
/*
let _test = (function () {

    function init() {
        console.log('_test', this, arguments);
    }

    return function () {
        return new init()
    };
})();
*/
var clickers = {
    order: function (el) {
        console.warn('BUTTON', el);
    }
};
//////////////////////////
//      A C T I O N     //
//////////////////////////
var _sess = new Sess();
var base = _('base').href;
// document.addEventListener('click', _click, true);
$(document).on('submit', 'form', _stop);
$(document).on('click', 'a, button', _click);
dataLoad(document.location.href.replace(base, ''));
