<div class="_card-deck-wrapper">
    <div class="_card-deck">

        {{#data}}
        <div class="col-sm-3">
            <div class="card prod" itemscope itemtype="http://schema.org/Product">

                <img class="card-img-top w-100" itemprop="image" src="{{images.0}}" alt="{{name}}" />

                <div class="card-block">

                    <h3 class="card-title" itemprop="name">{{name}}</h3>

                    <div class="card-text rating" title="{{rating}}/5 ({{votes}})" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>
                        <meta itemprop="ratingValue" content="{{rating}}">
                        <meta itemprop="reviewCount" content="{{votes}}">
                    </div>

                    <span itemprop="sku">{{sku}}</span>

                    <p class="card-text" itemprop="description">
                        {{short}}
                    </p>

                </div>

                <div class="prod-footer text-xs-center avail-{{availability}}" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <button class="btn btn-outline-success">
                        Order for
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
