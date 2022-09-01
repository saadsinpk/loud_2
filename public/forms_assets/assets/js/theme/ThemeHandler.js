class ThemeHandler{
	static themeTypes = ["myThemes", "gallery"]

	static fontWeights = ['bold', 'normal']
	static fontStyles = ['italic', 'normal']


	static fontFamilies = [
		{label:"Arial", value:"Arial, Helvetica, sans-serif"},
		{label:"Inter", value:"'Inter', sans-serif"},
		{label:"Manuale", value:"'Manuale', serif"},
	]
	static fontSizes = {
		//elements: such as buttons, checkboxes/radio etc labels
		"types":["SM", "MD", "LG"],
		"SM":{
			"title":'16px',
			"description":'12px',
			"elements":'14px'
		},
		"MD":{
			"title":'18px',
			"description":'14px',
			"elements":'16px'
		},
		"LG":{
			"title":'24px',
			"description":'16px',
			"elements":'20px'
		},
		
	}
	static defaultFontSize = "LG"

	static themesGallery = [
		{
			id:"galler_theme_1",
			title:"Default theme",
			name:"default_theme",
			questionText:"Question",
			answerText:"Answer",
			questionColor:"#000000 !important",
			answerColor:"#0445AF !important",
			buttonBGColor:"#0445af !important",
			buttonTextColor:"#ffffff !important",
			themeTitleColor:"#000000 !important",
			themeBGImage:null,
			themeBGImageID:null,
			themeBGColor:"#ffffff !important",
			themeBorder:"1px solid #EBEDF3",
			fontFamily:this.fontFamilies[0],
			fontSize:this.defaultFontSize,
			titleFontWeight:this.fontWeights[0],//normal or bold
			titleFontStyle:this.fontStyles[1],//normal or italic
			descriptionFontWeight:this.fontWeights[1],//normal or bold
			descriptionFontStyle:this.fontStyles[1],//normal or italic
		},
		{
			id:"galler_theme_2",
			title:"Plain Blue",
			name:"plain_blue",
			questionText:"Question",
			answerText:"Answer",
			questionColor:"#262627 !important",
			answerColor:"#4FB0AE !important",
			buttonBGColor:"#4FB0AE !important",
			buttonTextColor:"#212121 !important",
			themeTitleColor:"#000000 !important",
			themeBGImage:null,
			themeBGImageID:null,
			themeBGColor:"#ffffff !important",
			themeBorder:"1px solid #EBEDF3",
			fontFamily:this.fontFamilies[0],
			fontSize:this.defaultFontSize,
			titleFontWeight:this.fontWeights[0],//normal or bold
			titleFontStyle:this.fontStyles[1],//normal or italic
			descriptionFontWeight:this.fontWeights[1],//normal or bold
			descriptionFontStyle:this.fontStyles[1],//normal or italic
		},
		{
			id:"galler_theme_3",
			title:"Eixample",
			name:"eixample",
			questionText:"Question",
			answerText:"Answer",
			questionColor:"#262627 !important",
			answerColor:"#262627 !important",
			buttonBGColor:"#262627 !important",
			buttonTextColor:"#ffffff !important",
			themeTitleColor:"#000000 !important",
			themeBGImage:domain_url+"/public/forms_assets/images/eixample.png",
			themeBGImageID:null,
			themeBGColor:"#ffffff !important",
			themeBorder:"1px solid #ccc",
			fontFamily:this.fontFamilies[0],
			fontSize:this.defaultFontSize,
			titleFontWeight:this.fontWeights[0],//normal or bold
			titleFontStyle:this.fontStyles[1],//normal or italic
			descriptionFontWeight:this.fontWeights[1],//normal or bold
			descriptionFontStyle:this.fontStyles[1],//normal or italic
		},
		{
			id:"galler_theme_4",
			title:"Montjuic",
			name:"montjuic",
			questionText:"Question",
			answerText:"Answer",
			questionColor:"#262627 !important",
			answerColor:"#262627 !important",
			buttonBGColor:"#262627 !important",
			buttonTextColor:"#ffffff !important",
			themeTitleColor:"#000000 !important",
			themeBGImage:domain_url+"/public/forms_assets/images/montjuic.png",
			themeBGImageID:null,
			themeBGColor:"#ffffff !important",
			themeBorder:"1px solid #ccc",
			fontFamily:this.fontFamilies[0],
			fontSize:this.defaultFontSize,
			titleFontWeight:this.fontWeights[0],//normal or bold
			titleFontStyle:this.fontStyles[1],//normal or italic
			descriptionFontWeight:this.fontWeights[1],//normal or bold
			descriptionFontStyle:this.fontStyles[1],//normal or italic
		},
		{
			id:"galler_theme_5",
			title:"Fractal",
			name:"fractal",
			questionText:"Question",
			answerText:"Answer",
			questionColor:"#FFFFFF !important",
			answerColor:"#FFFFFF !important",
			buttonBGColor:"#F9ADAD !important",
			buttonTextColor:"#ffffff !important",
			themeTitleColor:"#ffffff !important",
			themeBGImage:domain_url+"/public/forms_assets/images/fractal.jfif",
			themeBGImageID:null,
			themeBGColor:"#ffffff !important",
			themeBorder:"1px solid #ccc",
			fontFamily:this.fontFamilies[0],
			fontSize:this.defaultFontSize,
			titleFontWeight:this.fontWeights[0],//normal or bold
			titleFontStyle:this.fontStyles[1],//normal or italic
			descriptionFontWeight:this.fontWeights[1],//normal or bold
			descriptionFontStyle:this.fontStyles[1],//normal or italic
		},
		{
			id:"galler_theme_6",
			title:"Plain Dark",
			name:"plain_dark",
			questionText:"Question",
			answerText:"Answer",
			questionColor:"#262627 !important",
			answerColor:"#0445AF !important",
			buttonBGColor:"#262627 !important",
			buttonTextColor:"#ffffff !important",
			themeTitleColor:"#000000 !important",
			themeBGImage:null,
			themeBGImageID:null,
			themeBGColor:"#ffffff !important",
			themeBorder:"1px solid #EBEDF3",
			fontFamily:this.fontFamilies[0],
			fontSize:this.defaultFontSize,
			titleFontWeight:this.fontWeights[0],//normal or bold
			titleFontStyle:this.fontStyles[1],//normal or italic
			descriptionFontWeight:this.fontWeights[1],//normal or bold
			descriptionFontStyle:this.fontStyles[1],//normal or italic
		}
	]



	//get my themes
	static getMyThemes(){
		//@return type array
		return localStorage.getItem(myThemesStorageName) != '' && localStorage.getItem(myThemesStorageName) != null && localStorage.getItem(myThemesStorageName) != 'null' ? JSON.parse(localStorage.getItem(myThemesStorageName)) : [];
	}
	//save a new single my theme
	static saveMyThemes(newTheme){
		let myThemes = this.getMyThemes()
		myThemes.push(newTheme)
		localStorage.setItem(myThemesStorageName, JSON.stringify(myThemes));
		console.log(`New ${newTheme.id} theme saved as myThemes`)
	}
	//same new whole list of my themes
	static saveMyThemesList(themeList){
		localStorage.setItem(myThemesStorageName, JSON.stringify(themeList));
		console.log(`My Themes list saved`)
	}


	//get the current selected theme
	static getSelectedTheme(){
		//@return type object
		return localStorage.getItem(selectedThemeStorageName) != null ? JSON.parse(localStorage.getItem(selectedThemeStorageName)) : null;
	}

	//create new theme
	static themeCreatingForm(){
		
		const colorPlateStyle = `style="width:40px;padding:3px;"`

		let formHTML = ""

		formHTML += `
			<form>
				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div class='mr-1'>
						<button onclick="DesignHandler.renderDesignHTML()" class='btn p-0' type='button'><i class='fas fa-arrow-left'></i></button>
					</div>
					<div>
						<input type="text" name="theme_name" class="form-control" placeholder="Theme name">
					</div>
				</div>

				<div class="mb-5">
					<button type='button' class='btn btn-secondary btn-block'
					onclick="ThemeHandler.createNewTheme()">Create Theme</button>
				</div>

			</form>
		`
		return formHTML
	}


	static createNewTheme(){
		if (!confirm("Are you sure?")) {
			return
		}

		//save as new theme
		const themeName = $("#right_sidebar input[name='theme_name']")
		if (!themeName.length || themeName.val() == '') {
			alert("Theme name field is required")
			return
		}

		//now create a new blank template theme
		let theme = this.themesGallery[0]
		theme.id =  Helpers.genUniqID()
		theme.title =  themeName.val()
		theme.name =  themeName.val().replace(" ", '_').toLowerCase()
		this.saveMyThemes(theme)

		//active this new theme
		let selectedContents = ContentsHandler.getSelectedContents()
		let activeItem = null
		selectedContents.map((item)=>{
			if (item.isActive) {
				item.data.theme.theme = theme
				item.data.theme.type = this.themeTypes[0]
				activeItem = item
			}
		})
		ContentSettingsHandler.saveSettingChanges(selectedContents)
		
		//render the active layer
		ContentsHandler.renderLayer(activeItem.id, false)//don't render selected contents
		//open the edit panel to edit new created theme
		DesignHandler.renderDesignHTML('editTheme')//only render edit theme part
	}


	static editTheme(activeContent){
		//edit the current active content theme
		if (!activeContent) {
			alert('Something went wrong, we are unable to find active content type!')
			return
		}

		const theme = activeContent.data.theme
		const settings = activeContent.data.settings

		let themeTitle = ""

		if (theme.type === this.themeTypes[0]) {
			//mythemes
			themeTitle = theme.theme.title
		}
		//else create new theme as myThemes by editing gallery theme

		const colorPlateStyle = `style="width:40px;padding:3px;"`

		let formHTML = ""

		let fontFamiliesHTML = ""
		let fontSizeHTML = ""

		this.fontFamilies.map((font)=>{
			if (theme.theme.fontFamily.value === font.value) {
				fontFamiliesHTML += `<option selected value="${font.value}">${font.label}</option>`	
			}else{
				fontFamiliesHTML += `<option value="${font.value}">${font.label}</option>`	
			}
			
		})

		this.fontSizes.types.map((size)=>{
			if (theme.theme.fontSize === size) {
				fontSizeHTML += `<div><input name='fontSize' checked type='radio' class='d-none' value="${size}" id="${size}_fontSize_input" onclick="ThemeHandler.saveThemeChanges()" > <label for="${size}_fontSize_input" style="border:1px solid #ddd;padding:3px;cursor:pointer">${size}</label></div>`	
			}else{
				fontSizeHTML += `<div><input name='fontSize' type='radio' class='d-none' value="${size}" id="${size}_fontSize_input" onclick="ThemeHandler.saveThemeChanges()" > <label for="${size}_fontSize_input" style="padding:3px;cursor:pointer" >${size}</label></div>`	
			}
		})

		formHTML += `
			<form>
				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div class='mr-1'>
						<button onclick="DesignHandler.renderDesignHTML()" class='btn p-0' type='button'><i class='fas fa-arrow-left'></i></button>
					</div>
					<div>
						<input type="text" name="theme_name" class="form-control" placeholder="Theme name" value="${themeTitle}"
						onchange="ThemeHandler.saveThemeChanges()">
					</div>
				</div>

				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div class='mr-1'>
						Font
					</div>
					<div>
						<select class='form-control' name='font'
						onchange="ThemeHandler.saveThemeChanges()">
							${fontFamiliesHTML}
						</select>
					</div>
				</div>

				<div class="mb-3">
					<div class='mr-1'>
						Font Size
					</div>
					<div class="d-flex justify-content-around align-items-center">
						${fontSizeHTML}
					</div>
				</div>

				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div><label>Questions</label></div>
					<div>
						<input type="color" name="questions_color" class="form-control" 
						${colorPlateStyle}
						value="${theme.theme.questionColor.replace(' !important', '')}"
						onchange="ThemeHandler.saveThemeChanges()">
					</div>
				</div>

				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div><label>Answers</label></div>
					<div>
						<input type="color" name="answers_color" class="form-control" 
						${colorPlateStyle}
						value="${theme.theme.answerColor.replace(' !important', '')}"
						onchange="ThemeHandler.saveThemeChanges()">
					</div>
				</div>

				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div><label>Buttons</label></div>
					<div>
						<input type="color" name="buttons_color" class="form-control" 
						${colorPlateStyle}
						value="${theme.theme.buttonBGColor.replace(' !important', '')}"
						onchange="ThemeHandler.saveThemeChanges()">
					</div>
				</div>


				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div><label>Buttons Text</label></div>
					<div>
						<input type="color" name="buttons_text_color" class="form-control" 
						${colorPlateStyle}
						value="${theme.theme.buttonTextColor.replace(' !important', '')}"
						onchange="ThemeHandler.saveThemeChanges()">
					</div>
				</div>

				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div><label>Background</label></div>
					<div>
						<input type="color" name="background_color" class="form-control" 
						${colorPlateStyle}
						value="${theme.theme.themeBGColor.replace(' !important', '')}"
						onchange="ThemeHandler.saveThemeChanges()">
					</div>
				</div>

				<hr>
				<div class="mb-3">
					<div><label>Title Font Weight</label></div>
					<div>
						<select class='form-control' name='title_font_weight'
						onchange="ThemeHandler.saveThemeChanges()">
							<option ${theme.theme.titleFontWeight === this.fontWeights[0] ? `selected` : ``} value='${this.fontWeights[0]}' >${this.fontWeights[0]}</option>
							<option ${theme.theme.titleFontWeight === this.fontWeights[1] ? `selected` : ``} value='${this.fontWeights[1]}' >${this.fontWeights[1]}</option>
						</select>
					</div>
				</div>
				<div class="mb-3">
					<div><label>Title Font Style</label></div>
					<div>
						<select class='form-control' name='title_font_style'
						onchange="ThemeHandler.saveThemeChanges()" style="text-transform: capitalize;">
							<option ${theme.theme.titleFontStyle === this.fontStyles[0] ? `selected` : ``} value='${this.fontStyles[0]}' >${this.fontStyles[0]}</option>
							<option ${theme.theme.titleFontStyle === this.fontStyles[1] ? `selected` : ``} value='${this.fontStyles[1]}' >${this.fontStyles[1]}</option>
						</select>
					</div>
				</div>
				<div class="mb-3">
					<div><label>Description Font Weight</label></div>
					<div>
						<select class='form-control' name='description_font_weight'
						onchange="ThemeHandler.saveThemeChanges()">
							<option ${theme.theme.descriptionFontWeight === this.fontWeights[0] ? `selected` : ``} value='${this.fontWeights[0]}' >${this.fontWeights[0]}</option>
							<option ${theme.theme.descriptionFontWeight === this.fontWeights[1] ? `selected` : ``} value='${this.fontWeights[1]}' >${this.fontWeights[1]}</option>
						</select>
					</div>
				</div>
				<div class="mb-3">
					<div><label>Description Font Style</label></div>
					<div>
						<select class='form-control' name='description_font_style'
						onchange="ThemeHandler.saveThemeChanges()">
							<option ${theme.theme.descriptionFontStyle === this.fontStyles[0] ? `selected` : ``} value='${this.fontStyles[0]}' >${this.fontStyles[0]}</option>
							<option ${theme.theme.descriptionFontStyle === this.fontStyles[1] ? `selected` : ``} value='${this.fontStyles[1]}' >${this.fontStyles[1]}</option>
						</select>
					</div>
				</div>

				<hr>
				<div class="mb-3 d-flex justify-content-between align-items-center">
					<div><label>Background Image</label></div>
					<div>
						${
							theme.theme.themeBGImage ? 
							`
							<span onclick="FileHandler.renderFileUploadForm(true)" style="cursor:pointer" title="Change image"><i class='fas fa-image'></i></span>
							<span onclick="FileHandler.deleteImage(true)" style="cursor:pointer" title="Remove Image"><i class='fas fa-trash-alt'></i></span>
							`
							:
							`<button onclick="FileHandler.renderFileUploadForm(true)" type="button" class='btn p-1' style="border:1px solid #ddd">Add</button>`
						}
					</div>
				</div>
				${
					theme.theme.themeBGImage ?
					`
					<div class='pt-3'>
						<img src="${theme.theme.themeBGImage}" width="70px" height="65px">
					</div>
					`
					: ``
				}

			</form>
		`
		return formHTML
	}

	//save the them
	static saveThemeChanges(){
		//save changes are current active theme
		const themeName = $("#right_sidebar input[name='theme_name']")
		const fontFamily = $("#right_sidebar select[name='font']")
		const fontSize = $("#right_sidebar input[name='fontSize']:checked")
		const questionColor = $("#right_sidebar input[name='questions_color']")
		const answerColor = $("#right_sidebar input[name='answers_color']")
		const buttonBGColor = $("#right_sidebar input[name='buttons_color']")
		const buttonTextColor = $("#right_sidebar input[name='buttons_text_color']")
		const themeBGColor = $("#right_sidebar input[name='background_color']")

		const titleFontWeight = $("#right_sidebar select[name='title_font_weight']")
		const titleFontStyle = $("#right_sidebar select[name='title_font_style']")
		const descriptionFontWeight = $("#right_sidebar select[name='description_font_weight']")
		const descriptionFontStyle = $("#right_sidebar select[name='description_font_style']")

		if (!themeName.length || themeName.val() == '') {
			alert('Theme name field is required')
			return
		}
		if (!fontFamily.length) {
			alert('Font field is required')
			return
		}
		if (!fontSize.length || !this.fontSizes.types.includes(fontSize.val())) {
			alert('Font size field is required')
			return
		}
		if (!questionColor.length) {
			alert('Questions color field is required')
			return
		}
		if (!answerColor.length) {
			alert('Answers color field is required')
			return
		}
		if (!buttonBGColor.length) {
			alert('Buttons color field is required')
			return
		}
		if (!buttonTextColor.length) {
			alert('Button text color field is required')
			return
		}
		if (!themeBGColor.length) {
			alert('Theme background color field is required')
			return
		}

		if (!titleFontWeight.length || !this.fontWeights.includes(titleFontWeight.val())) {
			alert("Title font weight field is required")
			return
		}
		if (!titleFontStyle.length || !this.fontStyles.includes(titleFontStyle.val())) {
			alert("Title font style field is required")
			return
		}

		if (!descriptionFontWeight.length || !this.fontWeights.includes(descriptionFontWeight.val())) {
			alert("Description font weight field is required")
			return
		}
		if (!descriptionFontStyle.length || !this.fontStyles.includes(descriptionFontStyle.val())) {
			alert("Description font style field is required")
			return
		}

		//validate fontFamily
		let fontFamilyIndex = null
		this.fontFamilies.map((font, index)=>{
			if (font.value === fontFamily.val()) {
				fontFamilyIndex = index
			}
		})
		if (fontFamilyIndex === null) {
			alert("The font is invalid")
			return
		}

		let activeItem = null
		let isMyThemesCreated = false

		let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				//colors should be with !important
				item.data.theme.theme.title = themeName.val()
				item.data.theme.theme.name = themeName.val().replace(" ", '_').toLowerCase()
				item.data.theme.theme.questionColor = `${questionColor.val()} !important`
				item.data.theme.theme.answerColor = `${answerColor.val()} !important`
				item.data.theme.theme.buttonBGColor = `${buttonBGColor.val()} !important`
				item.data.theme.theme.buttonTextColor = `${buttonTextColor.val()} !important`
				item.data.theme.theme.themeBGColor = `${themeBGColor.val()} !important`
				
				item.data.theme.theme.fontFamily = this.fontFamilies[fontFamilyIndex]
				item.data.theme.theme.fontSize = fontSize.val()
				item.data.theme.theme.titleFontWeight = titleFontWeight.val()
				item.data.theme.theme.titleFontStyle = titleFontStyle.val()
				item.data.theme.theme.descriptionFontWeight = descriptionFontWeight.val()
				item.data.theme.theme.descriptionFontStyle = descriptionFontStyle.val()

				

				if (item.data.theme.type === this.themeTypes[1]) {
					//gallery theme, so convert to myTheme
					item.data.theme.theme.id = Helpers.genUniqID()//add new id
					item.data.theme.type = this.themeTypes[0]
					isMyThemesCreated = true
				}

				activeItem = item
			}
		})

		//save selected contents
		ContentSettingsHandler.saveSettingChanges(selectedContents)

		//save new theme if created
		if (isMyThemesCreated) {
			//create new my theme
			this.saveMyThemes(activeItem.data.theme.theme)
		}else{
			this.updateMyTheme(activeItem)
		}

		ContentsHandler.renderLayer(activeItem.id, false)//don't render selected contents
		DesignHandler.renderDesignHTML('editTheme')//only render edit theme part
		//console.log('Theme changes saved...')
		Helpers.changesSavedAlert()
	}




	//duplicate theme
	static duplicateTheme(){
		if (!confirm("Are you sure?")) {
			return
		}
		//only theme type 'myThemes' can be duplicate
		//and it will duplicate the current active theme
		
		//get current active content
		let theme = null
		let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				theme = item.data.theme.theme
			}
		})

		if (theme === null) {
			alert("Something went wrong.... the active theme not found")
			return
		}

		//now create a new blank template theme
		let themeTitle = theme.title
		theme.id =  Helpers.genUniqID()
		theme.title = `${themeTitle} Duplicate`
		theme.name =  `${themeTitle.replace(" ", '_').toLowerCase()}_duplicate`
		this.saveMyThemes(theme)

		//now active theme
		let activeItem = null
		selectedContents.map((item)=>{
			if (item.isActive) {
				item.data.theme.theme = theme
				item.data.theme.type = this.themeTypes[0]
				activeItem = item
			}
		})
		ContentSettingsHandler.saveSettingChanges(selectedContents)

		//render the active layer
		ContentsHandler.renderLayer(activeItem.id, false)//don't render selected contents
		//open the edit panel to edit new created theme
		DesignHandler.renderDesignHTML('editTheme')//only render edit theme part
	}


	static deleteTheme(themeID){
		if (themeID == '') {
			alert("Invalid action! theme id is required")
			return
		}
		
		//only theme type 'myThemes' can be delete
		if (!confirm("Are you sure?")) {
			return
		}

		let myThemes = this.getMyThemes()
		if (!myThemes.length) {
			alert("Invalid delete action, there are no themes available!")
			return
		}
		const newMyThemesList = myThemes.filter((item)=>{
			if (item.id !== themeID) {
				return item
			}
		})

		//save new theme list
		this.saveMyThemesList(newMyThemesList)

		DesignHandler.renderDesignHTML(this.themeTypes[0])//only render my themes part
		Helpers.changesSavedAlert("Theme deleted successfully")
	}




	static updateMyTheme(activeItem){
		//update my theme
		let myThemes = this.getMyThemes()
		myThemes.map((theme, index)=>{
			if (theme.id === activeItem.data.theme.theme.id) {
				myThemes[index] = activeItem.data.theme.theme
			}
		})
		this.saveMyThemesList(myThemes)
	}
}