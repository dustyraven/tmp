function _(selector)
{
    if(selector)
    {
        if(window == this)
            return new _(selector);

        this._selector = selector;

        var elements = document.querySelectorAll(this._selector);

        return (1 == elements.length) ? elements[0] : elements;
    }
    return new _;
}




function _get(url, callback)
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
            if (xmlhttp.status == 200) {
                var result;
                try {
                    result = JSON.parse(xmlhttp.responseText);
                } catch(e) {
                    result = xmlhttp.responseText;
                }
                callback(result);
           }
           else {
               console.error('XMLHttpRequest returned: ' + xmlhttp.status);
           }
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function _click(e) {

    e = e || event;
    var el = e.target || e.srcElement;
    var tg = null, href= null;

    if ((el.nodeName || el.tagName).toLowerCase()==='a'){
        tg = el;
    }
    else
    {
        while (el = el.parentNode){
            if ((el.nodeName || el.tagName).toLowerCase()==='a'){
                tg = el;
                break;
            }
        }
    }

    if(tg && (href = tg.getAttribute("href")) && 0 !== href.indexOf("#") )
    {
        e.preventDefault();
        e.stopPropagation();
        console.warn("CLICK: " + href.replace(/^\/+|\/+$/g, ''));
        dataLoad(href.replace(/^\/+|\/+$/g, ''));
        return false;
    }
}


function dataLoad() {
    console.log(arguments);
    var url = './data.json.php', params = [];
    if(arguments.length)
    {
        for (var i = 0, len = arguments.length; i < len; i++)
        {
            if("string" === typeof arguments[i])
                params.push(arguments[i]);
            else
                console.log(typeof arguments[i], arguments[i]);
        }

        if(params.length)
            url += '?' + params.join("&");
    }
    console.warn(url);
    _get(url, dataResponce);
}

function dataResponce(responce) {
    var r;

    if(!responce instanceof Array)
        responce = [responce];

    for (var i = 0, len = responce.length; i < len; i++)
    {
        r = responce[i];


        if(r.selector)
        {
            if(r.template && r.data)
            {
                _(r.selector).innerHTML = Mustache.render(r.template, r);
            }
            else if('undefined' !== typeof r.html)
            {
                _(r.selector).innerHTML = r.html;
            }
            else if('undefined' !== typeof r.text)
            {
                if('undefined' !== typeof document[r.selector])
                {
                    document[r.selector] = r.text;
                }
                else
                {
                    _(r.selector).innerText = r.text;
                }
            }
            else
                console.warn(r);
        }
        else if(r.url)
        {
            history.pushState(r, '', r.url);
        }
        else
            console.error(r);
    }

    //console.log(JSON.stringify(responce, null, '\t'));
}


//////////////////////////
//      A C T I O N     //
//////////////////////////



document.addEventListener('click', _click, true);

var base = 'https://dusty.work/tmp/', href = document.location.href.replace(base,'');
dataLoad(href);















