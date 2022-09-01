class LayerLayoutHandler{
	static layouts = [
		"layout1",
		"layout2",
		"layout3",
		"layout4",
		"layout5",
		"layout6"
	];

	static changeLayout(layout){
		if (!this.layouts.includes(layout)) {
			alert("Invalid layout type")
			return
		}

		let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				item.data.settings.layer_layout = layout;
			}
		})
		ContentSettingsHandler.saveSettingChanges(selectedContents)

		//render layer
		ContentsHandler.renderLayer()
		Helpers.changesSavedAlert()
	}



	static getLayoutSettingsHTML(activelayoutName){
		if (!this.layouts.includes(activelayoutName)) {
			alert("The layout is invalid!")
			return
		}

		const data = `
			<hr/>
			<div class="form-group">
				<label>Layouts</label>
				<div class="row pt-5">
					<div class="col-12 layout_container">
						<div class="layout ${this.layouts[0]} ${activelayoutName === this.layouts[0] ? 'layout-active' : ''}"
						onclick="LayerLayoutHandler.changeLayout('${this.layouts[0]}')">
							<div></div>
							<div></div>
							<div></div>
						</div>
						<div class="layout ${this.layouts[1]} ${activelayoutName === this.layouts[1] ? 'layout-active' : ''}"
						onclick="LayerLayoutHandler.changeLayout('${this.layouts[1]}')">
							<div>
								<div></div>
								<div></div>
							</div>
							<div></div>
						</div>
						<div class="layout ${this.layouts[2]} ${activelayoutName === this.layouts[2] ? 'layout-active' : ''}"
						onclick="LayerLayoutHandler.changeLayout('${this.layouts[2]}')">
							<div>
								<div></div>
								<div></div>
							</div>
							<div></div>
						</div>
						<div class="layout ${this.layouts[3]} ${activelayoutName === this.layouts[3] ? 'layout-active' : ''}"
						onclick="LayerLayoutHandler.changeLayout('${this.layouts[3]}')">
							<div>
								<div></div>
								<div></div>
							</div>
							<div></div>
						</div>
						<div class="layout ${this.layouts[4]} ${activelayoutName === this.layouts[4] ? 'layout-active' : ''}"
						onclick="LayerLayoutHandler.changeLayout('${this.layouts[4]}')">
							<div>
								<div></div>
								<div></div>
							</div>
							<div></div>
						</div>
						<div class="layout ${this.layouts[5]} ${activelayoutName === this.layouts[5] ? 'layout-active' : ''}"
						onclick="LayerLayoutHandler.changeLayout('${this.layouts[5]}')">
							<div>
								<div></div>
								<div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		`
		return data
	}



	//html layout builder
	static layoutBuilder(box1HTML, box2HTML, box3HTML, data){
		let dataHTML = ""
		let layerBackground = ""
		if (data.data.theme.theme.themeBGImage) {
			layerBackground = `background-color:transparent;background-image:url(${data.data.theme.theme.themeBGImage});background-size:cover;`
		}else{
			layerBackground = `background-color:${data.data.theme.theme.themeBGColor};`
		}


		if (data.data.settings.layer_layout === this.layouts[0]) {
			dataHTML += `
				<div class="content_panel" style="${layerBackground}">

					<div class="boxes_together">
						${box1HTML}
						${box2HTML}
						${box3HTML}
					</div>
				</div>
			`
			return dataHTML
		}

		if (data.data.settings.layer_layout === this.layouts[1] || data.data.settings.layer_layout === this.layouts[3]) {			
			dataHTML += `
				<div class="content_panel" style="flex-direction: row; padding: 0;${layerBackground}" >

					<div class="boxes_together" style='width:50%'>
						${box1HTML}
						${box3HTML}
					</div>
					
					<div style='width:50%; display: flex; justify-content: center; align-items: center;'>
						${box2HTML}
					</div>

				</div>
			`
			return dataHTML
		}


		if (data.data.settings.layer_layout === this.layouts[2] || data.data.settings.layer_layout === this.layouts[4]) {
			dataHTML += `
				<div class="content_panel" style="flex-direction: row; padding: 0;${layerBackground}" >
					<div style='width: 50%; display: flex; justify-content: center; align-items: center;'>
						${box2HTML}
					</div>

					<div class="boxes_together" style='width:50%'>
						${box1HTML}
						${box3HTML}
					</div>
					
				</div>
			`
			return dataHTML
		}



		if (data.data.settings.layer_layout === this.layouts[5]) {
			let file_path_set = null
			const file_path = (data.data.settings.image_path ? data.data.settings.image_path : data.data.settings.video_path)
			
			//priority to settings layout background image
			if (file_path) {
				file_path_set = `background-image:url(${file_path});background-size:cover !important`
			}else{
				file_path_set = layerBackground
			}

			dataHTML += `
				<div class="content_panel" 
				style="${file_path_set}">

					<div class="boxes_together">
						${box1HTML}
						${box3HTML}
					</div>
					
				</div>
			`
			return dataHTML
		}

		return `Error, (${data.data.settings.layer_layout}) no such layout found`
	}

	//layer adjustment settings
	static getLayerCustomizationPanelHTML(settings){
		//console.log("Settings")
		//console.log(settings)
		console.log("layer customzation", settings.layer_customization)
		const aligns = settings.layer_customization.image_or_video_aligns.map((align)=>{
							return `<option ${settings.layer_customization.image_or_video_align === align ? 'selected' : ''} value="${align}">${align}</option>`
						})

		const data = `
			<hr/>
			<div class="form-group">
				<label>Layout Adjustment</label>
				<div class="row pt-5">
					<div class="col-12 layout_container">
						<label>Image/Video Width</label>
						<input type='number' name="image_or_video_width" value="${settings.layer_customization.image_or_video_width}" placeholder="Enter width" class="form-control w-100"
							onchange="LayerLayoutHandler.saveCustomizedLayerData(this)">
						
						<label>Image/Video Height</label>
						<input type='number' name="image_or_video_height" value="${settings.layer_customization.image_or_video_height}" placeholder="Enter height" class="form-control w-100"
						onchange="LayerLayoutHandler.saveCustomizedLayerData(this)">
						
						<label>Select Image/Video Align</label>
						<select name="image_or_video_align" class='form-control' onchange="LayerLayoutHandler.saveCustomizedLayerData(this)">
							${aligns}
						</select>
						
					</div>
				</div>
			</div>
		`
		return data
	}


	static saveCustomizedLayerData(el){
		if ($(el).attr("name") == '') {
			return alert("Invalid Data, The Element Name Not Found")
		}

		let selectedContents = ContentsHandler.getSelectedContents()
		let hasError = false
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				if (!item.data.settings.layer_customization.hasOwnProperty($(el).attr("name"))) {
					alert("Invalid Data")
					hasError = true
					return
				}
				item.data.settings.layer_customization[$(el).attr("name")] = $(el).val() ? $(el).val() : null
			}
		})

		if (hasError) {
			return
		}


		ContentSettingsHandler.saveSettingChanges(selectedContents)

		//render layer
		ContentsHandler.renderLayer()
		Helpers.changesSavedAlert()
	}

}