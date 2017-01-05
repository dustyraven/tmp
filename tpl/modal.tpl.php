<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {{#title}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">{{title}}</h4>
            </div>
            {{/title}}

            <div class="modal-body">
                Some modal body!
            </div>

            {{#footer}}
            <div class="modal-footer">
                {{footer}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            {{/footer}}

        </div>
    </div>
</div>
