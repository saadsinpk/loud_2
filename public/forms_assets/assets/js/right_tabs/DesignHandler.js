class DesignHandler{
	static themeTypes = []
	static currentActiveContent = null
	static currentActiveContentIndex = null//should be integer

	//common method to set theme types
	static findAndSetCurrentActiveContent(){
		//console.log(`Get curret active content`)
		let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				this.currentActiveContent = item
				this.currentActiveContentIndex = index
			}
		})
		this.themeTypes = [...ThemeHandler.themeTypes, "addNewTheme", "editTheme"]
	}


	static renderDesignHTML(type="myThemes"){
		this.findAndSetCurrentActiveContent()
		//render base content layerout
		if (!$("#main--content-left .left--content-layer-space").length) {
			ContentsHandler.renderLayer()
		}

		if (!this.themeTypes.includes(type)) {
			alert("Invalid Type Passed")
			return
		}
		if (!this.currentActiveContent) {
			alert("You don't have any active content, please add new content")
			return
		}


		let htmlContent = ""
		let content = ""
		let activeMyThemes = ""
		let activeGallery = ""
		let addNewThemeHTML = ""
		
		//themes
		if (type === this.themeTypes[0]) {
			//myThemes
			activeMyThemes = "btn-success"
			content = this.renderMyThemes()
			addNewThemeHTML += `
				<div class="add-new-theme mb-3">
					<button onclick="DesignHandler.renderDesignHTML('${this.themeTypes[2]}')" class='btn btn-secondary btn-block'><i class='fas fa-plus'></i> Add new theme</button>
				</div>
			`
		}else if(type === this.themeTypes[1]){
			//gallery
			activeGallery = "btn-success"
			content = this.renderGallery()
		}else if(type === this.themeTypes[2]){
			//add new theme
			content = ThemeHandler.themeCreatingForm()
		}else{
			content = ThemeHandler.editTheme(this.currentActiveContent)
		}


		let buttonTabsHTML = ""
		if (type !== this.themeTypes[2]) {
			 buttonTabsHTML += `
				<div class="d-flex justify-content-between mb-3">
					<div class='w-100'>
						<button onclick="DesignHandler.renderDesignHTML('${this.themeTypes[0]}')" class='btn btn-secondary btn-block ${activeMyThemes}' style="font-size:12px;border-radius:0;padding:5px 2px" >My Themes</button>
					</div>
					<div class='w-100'>
						<button onclick="DesignHandler.renderDesignHTML('${this.themeTypes[1]}')" class='btn btn-secondary btn-block ${activeGallery}' style="font-size:12px;border-radius:0;padding:5px 2px" >Gallery</button>
					</div>
				</div>
			`
		}
		


		htmlContent += `
			<div class="container p-0 pt-5">
				${buttonTabsHTML}
				${addNewThemeHTML}

				<div class="container premium_container" style="padding: 5px 15px 40px 13px">
					${content}					
				</div>
			</div>
		`

		$("#myTabContent #main--content-left .left--content-layer-space").css("display", "block !important")
		$("#myTabContent #main--content-left .left--logic-flow-space").css("display", "none !important")
		renderRightSidebarContent('design', htmlContent)
	}



	static renderMyThemes(){
		let themesHTML = ""
		const myThemesList = ThemeHandler.getMyThemes()
		if (!myThemesList.length > 0) {
			return `
			<div class='d-flex justify-content-center'>
				<div class='text-info'><i class='fas fa-info-circle'></i></div>
				<div style="margin-top:-3px" class='text-danger'><small> No themes available</small></div>
			</div>`
		}

		//check is current active type type is myThemes or not
		let activeThemeID = null
		if (this.currentActiveContent.data.theme.type === this.themeTypes[0]) {
			//active theme type is 'myThemes'
			activeThemeID = this.currentActiveContent.data.theme.theme.id
		}

		//get active one first
		myThemesList.map((item, index)=>{
			if (item.id === activeThemeID) {
				themesHTML += this.renderThemeAsCardHTML(item, activeThemeID, index, this.themeTypes[0])
			}
		})
		myThemesList.map((item, index)=>{
			if (item.id !== activeThemeID) {
				themesHTML += this.renderThemeAsCardHTML(item, activeThemeID, index, this.themeTypes[0])
			}
		})

		return themesHTML
	}



	static renderGallery(){
		let themesHTML = ""

		//check is current active type is gallery or not
		let activeThemeID = null
		if (this.currentActiveContent.data.theme.type === this.themeTypes[1]) {
			//active theme type is 'gallery'
			activeThemeID = this.currentActiveContent.data.theme.theme.id
		}

		//get active one first
		ThemeHandler.themesGallery.map((item, index)=>{
			if (item.id === activeThemeID) {
				themesHTML += this.renderThemeAsCardHTML(item, activeThemeID, index, this.themeTypes[1])
			}
		})
		ThemeHandler.themesGallery.map((item, index)=>{
			if (item.id !== activeThemeID) {
				themesHTML += this.renderThemeAsCardHTML(item, activeThemeID, index, this.themeTypes[1])
			}
		})

		return themesHTML
	}

	static renderThemeAsCardHTML(item, activeThemeID, index, themeType){
		const themesHTML = `
			<div class="row pt-3" style="position:relative">
				<div onclick="DesignHandler.changeTheme('${item.id}', '${themeType}')" class="card ${activeThemeID === item.id ? `active_card` : ``}"
					style="
						width: 18rem;
						background-color:${item.themeBGColor};
						border:${item.themeBorder};
						${item.themeBGImage?
							`
							background-image:url(${item.themeBGImage});
							background-position: center;
							background-size: cover;
							`
							:''
						}

					">
					<div class="card-body">

						<h5 class="card-title question_color"
						style="color:${item.questionColor}">
							${item.questionText}
						</h5>
						<a href="#"> 
							<span class="answer_color" 
							style="color:${item.answerColor}">
							${item.answerText}
							</span>
						</a>

						<div class="row">
							<button type="button" class="btn px-5 py-2 ml-4 mt-4"
							style="background-color:${item.buttonBGColor}">
							</button>
						</div>

						<div class="row">
							<a href="#" class="pl-4 pt-4"
							style="color:${item.questionColor}">
								${item.title}
							</a>
						</div>

					</div>
				</div>


				${activeThemeID === item.id ?
					//active item
					`
					<div class="theme-settings-dropdown">
					  <button class="btn p-0 border-none theme-dropdown" type="button" id="themeDropdownOptions_${index}">
					    <i class='fas fa-ellipsis-h' style="color:${item.buttonBGColor}"></i>
					  </button>
					  <div class="theme-dropdown-list" aria-labelledby="themeDropdownOptions_${index}">
					    ${themeType === this.themeTypes[0]?
					    	//mythemes
					    	`
					    	<a onclick="DesignHandler.renderDesignHTML('editTheme')">Edit</a>
					    	<a onclick="ThemeHandler.duplicateTheme()">Duplicate</a>
					    	`
					    	:`<a onclick="DesignHandler.renderDesignHTML('editTheme')">Edit</a>`
					    }
					    
					  </div>
					</div>
					` : ``
				}

				${activeThemeID !== item.id && themeType === this.themeTypes[0] ?
					//not active & type is my themes then show only delete option
					`
					<div class="theme-settings-dropdown">
					  <button class="btn p-0 border-none theme-dropdown" type="button" id="theme2DropdownOptions_${index}">
					    <i class='fas fa-ellipsis-h' style="color:${item.buttonBGColor}"></i>
					  </button>
					  <div class="theme-dropdown-list" aria-labelledby="theme2DropdownOptions_${index}">
						<a onclick="ThemeHandler.deleteTheme('${item.id}')">Delete</a>					    
					  </div>
					</div>
					` : ``
				}
			</div>
		`
		return themesHTML
	}




	//handle themes
	static changeTheme(themeID, themeType){
		this.findAndSetCurrentActiveContent()
		if (!this.currentActiveContent) {
			alert("You don't have any active content, please add new content")
			return
		}
		//valid valid theme types
		let validThemeTypes = this.themeTypes
		validThemeTypes.length = 2//remove last index
		console.log(`Valid theme types are : ${validThemeTypes}`)
		if (!validThemeTypes.includes(themeType)) {
			alert("Sorry you have invalid theme selected!")
			return
		}

		//check theme validity
		if (this.currentActiveContent.data.theme.type === themeType && this.currentActiveContent.data.theme.theme.id === themeID) {
			console.log('Theme already selected...')
			return //already selected.....
		}


		//update theme
		let isThemeFound = false

		if (themeType === this.themeTypes[0]) {
			//my theme
			const getMyThemes = ThemeHandler.getMyThemes()
			//find the theme
			getMyThemes.map((theme_, index)=>{
				if (theme_.id === themeID) {
					isThemeFound = true
					let selectedContents = ContentsHandler.getSelectedContents()
					selectedContents.map((content, contentIndex)=>{
						if (content.isActive) {
							content.data.theme.type = this.themeTypes[0]
							content.data.theme.theme = theme_
						}
					})

					//save the update
					ContentSettingsHandler.saveSettingChanges(selectedContents)
					ContentsHandler.renderLayer(this.currentActiveContent.id, false)//render only layer...
					DesignHandler.renderDesignHTML(this.themeTypes[0])//render gallery tab
				}
			})

		}else{
			//gallery
			//find the theme
			ThemeHandler.themesGallery.map((theme_, index)=>{
				if (theme_.id === themeID) {
					isThemeFound = true
					let selectedContents = ContentsHandler.getSelectedContents()
					selectedContents.map((content, contentIndex)=>{
						if (content.isActive) {
							content.data.theme.type = this.themeTypes[1]
							content.data.theme.theme = theme_
						}
					})

					//save the update
					ContentSettingsHandler.saveSettingChanges(selectedContents)
					ContentsHandler.renderLayer(this.currentActiveContent.id, false)//render only layer...
					DesignHandler.renderDesignHTML(this.themeTypes[1])//render gallery tab
				}
			})
		}


		//now save data
		if (!isThemeFound) {
			alert("Invalid theme selected, no such theme found")
			return
		}
		//console.log(`Theme has changed to ${themeID}`)
		Helpers.changesSavedAlert()
	}

}