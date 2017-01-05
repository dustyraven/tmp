{{#data}}

    <div class="col-xs-12 product" itemscope itemtype="http://schema.org/Product">

        <h1 class="col-xs-12" itemprop="name">{{name}}</h1>

        <div id="product-caroucel" class="carousel slide col-sm-6" _data-ride="carousel">
            <ol class="carousel-indicators">
                {{#images}}
                    <li data-target="#product-caroucel" data-slide-to="{{index}}"{{#active}} class="active"{{/active}}></li>
                {{/images}}
            </ol>
            <div class="carousel-inner" role="listbox">
                {{#images}}
                    <div class="carousel-item{{#active}} active{{/active}}">
                        <img class="img-fluid" itemprop="image" src="img/{{src}}" alt="{{alt}}">
                    </div>
                {{/images}}
            </div>
            <a class="left carousel-control" href="#product-caroucel" role="button" data-slide="prev">
                <span class="icon-prev" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#product-caroucel" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <div class="col-sm-6">

            <ul class="list-group">
                {{#parameters}}
                    <li class="list-group-item">{{key}}: {{val}}</li>
                {{/parameters}}
            </ul>

            <div class="rating col-xs-12 text-xs-center" title="{{rating}}/5 ({{votes}})" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>
                <meta itemprop="ratingValue" content="{{rating}}">
                <meta itemprop="reviewCount" content="{{votes}}">
            </div>


        </div>

        <div class="col-xs-12">&nbsp;</div>

        <div class="col-xs-12 text-xs-center avail-{{availability}}" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <button class="btn btn-lg btn-outline-success order">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                <span itemprop="priceCurrency" content="{{currency}}" class="currency-{{currency}}"></span>
                <span itemprop="price" content="{{price}}">{{price}}</span>
                <link itemprop="availability" href="http://schema.org/{{availability}}" />
            </button>
        </div>

        <div class="col-xs-12">&nbsp;</div>

        <div class="col-xs-12" itemprop="description">
            {{description}}
        </div>

        <div class="col-xs-12">&nbsp;</div>

        <div class="row col-xs-12">
            <h2>Customer reviews:</h2>
            {{#reviews}}
            <div class="card" itemprop="review" itemscope itemtype="http://schema.org/Review">
                <div class="card-header">
                    <span itemprop="name">{{name}}</span> - by <span itemprop="author">{{author}}</span>,
                    <meta itemprop="datePublished" content="2011-04-01">{{date}}
                </div>
                <div class="card-block">
                    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1">
                        <span itemprop="ratingValue">{{rating}}</span>/<span itemprop="bestRating">5</span>stars
                    </div>
                    <p class="card-text" itemprop="description">{{description}}</p>
                  </div>
            </div>
            {{/reviews}}
        </div>
    </div>

{{/data}}
