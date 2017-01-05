<div class="_card-deck-wrapper">
    <div class="_card-deck">

        {{#data}}
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card prod" itemscope itemtype="http://schema.org/Product">

                <img class="card-img-top w-100" itemprop="image" src="img/{{images.0}}" alt="{{name}}" />

                <div class="card-block">
                    <a href="{{sku}}">
                        <h3 class="card-title" itemprop="name">{{name}}</h3>

                        <span itemprop="sku">{{sku}}</span>

                        <div class="card-text rating" title="{{rating}}/5 ({{votes}})" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>
                            <meta itemprop="ratingValue" content="{{rating}}">
                            <meta itemprop="reviewCount" content="{{votes}}">
                        </div>

                        <p class="card-text" itemprop="description">
                            {{short}}
                        </p>
                    </a>
                </div>

                <div class="prod-footer text-xs-center avail-{{availability}}" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <button class="btn btn-outline-success order">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <span itemprop="priceCurrency" content="{{currency}}" class="currency-{{currency}}"></span>
                        <span itemprop="price" content="{{price}}">{{price}}</span>
                        <link itemprop="availability" href="http://schema.org/{{availability}}">
                    </button>
                </div>

            </div>
        </div>
        {{/data}}
    </div>
</div>
