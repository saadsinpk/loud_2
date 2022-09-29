class QuestionHandler{	
	// static questionSettings = {
	// 	"welcomeScreen":this.welcomeScreenSettings,
	// 	"multipleChoice":this.multipleChoiceSettings,
	// 	"phoneNumber":this.phoneNumberSettings,
	// 	"shortText":this.shortTextSettings,
	// 	"longText":this.longTextSettings,
	// 	"statement":this.statementSettings,
	// 	"pictureChoice":this.pictureChoiceSettings,
	// 	"ranking":this.rankingSettings,
	// 	"yesNo":this.yesNoSettings,
	// 	"email":this.emailSettings,
	// 	"opinionScale":this.opinionScaleSettings,
	// 	"rating":this.ratingSettings,
	// 	"matrix":this.matrixSettings,
	// 	"date":this.dateSettings,
	// 	"number":this.numberSettings,
	// 	"dropdown":this.dropdownSettings,
	// 	"legal":this.legalSettings,
	// 	"fileUpload":this.fileUploadSettings,
	// 	"website":this.websiteSettings
	// }


	static renderQuestionHTML(){
		if (!$("#main--content-left .left--content-layer-space").length) {
			ContentsHandler.renderLayer()
		}

		let htmlContent = ""
		let dropdownHTML = ""
		let selectedActiveContent = ""
		const selectedContents = ContentsHandler.getSelectedContents()
		let activeContentType = ""
		selectedContents.map((item)=>{
			if (item.isActive) {
				activeContentType = item.type
			}
		})

		ContentsHandler.contentList.map((item, index)=>{
			if (activeContentType === item.type) {
				selectedActiveContent = `
						<button class="btn  dropdown-toggle p-3 w-100" type="button"
							id="questionTabTypeDropdown" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false" style="border:1px solid #000">
							<div class="d-flex justify-content-between align-items-center" id="selected_type">
								<i style="${item.iconColor}" class="${item.icon}"></i>
								<div class="pt-2 px-3" style="font-size:15px;">
									${item.title}
								</div>
								<i class="fas fa-chevron-down float-right pt-3"></i>
							</div>
						</button>
				`
			}else{

				if (item.type === "endScreen") {
					return//endscreens can't be changed
				}
				
				dropdownHTML += `
					<div class="row pt-4" style="cursor:pointer"
					onclick="QuestionHandler.changeType('${item.type}')">
						<div class=" col-2 d-flex justify-content-center align-items-center">
							<i style="${item.iconColor}" class="${item.icon}"></i>
						</div>
						<div class=" col-10 ">
							<h5 class=" text-dark pt-2 pl-2">
								${item.title}
							</h5>
						</div>
					</div>
				`
			}
			
		})


		//load settings html
		//console.log(`Loading settings panel of ${activeContentType}`)
		//const settingsHTML = this.questionSettings[activeContentType]
		//console.log(settingsHTML)
		let settingsHTML = ""
		if (activeContentType === "welcomeScreen") {
			settingsHTML = this.welcomeScreenSettings()
		}else if (activeContentType === "multipleChoice") {
			settingsHTML = this.multipleChoiceSettings()
		}else if (activeContentType === "phoneNumber") {
			settingsHTML = this.phoneNumberSettings()
		}else if (activeContentType === "shortText" || activeContentType === "longText") {
			settingsHTML = this.shortOrLongTextSettings()
		}else if (activeContentType === "statement") {
			settingsHTML = this.statementSettings()
		}else if (activeContentType === "pictureChoice") {
			settingsHTML = this.pictureChoiceSettings()
		}else if (activeContentType === "ranking") {
			settingsHTML = this.rankingSettings()
		}else if (activeContentType === "yesNo") {
			settingsHTML = this.yesNoSettings()
		}else if (activeContentType === "email") {
			settingsHTML = this.emailSettings()
		}else if (activeContentType === "opinionScale") {
			settingsHTML = this.opinionScaleSettings()
		}else if (activeContentType === "rating") {
			settingsHTML = this.ratingSettings()
		}else if (activeContentType === "matrix") {
			settingsHTML = this.matrixSettings()
		}else if (activeContentType === "date") {
			settingsHTML = this.dateSettings()
		}else if (activeContentType === "number") {
			settingsHTML = this.numberSettings()
		}else if (activeContentType === "dropdown") {
			settingsHTML = this.dropdownSettings()
		}else if (activeContentType === "legal") {
			settingsHTML = this.legalSettings()
		}else if (activeContentType === "fileUpload") {
			settingsHTML = this.fileUploadSettings()
		}else if (activeContentType === "website") {
			settingsHTML = this.websiteSettings()
		}else if (activeContentType === "birthday") {
			settingsHTML = this.birthdaySettings()
		}else if (activeContentType === "endScreen") {
			settingsHTML = this.endScreenSettings()
		}

		htmlContent += `
			<div class="container p-0 pt-5">
				<h4 class="pt-4">Type</h4>
				<div class="mt-4 py-2">

					<div class="dropdown">
						${selectedActiveContent}

						<div class="dropdown-menu"
							aria-labelledby="questionTabTypeDropdown">
							<div class="container drop_downscroll">

								${dropdownHTML}
								
							</div>
						</div>
					</div>

				</div>

				<div id="question-settings-block">
					<div class="row mt-5 common_border">
						<h4 class="p-4">Settings</h4>
					</div>
					${settingsHTML}
				</div>
			</div>
		`

		renderRightSidebarContent('question', htmlContent)
		return
	}


	static welcomeScreenSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}


		htmlContent += this.getButtonHTML(data.data.settings.button_text)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)


		return htmlContent
	}

	static multipleChoiceSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Multiple<br>Selection", 'multi_select', data.data.settings.multi_select)
		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getCheckboxHTML("Randomize", 'randomize', data.data.settings.randomize)
		htmlContent += this.getCheckboxHTML("'other' Option", 'other_option', data.data.settings.other_option)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static phoneNumberSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}
	

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		const countries = DataList.countryList()
		const optionsAs = {label:"name", value:"code"}
		htmlContent += this.getSelectHTML("Country", 'country', data.data.settings.country, 'required|in:countries', 'tag:inputList', countries, optionsAs)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	static shortOrLongTextSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}


		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getCheckboxHTML("Max characters", 'max_characters', data.data.settings.max_characters)
		if (data.data.settings.max_characters) {
			htmlContent += this.getInputHTML("Enter max characters", 'max_characters_input', data.data.settings.max_characters_input, "required|number")
		}
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static statementSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}


		htmlContent += this.getCheckboxHTML("Quotation marks", 'quotation_marks', data.data.settings.quotation_marks)
		htmlContent += this.getButtonHTML(data.data.settings.button_text)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static pictureChoiceSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}


		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getCheckboxHTML("Show labels", 'show_labels', data.data.settings.show_labels)
		htmlContent += this.getCheckboxHTML("Superize", 'superize', data.data.settings.superize)
		htmlContent += this.getCheckboxHTML("Multiple<br>Selection", 'multi_select', data.data.settings.multi_select)
		htmlContent += this.getCheckboxHTML("Randomize", 'randomize', data.data.settings.randomize)
		htmlContent += this.getCheckboxHTML("'Other' option", 'other_option', data.data.settings.other_option)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	static rankingSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static yesNoSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static emailSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional|url')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static opinionScaleSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += `<div class="d-flex">`+this.getInputHTML("From", 'from', `${data.data.settings.from}`, 'required|number|min_max', 'number', "0-1")
		htmlContent += this.getInputHTML("To", 'to', data.data.settings.to, 'required|number|min_max', 'number', "5-10")+`</div>`
		htmlContent += this.getInputHTML("First label", 'first_label', data.data.settings.first_label, 'optional')
		htmlContent += this.getInputHTML("Second label", 'second_label', data.data.settings.second_label, 'optional')
		htmlContent += this.getInputHTML("Third label", 'third_label', data.data.settings.third_label, 'optional')
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	static ratingSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		
		let optionsList_ = []
		for (let i = 1; i <= 5; i++) {
			optionsList_.push({label:i, value:i})
		}
		htmlContent += this.getSelectHTML("Points", 'rating_points', data.data.settings.rating_points, "required|in:1-5", "tag:select", optionsList_)
		htmlContent += this.getSelectHTML("Icon", 'selected_rating_icon', data.data.settings.selected_rating_icon, "required|in:icons", "tag:select", data.data.settings.rating_icons)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	static matrixSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getCheckboxHTML("Multiple<br>Selection", 'multi_select', data.data.settings.multi_select)
		
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static dateSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getSelectHTML("Date Format", 'selected_format', data.data.settings.selected_format, "required|in:0-2", "tag:select", data.data.settings.formats)
		htmlContent += this.getSelectHTML("Separator", 'selected_separator', data.data.settings.selected_separator, "required|in:0-2", "tag:select", data.data.settings.separators)
		
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	static numberSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getCheckboxHTML("Min number", 'min_number', data.data.settings.min_number)
		if (data.data.settings.min_number) {
			htmlContent += this.getInputHTML("Enter min number", 'min_number_input', data.data.settings.min_number_input, 'required|number', 'number')
		}
		htmlContent += this.getCheckboxHTML("Max number", 'max_number', data.data.settings.max_number)
		if (data.data.settings.max_number) {
			htmlContent += this.getInputHTML("Enter max number", 'max_number_input', data.data.settings.max_number_input, 'required|number', 'number')
		}
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static dropdownSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getCheckboxHTML("Randomize", 'randomize', data.data.settings.randomize)
		htmlContent += this.getCheckboxHTML("Alpabetical<br>order", 'alpha_order', data.data.settings.alpha_order)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static legalSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static fileUploadSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	static websiteSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static birthdaySettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Required", 'required', data.data.settings.required)
		htmlContent += this.getInputHTML("Title link", 'title_link', data.data.settings.title_link, 'optional')
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}

	static endScreenSettings(){
		let htmlContent = "" 
		let data = null

		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data/active content')
		console.log(data)
		if (data === null) {
			console.log(`Settings data ${data} null`)
			return
		}

		htmlContent += this.getCheckboxHTML("Social share<br>icons", 'social_icons', data.data.settings.social_icons)
		htmlContent += this.getCheckboxHTML("Button", 'show_button', data.data.settings.show_button)
		htmlContent += this.getButtonHTML(data.data.settings.button_text)

		htmlContent += this.getInputHTML("Button link", 'button_link', data.data.settings.button_link, 'optional|url')
		if (data.data.settings.social_icons) {
			htmlContent += this.getInputHTML("Facebook URL", 'social_links_facebook', data.data.settings.social_links_facebook, 'optional|url', "url")
			htmlContent += this.getInputHTML("Twitter URL", 'social_links_twitter', data.data.settings.social_links_twitter, 'optional|url', "url")
			htmlContent += this.getInputHTML("LinkedIn URL", 'social_links_linkedin', data.data.settings.social_links_linkedin, 'optional|url', "url")
			htmlContent += this.getInputHTML("Youtube URL", 'social_links_youtube', data.data.settings.social_links_youtube, 'optional|url', "url")
			htmlContent += this.getInputHTML("Instagram URL", 'social_links_instagram', data.data.settings.social_links_instagram, 'optional|url', "url")
			htmlContent += this.getInputHTML("TikTok URL", 'social_links_tiktok', data.data.settings.social_links_tiktok, 'optional|url', "url")

			htmlContent += this.getInputHTML("Facebook Icon Color", 'social_icons_facebook_color', data.data.settings.social_icons_facebook_color, 'optional', "color")
			htmlContent += this.getInputHTML("Twitter Icon Color", 'social_icons_twitter_color', data.data.settings.social_icons_twitter_color, 'optional', "color")
			htmlContent += this.getInputHTML("LinkedIn Icon Color", 'social_icons_linkedin_color', data.data.settings.social_icons_linkedin_color, 'optional', "color")
			htmlContent += this.getInputHTML("Youtube Icon Color", 'social_icons_youtube_color', data.data.settings.social_icons_youtube_color, 'optional', "color")
			htmlContent += this.getInputHTML("Instagram Icon Color", 'social_icons_instagram_color', data.data.settings.social_icons_instagram_color, 'optional', "color")
			htmlContent += this.getInputHTML("TikTok Icon Color", 'social_icons_tiktok_color', data.data.settings.social_icons_tiktok_color, 'optional', "color")
		}

		
		
		htmlContent += this.getImageOrVideoHTML(data)

		return htmlContent
	}


	//=================================================
	// partial components
	//==================================================
	static getButtonHTML(button_text){
		return `
			<div class="form-group">
				<label>Button</label>
				<input type="text" maxlength="20"
					onkeyup="ContentSettingsHandler.handleSettingsButtons(this, 'set_btn_txt')"
					onchange="ContentSettingsHandler.handleSettingsButtons(this, 'save')"
					class="form-control"
					value="${button_text}" placeholder="Start"
					name="button_text" />
			</div>
		`
	}

	static getInputHTML(label, name, value, validations, tagType=null, min_max=null){
		return `<div class="form-group">
					<label>${label}</label>
					<input type="${tagType?`${tagType}`:`text`}"
						onchange="ContentSettingsHandler.handleSettingsInputs(this, '${validations}')"
						class="form-control w-100"
						name='${name}'
						value="${value?value:``}" placeholder="${label}" 
						${min_max?`min_max="${min_max}"`:``}
						/>
				</div>`
	}

	static getCheckboxHTML(label, name, value){
		return `
			<div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
				<label>${label}</label>
				<label class="switch justify-content-end">
					<input onchange="ContentSettingsHandler.handleSettingsCheckboxes(this)" type="checkbox"
					${value?`checked` : ``}
					name="${name}"
					>
					<span class="slider round"></span>
				</label>
			</div>
		`
	}

	static getSelectHTML(label, name, value, validations, tagType, optionsList, customLabelValueName=null){
		//value should be : tag:inputList | tag:select
		let optionsHTML = ""
		let selected = ""
		optionsList.map((item, index)=>{
			if (customLabelValueName !== null) {
				if (tagType === 'tag:select') {
					if (item[customLabelValueName.value] == value) {
						selected = "selected"
					}else{
						selected = ""
					}
				}
				optionsHTML += `<option ${selected} value="${item[customLabelValueName.value]}">${item[customLabelValueName.label]}</option>`
			}else{
				//default is label & item
				if (item.value == value) {
					selected = "selected"
				}else{
					selected = ""
				}
				optionsHTML += `<option ${selected} value="${item.value}">${item.label} <i class='fas fa-user'></i></option>`
			}
			
		})

		if (tagType === 'tag:inputList') {
			return `
				<div class="form-group">
					<label>${label}</label>
					<input list="my_data_lists" type="text" value="${value?value:''}" class="form-control"
					name="${name}" custom_label="${customLabelValueName.label}" custom_value="${customLabelValueName.value}"
					onchange="ContentSettingsHandler.handleSettingsSelect(this, '${validations}')">
					<datalist id="my_data_lists">
					  ${optionsHTML}
					</datalist>
				</div>
			`
		}else{
			//select tag
			return `
				<div class="form-group">
					<label>${label}</label>
					<select name="${name}" class="form-control"
					onchange="ContentSettingsHandler.handleSettingsSelect(this, '${validations}')">
						${optionsHTML}
					</select>
				</div>
			`
		}
	}


	static getImageOrVideoHTML(data){
		let hasImageOrVideo = false
		const settings = data.data.settings
		if (settings.image_path || settings.video_path) {
			hasImageOrVideo = true
		}

		let htmlData = ""
		htmlData += `
			<div class='form-group'>
				<hr/>
				<div class='pt-5 d-flex justify-content-between align-items-center'>
					<div><label>Image or video</label></div>
					<div class="pt-2" style="display: flex;position:relative;padding-left:5px;">
						${
							hasImageOrVideo ? `
								<button class="nav-link btn btn-light border-0 "
								onclick="FileHandler.renderFileUploadForm()">
									Change
								</button>
								<button class="nav-link btn btn-danger border-0"
								onclick="FileHandler.deleteImage()">
									X
								</button>
							` :
							`
							<button onclick="FileHandler.renderFileUploadForm()" class="nav-link btn btn-primary border-0 add_media_button">
								Add
							</button>
							`
						}
						
						<br>
					</div>
				</div>
			</div>
		`


		//get image brightness controller
		if (settings.image_path) {
			htmlData += this.getImageBrightnessController(data)
		}

		//if has image or video then open layout setting options
		if (settings.video_path || settings.image_path) {
			htmlData += LayerLayoutHandler.getLayoutSettingsHTML(`${settings.layer_layout}`)
			htmlData += LayerLayoutHandler.getLayerCustomizationPanelHTML(settings)
			htmlData += this.getAltTextHTML(data)
		}
		return htmlData
	}

	static getAltTextHTML(data){
		return `
			<hr/>
			<div class="form-group">
				<label>Alt text</label>
				<div class="pt-5">
					<textarea name='alt_text' onchange="Helpers.saveAltText(this.value)" style="height: 81px; margin-top: 0px; margin-bottom: 0px;" class="w-100" maxlength="125" rows="1">${data.data.settings.image_or_video_alt_text?data.data.settings.image_or_video_alt_text : ''}</textarea>
				</div>
			</div>
		`
	}

	static getImageBrightnessController(data){
		let htmlContent = ""
		htmlContent += `
			<hr/>
			<div class="form-group" id="image_brightness_controller_block">
				<label>Brightness</label>
	    		<div class="row pt-5">
					<div class="col-8">
						<input value="${(data.data.settings.image_brightness * 100).toFixed(0)}" onchange="Helpers.changeImageBrightness(this.value)" type="range"
						class="brightness_slider" min='0' max='100'>
					</div>
					<div class="col-4">
						<span class='brightness_value_show'
						style="border: 1px solid #ddd; padding: 5px 10px; border-radius: 5px;">
							${(data.data.settings.image_brightness * 100).toFixed(0)}
						</span>
					</div>
				</div>
			</div>
    	`
    	return htmlContent
	}


	//change active content type
	static changeType(type){
		if (type == "") {
			alert("The type is required")
			return
		}

		//validate type
		let isTypeValid = false
		const disallowed_types = ["endScreen"]

		if (disallowed_types.includes(type)) {
			alert(`The ${type} is not allowed to switch!`)
			return
		}

		ContentsHandler.contentList.map((content, index)=>{
			if (content.type === type) {
				isTypeValid = true
			}
		})
		if (!isTypeValid) {
			alert(`The selected type ${type} is not valid!`)
			return
		}

		//get selected contents
		let selectedContents = ContentsHandler.getSelectedContents()
		let shouldConitnueNext = true
		//if type is welcome screen then
		if (type === "welcomeScreen") {
			//then check is there any welcomeScreen already selected or not
			selectedContents.map((item)=>{
				if (item.type === type) {
					alert(`The ${type} is already selected!`)
					shouldConitnueNext = false
					return
				}
			})
		}

		if (!shouldConitnueNext) {
			return
		}


		//get current active item
		let currentActiveItemType = null
		selectedContents.map((item)=>{
			if (item.isActive) {
				//change the type of active item
				currentActiveItemType = item.type
				item.type = type//update type
				item.data = ContentDataFormats.formats[type]
				localStorage.setItem(selectedContentsStorageName, JSON.stringify(selectedContents));
				
				//check outcome quiz the id and delete if found
				if (currentActiveItemType === "multipleChoice") {
					//then check and delete outcome quiz id
					console.log(`Deleting multipleChoice from outcome ${item.id}`)
					LogicHandler.deleteMultipleChoiceFromOutcomeQuiz(item.id)
				}
				ContentsHandler.renderLayer()//render the active item
				Helpers.changesSavedAlert()
				return
			}
		})

	}

}