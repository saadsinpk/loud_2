class FileHandler{
	//@isThemeBgImage true/false
	//if true that means the image only allowed and it should be theme bg image
	//else its settings layer image that can be image or video


	static renderFileUploadForm(isThemeBgImage=false){
		$("#fileUploadModal").remove()
		const _token = $('meta[name="csrf-token"]').attr('content')

		let htmlForm = ""
		htmlForm += `
			<div class="modal fade" data-backdrop="static" data-keyboard="false" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <form class="modal-content" enctype="multipart/form-data" id="commonFileUploadingForm">
			   	  <input type="hidden" name="_token" value="${_token}">
			      <div class="modal-header">
			        <h5 class="modal-title" id="fileUploadModalLabel">Media Upload</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="d-flex justify-content-center">
			        	<input name="file" type="file" class="form-control" style="min-height: 100px; display: flex; justify-content: center; align-items: center; padding: 38px; background: #ddd;"
			        	onchange="FileHandler.previewFile(${isThemeBgImage})">
			        </div>
			        <div class='preview--file' style="text-align: center; margin-top: 10px; border: 1px solid #ddd; padding: 10px;"></div>

			      </div>
			      <div class="modal-footer">
			      	<button onclick="FileHandler.cancelUpload()" type="button" class="btn btn-danger btn-sm">Cancel</button>
			        <button onclick="FileHandler.uploadFile(${isThemeBgImage})" type="button" class="btn btn-primary btn-sm upload-btn" style="display:none">Upload & Apply</button>
			      </div>
			    </form>
			  </div>
			</div>
		`

		$("body").append(htmlForm)
		$("#fileUploadModal").modal("show")
	}


	static previewFile(isThemeBgImage){
		const file = $("#fileUploadModal input[type='file']").get(0).files[0];

 		$("#fileUploadModal .preview--file").html("")
 		$("#fileUploadModal button.upload-btn").hide()
 		
 		let allow_types = ['image', 'video']
 		if (isThemeBgImage) {
 			allow_types.length = 1//allow only image
 		}

        if(file){

        	const fileType = file.type.split('/')[0]
        	if (!allow_types.includes(fileType)) {
        		if (isThemeBgImage) {
        			alert("Please upload only valid Image file")
        		}else{
        			alert("Please upload only valid Image/Video file")
        		}
        		this.cancelUpload('keep_modal_on')
        		return 
        	}

            var reader = new FileReader();
 
            reader.onload = function(){
                $("#fileUploadModal .preview--file").html(`<img src="" style='max-width:100%;max-height:400px'>`);
                $("#fileUploadModal .preview--file img").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
            $("#fileUploadModal button.upload-btn").show()
        }

		return

	}



	static cancelUpload(doWhat=null){
		if (doWhat !== 'keep_modal_on') {
			$("#fileUploadModal").modal("hide")
		}
		
		$("#fileUploadModal input[type='file']").val('')
		$("#fileUploadModal .preview--file").html('')
		$("#fileUploadModal button.upload-btn").hide()
	}

	static uploadFile(isThemeBgImage){
		if (isThemeBgImage) {
			if (!confirm('This changes will save automatically, so are you sure?')) {
				return
			}
		}
		const fileTypeAllowed = ["image"]
		//post the file to the server

		//then save the file name and id

		//for now save file path
		const fileName = $("#fileUploadModal input[type='file']").get(0).files[0];
		if (fileName == '') {
			alert("Please select a file!")
			return
		}

		//get file type
		let fileType = $("#fileUploadModal input[type='file']").get(0).files[0].type;
		fileType = fileType.split('/')[0]
		console.log(fileType)

		//set sample file for now
		//let defaultFileName = domain_url+"/public/forms_assets/images/montjuic.png"
		if (!fileTypeAllowed.includes(fileType)) {
			alert(`The allowed file types are ${fileTypeAllowed}`)
			return
		}

		$.ajax({
          url: "/forms/upload-file",
          data: new FormData(document.getElementById("commonFileUploadingForm")),
		  method: "POST",
		  dataType: 'JSON',
		  contentType: false,
		  cache: false,
		  processData:false,
          beforeSend:function(){
            $("#form__processing__gif").show()
          },
          success: function(response){
            $("#form__processing__gif").hide()
            //alert("File has been uploaded...")

            //save the file
            let activeItem = null
			let isMyThemesCreated = false
			let shouldExecuteNext = true

			let selectedContents = ContentsHandler.getSelectedContents()
			selectedContents.map((item, index)=>{
				if (item.isActive) {

					if (fileType === 'image') {
						if (isThemeBgImage) {
							//check is this is gallery or myThemes
							if (item.data.theme.type === ThemeHandler.themeTypes[1]) {
								//gallery theme, so save as new theme as myThemes from gallery
								const themeName = $("#right_sidebar input[name='theme_name']")
								if (!themeName.length || themeName.val() == '') {
									alert("Please enter theme name to save changes")
									shouldExecuteNext = false
									return
								}
								item.data.theme.theme.id = Helpers.genUniqID()//add new id
								item.data.theme.theme.name = themeName.val().replace(" ", '_').toLowerCase()
								item.data.theme.theme.title = themeName.val()
								item.data.theme.type = ThemeHandler.themeTypes[0]
								isMyThemesCreated = true
							}
							item.data.theme.theme.themeBGImage = response.imagePath
							item.data.theme.theme.themeBGImageID = response.fileID
						}else{
							item.data.settings.image_or_video_id = response.fileID;
							item.data.settings.image_path = response.filePath;
							item.data.settings.image_brightness = 1;//set default bright 50
							item.data.settings.video_path = null
						}
						
					}else{
						if (isThemeBgImage) {
							item.data.theme.theme.themeBGImage = response.filePath
							item.data.theme.theme.themeBGImageID = response.fileID
						}else{
							item.data.settings.video_path = response.imagePath;
							item.data.settings.image_path = null
						}
						
					}
					activeItem = item
					
				}
			})


			if (!shouldExecuteNext) {
				console.log('No execution more...')
				return
			}

			ContentSettingsHandler.saveSettingChanges(selectedContents)
			if (isMyThemesCreated) {
				//save my theme
				ThemeHandler.saveMyThemes(activeItem.data.theme.theme)
			}else{
				ThemeHandler.updateMyTheme(activeItem)
			}

			//render layer
			if (isThemeBgImage) {
				ContentsHandler.renderLayer(activeItem.id, false)//don't render selected contents
				DesignHandler.renderDesignHTML('editTheme')//only render edit theme part
			}else{
				ContentsHandler.renderLayer(activeItem.id)
			}
			FileHandler.cancelUpload()
			Helpers.changesSavedAlert()

          },
          error: function (jqXHR, textStatus, errorThrown) {
            $("#form__processing__gif").hide()

            let string_to_obj = JSON.parse(jqXHR.responseText)
            if (jqXHR.status === 422) {
               alert(string_to_obj.msg)
            }else{
              alert("Something went wrong, please try again later.")
            }
          },
          complete:function(){
            $("#form__processing__gif").hide()
          }
      	});

	}



	//delete currently uploaded image
	static deleteImage(isThemeBgImage=false){
		if (!confirm('Are you sure?')) {
			return
		}
		//send id to backend to delete image from here
		let activeItem = null
		let selectedContents = ContentsHandler.getSelectedContents()
		
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				activeItem = item
			}
		})

		if (activeItem == null) {
			alert("Something went wrong, the action item not found")
			return
		}
		

		let file_id = null
		if (isThemeBgImage) {
			file_id = activeItem.data.theme.theme.themeBGImageID
		}else{
			file_id = activeItem.data.settings.image_or_video_id
		}

		const _token = $('meta[name="csrf-token"]').attr('content')
		$.ajax({
          url: "/forms/delete-file",
          data: {"fileID":file_id, "_token":_token},
		  method: "POST",
		  dataType: 'JSON',
		  cache: false,
          beforeSend:function(){
            $("#form__processing__gif").show()
          },
          success: function(response){
            $("#form__processing__gif").hide()
            //alert("File has been uploaded...")

            selectedContents.map((item, index)=>{
				if (item.isActive) {
					if (isThemeBgImage) {
						item.data.theme.theme.themeBGImage = null
						item.data.theme.theme.themeBGImageID = null
					}else{
						item.data.settings.image_or_video_id = null
						item.data.settings.image_path = null
						item.data.settings.image_brightness = null
						item.data.settings.video_path = null
						item.data.settings.layer_layout = LayerLayoutHandler.layouts[0]//set default layout
					}
					activeItem = item
				}
			})
			ContentSettingsHandler.saveSettingChanges(selectedContents)

			if (isThemeBgImage) {
				ContentsHandler.renderLayer(activeItem.id, false)//don't render selected content list
				DesignHandler.renderDesignHTML('editTheme')//only render edit theme part
				ThemeHandler.updateMyTheme(activeItem)
			}else{
				//render layer
				ContentsHandler.renderLayer(activeItem.id)
			}
			Helpers.changesSavedAlert()

          },
          error: function (jqXHR, textStatus, errorThrown) {
            $("#form__processing__gif").hide()

            let string_to_obj = JSON.parse(jqXHR.responseText)
            if (jqXHR.status === 422) {
               alert(string_to_obj.msg)
            }else{
              alert("Something went wrong, please try again later.")
            }
          },
          complete:function(){
            $("#form__processing__gif").hide()
          }
      	});

	}

}