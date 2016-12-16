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









document.addEventListener('click', function(e) {
    e = e || event;
    var el = e.target || e.srcElement;
    var tg = null, href= null;

    if ((el.nodeName || el.tagName).toLowerCase()==='a'){
        tg = el;
    }
    while (el = el.parentNode){
        if ((el.nodeName || el.tagName).toLowerCase()==='a'){
            tg = el;
        }
    }

    if(tg && (href = tg.getAttribute("href")) )
    {
        e.preventDefault();
        e.stopPropagation();
        console.log(href.replace(/^\/+|\/+$/g, ''));
    }
}, true);


_get('./data.json.php', function(responce) {

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

    console.log(JSON.stringify(responce, null, '\t'));
});














