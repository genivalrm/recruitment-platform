<section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
        <div class="mdl-grid pd-tb-60 not-archived-section">
            @include('card-section', ['profiles' => $not_archived])
        </div>
    </div>      
</section>
<section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
        <div class="mdl-grid pd-tb-60 archived-section">
            @include('card-section', ['profiles' => $archived])
        </div>
    </div> 
</section>
            