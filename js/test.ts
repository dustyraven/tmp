
function _(selector?: string) {

    if (selector) {

        if (window === this)
            return new _(selector);

        this._selector = selector;

        let elements = document.querySelectorAll(this._selector);

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


class Sess {
    private data: object;

    constructor() {
        let tmp = localStorage.getItem('_sess');

        if (tmp) {
            this.data = JSON.parse(tmp);
        } else {
            this.data = {};
            this.save();
        }
    };

    public get(key) {

        return ('undefined' === typeof this.data[key]) ? null : this.data[key];
    }

    public set(key, data) {
        this.data[key] = data;
        this.save();
    }

    public save() {
        localStorage.setItem('_sess', JSON.stringify(this.data));
    }

    public getBase64() {
        return btoa(JSON.stringify(this.data));
    }

}


function _ajax(url, callback) {

    let xmlhttp = new XMLHttpRequest();
    let data = _sess.getBase64();

    xmlhttp.onreadystatechange = () => {

        if (xmlhttp.readyState === XMLHttpRequest.DONE ) {
            if (200 === xmlhttp.status) {
                let result;
                try {
                    result = JSON.parse(xmlhttp.responseText);
                } catch (e) {
                    result = xmlhttp.responseText;
                }
                if ('function' === typeof callback)
                    callback(result);
           } else {
               console.error('XMLHttpRequest returned: ' + xmlhttp.status);
           }
        }
    };

    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('_sess=' + data);
}

function dataLoad(args?) {

    let url = '';

    let params = [];

    _('#loader').style.display = 'block';

    if (arguments.length) {

        for (let i = 0, len = arguments.length; i < len; i++) {

            if (typeof arguments[i] === 'string') {
                params.push(arguments[i]);
            } else {
                console.log(typeof arguments[i], arguments[i]);
            }
        }

        if (params.length) {
            url += '?' + params.join('&');
        }
    }

    _ajax(url, dataResponce);
}

function dataResponce(responce: any) {
    let r;

    if ('object' !== typeof responce) {
        console.error('invalid responce of type ' + typeof responce);
        return;
    }

    if (!(responce instanceof Array)) {
        responce = [responce];
    }

    for (let i = 0, len = responce.length; i < len; i++) {
        r = responce[i];


        if (r.selector) {
            if (r.template && r.data) {
                _(r.selector).innerHTML = Mustache.render(r.template, r);
            } else if ('undefined' !== typeof r.html) {
                _(r.selector).innerHTML = r.html;
            } else if ('undefined' !== typeof r.text) {
                if ('undefined' !== typeof document[r.selector]) {
                    document[r.selector] = r.text;
                } else {
                    _(r.selector).innerText = r.text;
                }
            } else {
                console.warn(r);
            }
        } else if (r.url) {
            history.pushState(r, '', r.url);
        } else {
            console.error(r);
        }
    }

    _('#loader').style.display = 'none';

    // console.log(JSON.stringify(responce, null, '\t'));
}


function __click(e) {

    e = e || event;
    let el = e.target || e.srcElement;
    let tg = null;
    let href = null;

    if ((el.nodeName || el.tagName).toLowerCase() === 'a') {
        tg = el;
    } else {
        do {
            el = el.parentNode;
            if (!el) {
                break;
            }
            if ((el.nodeName || el.tagName).toLowerCase() === 'a') {
                tg = el;
                break;
            }
        }
        while (true);
    }

    href = tg.getAttribute('href');

    if (tg && href && 0 !== href.indexOf('#')) {
        e.preventDefault();
        e.stopPropagation();
        console.warn('CLICK: ' + href.replace(/^\/+|\/+$/g, ''));
        dataLoad( href.replace(/^\/+|\/+$/g, '') );
        return false;
    }
}

function _click(e) {

    _stop(e);

    let tag = (this.nodeName || this.tagName).toLowerCase();

    if ('a' === tag) {

        let href = this.getAttribute('href');

        if ('#' === href)
            return false;

        if (href && 0 !== href.indexOf('#')) {

            console.warn('CLICK: ' + href.replace(/^\/+|\/+$/g, ''));
            dataLoad( href.replace(/^\/+|\/+$/g, '') );
            return false;
        }

    } else if ('button' === tag) {

        let classList = this.className.split(/\s+/);

        for (let c of classList) {
            if ('function' === typeof clickers[c]) {
                clickers[c](this);
            }
        }

        console.log(classList);

    } else {
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

let clickers = {
    order: (el) => {
        console.warn('BUTTON', el);
    }
};

//////////////////////////
//      A C T I O N     //
//////////////////////////

let _sess = new Sess();

const base = _('base').href;

// document.addEventListener('click', _click, true);

$(document).on('submit', 'form', _stop);
$(document).on('click', 'a, button', _click);

dataLoad( document.location.href.replace(base, '') );






