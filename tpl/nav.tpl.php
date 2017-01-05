<a class="navbar-brand" href="<?php echo BASE;?>" title="WellMan"></a>

<div style="position:fixed;top:1px;left:1px;z-index:65000;font-size:9px;padding:1px 3px;border-radius:5px;background:#CCC;border:1px solid #aaa">
    <b class="visible-xs hidden-sm-up">XS</b>
    <b class="visible-sm hidden-xs-down hidden-md-up">SM</b>
    <b class="visible-md hidden-sm-down hidden-lg-up">MD</b>
    <b class="visible-lg hidden-md-down hidden-xl-up">LG</b>
    <b class="visible-xl hidden-lg-down">XL</b>
</div>


<button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsingNavbar"
        aria-controls="collapsingNavbar" aria-expanded="false" aria-label="Toggle navigation"></button>

<button id="topCardBtn" class="btn btn-outline-success float-xs-right" type="button">
    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
    <span id="topCardContent"></span>
</button>

<div class="collapse navbar-toggleable-md" id="collapsingNavbar">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/list"><?php echo i18n::_('Products List');?></a>
        </li>

        <li class="nav-item navddtgl">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                <div class="btn-group" role="group">
                    <button id="topNavLang" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="i18n/{{data.lang}}.png" /> {{data.lang}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="topNavLang">
                        {{#data.langs}}
                            <button class="dropdown-item btn btn-link setLang"><img src="i18n/{{.}}.png" />{{.}}</button>
                        {{/data.langs}}
                    </div>
                </div>

                <div class="btn-group" role="group">
                    <button id="topNavCurr" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="img/{{data.currency}}.png" /> {{data.currency}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="topNavCurr">
                        {{#data.currencies}}
                            <button class="dropdown-item btn btn-link _setCurrency"><img src="img/{{.}}.png" />{{.}}</button>
                        {{/data.currencies}}
                    </div>
                </div>

            </div>
        </li>

    </ul>
    <form class="form-inline float-xs-right">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="<?php echo i18n::_('Search');?>">
            <span class="input-group-btn">
                <button class="btn btn-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
        </div>
    </form>
</div>

