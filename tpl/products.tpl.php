<div class="_card-deck-wrapper">
    <div class="_card-deck">

        {{#data}}
        <div class="col-sm-3">
            <div class="card prod" itemscope itemtype="http://schema.org/Product">

                <img class="card-img-top w-100" itemprop="image" src="product.jpg" alt="{{name}}" />

                <div class="card-block">

                    <h3 class="card-title" itemprop="name">{{name}}</h3>

                    <div class="card-text" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        Rated <span itemprop="ratingValue">3.5</span>/5
                        based on <span itemprop="reviewCount">11</span> customer reviews
                    </div>

                    <p class="card-text" itemprop="description">
                        {{description}}
                    </p>

                </div>
                <div class="prod-footer text-xs-center avail-{{availability}}" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <button class="btn btn-outline-success">
                        Order for
                        <span itemprop="priceCurrency" content="{{currency}}" class="currency-{{currency}}"></span>
                        <span itemprop="price" content="{{price}}">{{price}}</span>
                        <link itemprop="availability" href="http://schema.org/{{availability}}" />
                    </button>
                </div>

            </div>
        </div>
        {{/data}}
    </div>
</div>
