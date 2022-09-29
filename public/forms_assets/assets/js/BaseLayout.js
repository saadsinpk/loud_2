class BaseLayout{
	static leftContentLayout(){
		const html = `
			<div class="row left--content-layer-space">
               <div class="col-lg-3 col-md-3 col-sm-12 col-12 px-0">
                  <div class="container demo demo1 p-0 pt-5"
                     style="overflow-y: scroll; overflow-x: hidden;">
                     <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 pl-7 ">
                           <h4 class="panel">
                              Content
                           </h4>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                           <!-- Button trigger modal -->
                           <button onclick="ContentsHandler.renderContentList()" type="button" title="Add new Question " class="btn float-right  p-0">
                              <i class="fas fa-plus float-right mr-4 ppp"></i>
                           </button>

                           <div id="renderContentList"></div>
                        </div>
                     </div>
                     

                     <div class="p-3 pt-5" id="list_panel"></div>
                  </div>

                  <div class="container demo demo2 p-0 pt-5" style="overflow-y: scroll; overflow-x: hidden;">
                     <h4 class="panel-title">
                        <a role="button" class="content_a" data-toggle="collapse"
                           data-parent="#accordion" href="#collapseOne5"
                           aria-expanded="true" aria-controls="collapseOne">
                        <span onclick="ContentsHandler.addContent('endScreen')" class="float-right ppp"><i class="fas fa-plus"></i></span>
                        
                        Endings
                        </a>
                     </h4>
                     <div class="container">
                        <div class="row " id="ending_screen_list"></div>
                     </div>
                  </div>
               </div>

               <div class="col-lg-9 col-md-9 col-sm-12 col-12 layer-panel-bg">
                  <div class="container" id="main_content">
                     <div class="row default_theme" id="whatMain"></div>
                  </div>
               </div>
            </div>
		`
		$("#main--content-left").html(html)
	}


	static leftLogicsLayout(){
		const html = `
			<div class="left--logic-flow-space d-flex" style="display: none;background: #FAFAFA;height: 100%;overflow-y:auto;min-height: 350px"></div>
		`
		$("#main--content-left").html(html)
	}

}