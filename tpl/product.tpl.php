{{#data}}

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


        <!--
        Customer reviews:
        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
            <span itemprop="name">Not a happy camper</span> - by <span itemprop="author">Ellie</span>,
            <meta itemprop="datePublished" content="2011-04-01">April 1, 2011
            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                <meta itemprop="worstRating" content="1">
                <span itemprop="ratingValue">1</span>/<span itemprop="bestRating">5</span>stars
            </div>
            <span itemprop="description">The lamp burned out and now I have to replace it. </span>
        </div>

        <div itemprop="review" itemscope itemtype="http://schema.org/Review">
            <span itemprop="name">Value purchase</span> - by <span itemprop="author">Lucas</span>,
            <meta itemprop="datePublished" content="2011-03-25">March 25, 2011
            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                <meta itemprop="worstRating" content = "1"/>
                <span itemprop="ratingValue">4</span>/<span itemprop="bestRating">5</span>stars
            </div>
            <span itemprop="description">Great microwave for the price. It is small and fits in my apartment.</span>
        </div>
        -->
    </div>

{{/data}}
