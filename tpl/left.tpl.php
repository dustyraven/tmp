<div id="filters-accordion" role="tablist" aria-multiselectable="true">
    <form id="filters">

    {{#data}}

        <div class="card">
            <div class="card-header" role="tab" id="filter-heading-{{position}}">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#filters-accordion" href="#filter-collapse-{{position}}" aria-expanded="true" aria-controls="filter-collapse-{{position}}">
                        {{name}}
                    </a>
                    <span tabindex="0" class="tag tag-pill tag-info float-xs-right" role="button" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">?</span>
                </h5>
            </div>

            <div id="filter-collapse-{{position}}" class="collapse" role="tabpanel" aria-labelledby="filter-heading-{{position}}">
                <div class="card-block">
                    {{#values}}
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input filter" type="radio"
                                    name="filter[{{position}}]" value="{{value}}" {{checked}}>
                                 {{name}}
                            </label>
                        </div>
                    {{/values}}
                </div>
            </div>
        </div>

    {{/data}}

    </form>


    {{^data}}
        <a class="" href="/list"><?php echo i18n::_('Products List');?></a>
    {{/data}}
</div>
