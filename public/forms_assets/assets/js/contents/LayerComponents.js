class LayerComponents{
	static theme = null
	static settings = null
	static fontSize = null
	static layoutList = null//should be an array
	static showKeyboardInstruction = false
	static setData(data){
		//segment data from data to use easily...
		this.theme = data.data.theme.theme
		this.settings = data.data.settings
		this.fontSize = ThemeHandler.fontSizes[this.theme.fontSize]
		
		//set layer list
		this.layoutList = LayerLayoutHandler.layouts
	}

	static box1(data){
		this.setData(data)

		//set box 1 content
		const box1HTML = `
			<div class="box1">
				<div>
					<div class="d-flex">
						${this.settings.hasOwnProperty('quotation_marks') && this.settings.quotation_marks?
							`<div><i style="font-size:${this.fontSize.elements};color:${this.theme.questionColor};font-weight:bold" class='fas fa-quote-left'></i></div>` : ``
						}						
						<input ${this.settings.title_link?`title="Title linked to: ${this.settings.title_link}"`:``} name='title' type="text" placeholder="Say hi! Recall information with @" class="text-center layerHeadingInput" 
							value="${this.settings.title}"
							onchange="ContentSettingsHandler.handleSettingsInputs(this, 'required')"
							style="font-family:${this.theme.fontFamily.value};font-size:${this.fontSize.title};color:${this.theme.questionColor};font-weight:${this.theme.titleFontWeight};font-style:${this.theme.titleFontStyle};${this.settings.title_link?`text-decoration:underline`:``}"
						/>
							${this.settings.hasOwnProperty('required') && this.settings.required?
								`<span style="font-size:25px;color:${this.theme.questionColor};font-weight:bold">*</span>`:``
							}
					</div>
				</div>
				
				<input name='description' type="text" placeholder="Description (optional)" class="text-center layerDescriptionInput" 
					${this.settings.description ? `value="${this.settings.description}"`:`value=""`}
					onchange="ContentSettingsHandler.handleSettingsInputs(this, 'optional')"
					style="font-family:${this.theme.fontFamily.value};font-size:${this.fontSize.description};color:${this.theme.questionColor};font-weight:${this.theme.descriptionFontWeight};font-style:${this.theme.descriptionFontStyle}"
				/>
			</div>
		`
		return box1HTML
	}



	static box2(data){
		this.setData(data)
		let box2HTML = ""
		if (this.settings.image_path || this.settings.video_path) {
			//set box 2 content
			let box2Style = ""
			let box2ImageBoxStyle = ""
			let box2ImgStyle = ""
			//if (this.settings.layer_layout === this.layoutList[3] || this.settings.layer_layout === this.layoutList[4]) {
				//alert(`Layer 3/4`)
				box2Style = `style='position:relative;width:100%'`
				box2ImageBoxStyle = `style='height: 100%; margin: 0; text-align:${this.settings.layer_customization.image_or_video_align};`
				if (this.settings.layer_customization.image_or_video_align === this.settings.layer_customization.image_or_video_aligns[4]) {
					//middle
					box2ImageBoxStyle += `display:flex; justify-content:center;align-items:center`
				}
				box2ImageBoxStyle += "'"

				//style to image/video
				box2ImgStyle = `height: 100%;`
				if (this.settings.layer_customization.image_or_video_width) {
					//width
					box2ImgStyle += `width:${this.settings.layer_customization.image_or_video_width}px;`
				}
				if (this.settings.layer_customization.image_or_video_height) {
					//heigt
					box2ImgStyle += `height:${this.settings.layer_customization.image_or_video_height}px;`
				}

				if (this.settings.layer_customization.image_or_video_align === this.settings.layer_customization.image_or_video_aligns[3]) {
					//middle
					box2ImgStyle += `position:absolute;bottom:0;left:0`
				}
			//}

			box2HTML = `
				<div class="box2" ${box2Style}>
					<div class="upload-image-preview" ${box2ImageBoxStyle}>
						${this.settings.image_path ? `<img src="${this.settings.image_path}" alt="${this.settings.image_or_video_alt_text}" style="${box2ImgStyle}filter:brightness(${this.settings.image_brightness})" >`:''}
						${this.settings.video_path ? `
							<video class="myvideo" alt="${this.settings.image_or_video_alt_text}" style="${box2ImgStyle}">
								<source src="${this.settings.video_path}">
							</video>
							`:''
						}							
					</div>
				</div>
			`
		}
		return box2HTML
	}


	static box3_withButton(data, elements=null, position=null){
		this.setData(data)

		const elementsIn = ["addPhoneElement", "addAnswerElement", "addEmailElement", "addNumberElement", "addDropdownElement", "addWebsiteElement", "addSocialIconsElement", "addDateSelectElement"]
		const positions = ["before", "after"]
		let elementsHTML = null



		if (elements != null) {
			if (!elementsIn.includes(elements)) {
				return `Sorry - Invalid elements (${elements}) requested in box3_withButton`
			}else{
				if (elements === elementsIn[0]) {
					elementsHTML = this.phoneNumberElements()
				}
				if (elements === elementsIn[1]) {
					elementsHTML = this.answerElements()
				}
				if (elements === elementsIn[2]) {
					elementsHTML = this.emailElements()
				}
				if (elements === elementsIn[3]) {
					elementsHTML = this.numberElements()
				}
				if (elements === elementsIn[4]) {
					elementsHTML = this.dropdownElement()
				}
				if (elements === elementsIn[5]) {
					elementsHTML = this.websiteElement()
				}
				if (elements === elementsIn[6]) {
					elementsHTML = this.socialIconsElement()
				}
				if (elements === elementsIn[7]) {
					elementsHTML = this.dateSelectElement()
				}
			}
		}


		//get settingsData
		const settingsData = SettingsHandler.getSettingsData()
		const keyboard_instruction = settingsData.messages.keyboard_instruction

		//set box 3 content
		const box3HTML = `
			<div class="box3" style="padding-top:30px">
				${elementsHTML != null && position === positions[0]?
					`<div class="form-group">
						${elementsHTML}
					</div>`:``
				}

				${this.settings.show_button?
					`<div class="d-flex justify-content-center align-items-center add_choice pt-3">
						<button id="button--button-submit" class="btn font-weight-bold" 
						style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						padding:0.25rem 1rem;
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						"
						>
							${this.settings.button_text}
						</button>
						${this.showKeyboardInstruction ? `
							<span class="question_color" style="color:${this.theme.questionColor}">&nbsp; &nbsp;
								<span style="color:${this.theme.questionColor};font-family:${this.theme.fontFamily.value};">
									${keyboard_instruction}</span> &nbsp;
								<i style="color:${this.theme.questionColor}" class="fas fa-window-restore"></i>
							</span>
						`:``}
						

					</div>`:``
				}
				
			</div>
		`
		return box3HTML
	}


	static box3_withMultiChoice(data){
		this.setData(data)
		let box3HTML = ""
		let optionsHTML = ""
		
		data.data.settings.options.map((option, index)=>{
			optionsHTML += `
				<div class="option_container" style="display: flex;width: 100%;">
					<div class="choice-panel">
						<div class="choice-label">${option.label}</div> &nbsp;
						<div style="display: inline;">
							<input type="text" value="${option.value}" onchange="ContentSettingsHandler.handleMultipleChoice('setOptionValue', '${index}', 'single-choice-input--${index}')"
							id="single-choice-input--${index}">
						</div>
						<button onclick="ContentSettingsHandler.handleMultipleChoice('remove', '${index}')" class="choice-delete-button">
							<span>
								<svg height="10" width="10" preserveAspectRatio="xMidYMin slice" viewBox="0 0 9.2 9.2">
									<path d="M4.6 3.2L7.8 0l1.4 1.4L6 4.6l3.2 3.2-1.4 1.4L4.6 6 1.4 9.2 0 7.8l3.2-3.2L0 1.4 1.4 0l3.2 3.2z"></path>
								</svg>
							</span>
						</button>
					</div>
				</div>
			`
		})

		box3HTML += `
			<div class="box3">
				${optionsHTML}
				<div class="align-items-center add_choice question_color">
					<div onclick="ContentSettingsHandler.handleMultipleChoice('add')" class="mt-10 ml-5" style="font-size: 17px; text-decoration: underline; cursor: pointer; color: blue ;">
						Add Choice
					</div>
				</div>
			</div>
		`
		return box3HTML
	}

	static box3_withPictureChoice(data){
		this.setData(data)
		let box3HTML = ""
		let addPicturesHTML = ""
		for (let i =0; i < this.settings.total_pictures; i++) {
			addPicturesHTML += `
			<div class="picture_select ${this.settings.superize?`super_size`:``}">
				<div onclick="ContentSettingsHandler.handlePictureChoice('open_explorer', '${i}')" class="picture_image"
				id="preview--picture--in--${i}">
					<i class="fas fa-images" style="font-size: 40px; color:green;"></i>
				</div>
				<div class="picture_label" style='display:${this.settings.show_labels?`block`:`none`}'>Choice ${i + 1}</div>
				<button onclick="ContentSettingsHandler.handlePictureChoice('remove')" class="picture-delete-button">
					<span>
						<svg height="10" width="10" preserveAspectRatio="xMidYMin slice" viewBox="0 0 9.2 9.2">
							<path d="M4.6 3.2L7.8 0l1.4 1.4L6 4.6l3.2 3.2-1.4 1.4L4.6 6 1.4 9.2 0 7.8l3.2-3.2L0 1.4 1.4 0l3.2 3.2z"></path>
						</svg>
					</span>
				</button>
				<input hidden onchange="ContentSettingsHandler.handlePictureChoice('preview', '${i}')" type="file"
				id="input--tag--${i}">
			</div>`
		}
		

		box3HTML += `
			<div class="box3">
				${this.settings.multi_select ?
					`<div class="row pt-5">
						<p class="ml-5 multiple_image_selection" style="margin-bottom: -10px;display:block">Choose as many as you like</p>
					</div>`
					:``
				}

				<div class="picture_group flex-wrap mb-10">
					${addPicturesHTML}
					<div class="picture_select ${this.settings.superize?`super_size`:``}">
						<button onclick="ContentSettingsHandler.handlePictureChoice('add')" style="border: none;" class="add_picture_image picture_image">
							<i class="fas fa-plus" style="font-size: 40px; color:green;"></i>
						</button>
					</div>
				</div>
			</div>
		`
		return box3HTML
	}

	static box3_withYesNo(data){
		this.setData(data)
		let box3HTML = ""	

		box3HTML += `
			<div class="box3">
				<div class="option_container" style="display: flex;width: 100%;margin-bottom:100px;margin-top:50px !important">
					<div class="choice-panel">
						<div class="choice-label">Y</div> &nbsp;
						<div style="display: inline;">
							<input type="text" value="Yes" readonly style="outline:none;width:30px;border:none;background-color:transparent">
						</div>
					</div>
					<div class="choice-panel">
						<div class="choice-label">N</div> &nbsp;
						<div style="display: inline;">
							<input type="text" value="No" readonly style="outline:none;width:30px;border:none;background-color:transparent">
						</div>
					</div>
				</div>
			</div>
		`
		return box3HTML
	}


	static box3_withOpinionScale(data){
		this.setData(data)
		let box3HTML = ""
		let scalesHTML = ""
		let from = this.settings.from
		console.log(`From ${from} to ${this.settings.to}`)
		for (let i = this.settings.from; i <= this.settings.to; i++) {
			const width = (100 / this.settings.to)
			scalesHTML += `<div class="option_scale" style="width:${width}%;background-color:${this.theme.buttonBGColor};color:${this.theme.buttonTextColor};border:1px solid ${this.theme.buttonBGColor}">${from}</div>`
			from++
		}

		box3HTML += `
			<div class="box3">
				<div id="opinion_options" class="d-flex justify-content-center mt-20" style="flex-wrap: inherit;margin-bottom:20px;margin-top:50px">
					${scalesHTML}
				</div>
				<div class="d-flex justify-content-between" style="margin-bottom:30px">
					<div style="width:33.33%;text-align:left;color:${this.theme.questionColor};font-size:${this.fontSize.description}">${this.settings.first_label?this.settings.first_label:``}</div>
					<div style="width:33.33%;text-align:center;color:${this.theme.questionColor};font-size:${this.fontSize.description}">${this.settings.second_label?this.settings.second_label:``}</div>
					<div style="width:33.33%;text-align:right;color:${this.theme.questionColor};font-size:${this.fontSize.description}">${this.settings.third_label?this.settings.third_label:``}</div>
				</div>
			</div>
		`
		return box3HTML
	}


	static box3_withRating(data){
		this.setData(data)
		let box3HTML = ""
		let ratingsHTML = ""
		const rating_points = this.settings.rating_points
		console.log(`rating_points ${rating_points}`)
		let selectedIcon = "fa fa-star px-1"
		if (this.settings.selected_rating_icon === "star") {
			selectedIcon = "fa fa-star px-1"
		}else if (this.settings.selected_rating_icon === "lightbulbs") {
			selectedIcon = "fa fa-lightbulb px-1"
		}else if (this.settings.selected_rating_icon === "users") {
			selectedIcon = "fa fa-user px-1"
		}else if (this.settings.selected_rating_icon === "pencil") {
			selectedIcon = "fa fa-pencil-alt px-1"
		}else if (this.settings.selected_rating_icon === "ticks") {
			selectedIcon = "fa fa-check px-1"
		}else{
			return `Invalid rating icon selected!`
		}

		for (let i = 1; i <= this.settings.rating_points; i++) {
			ratingsHTML += `<i class="${selectedIcon}"></i>`
		}

		box3HTML += `
			<div class="box3">
				<div class="d-flex flex-wrap justify-content-center mr-10 mb-40 stars_div" style="flex-wrap: inherit;margin-top:50px">
					${ratingsHTML}
				</div>
			</div>
		`
		return box3HTML
	}


	static box3_withMatrix(data){
		this.setData(data)
		let box3HTML = ""
		let columns = `<th style="color:${this.theme.questionColor}">Row No.</th>`
		let rows = ""
		this.settings.columns.map((col, index)=>{
			columns += `
				<th class="column_with_delete_button">
					<input type="text" name="col" value="${col.label}" placeholder="Enter column name"
					style="border:none;outline:none;background-color:transparent;color:${this.theme.questionColor}"
					onchange="ContentSettingsHandler.handleMatrixInputs(this)"
					data_col_row="columns" data_index_no="${index}" data_action="save" />

					<button class="column-delete-button" style="visibility: visible;"
					onclick="ContentSettingsHandler.handleMatrixInputs(this)"
					data_col_row="columns" data_index_no="${index}" data_action="remove">
						<span>
							<svg height="10" width="10" preserveAspectRatio="xMidYMin slice" viewBox="0 0 9.2 9.2">
								<path d="M4.6 3.2L7.8 0l1.4 1.4L6 4.6l3.2 3.2-1.4 1.4L4.6 6 1.4 9.2 0 7.8l3.2-3.2L0 1.4 1.4 0l3.2 3.2z"></path>
							</svg>
						</span>
					</button>
				</th>`
		})

		let rowInputsHTML = ""
		this.settings.rows.map((row, index)=>{
			rowInputsHTML = ""
			for (let i = 1; i <= this.settings.columns.length; i++) {
				rowInputsHTML += `
					<td>
						<input type='${this.settings.multi_select?`checkbox`:`radio`}' name="row_input">
					</td>`
			}

			rows += `
				<tr>
					<td class="row_with_delete_button" style="position:relative;padding-left:20px">
						<input type="text" value="${row.label}"  placeholder="Enter row name"
						style="border:none;outline:none;background-color:transparent;color:${this.theme.questionColor}"
						onchange="ContentSettingsHandler.handleMatrixInputs(this)"
						data_col_row="rows" data_index_no="${index}" data_action="save" />

						<button class="row-delete-button" style="visibility: visible;"
						onclick="ContentSettingsHandler.handleMatrixInputs(this)"
						data_col_row="rows" data_index_no="${index}" data_action="remove">
							<span>
								<svg height="10" width="10" preserveAspectRatio="xMidYMin slice" viewBox="0 0 9.2 9.2">
									<path d="M4.6 3.2L7.8 0l1.4 1.4L6 4.6l3.2 3.2-1.4 1.4L4.6 6 1.4 9.2 0 7.8l3.2-3.2L0 1.4 1.4 0l3.2 3.2z"></path>
								</svg>
							</span>
						</button>
					</td> 
					${rowInputsHTML}
				</tr>
			`
		})

		box3HTML += `
			<div class="box3">
				<div class="d-flex justify-content-end mr-10 mb-10">
					<div class="mt-10 ml-5" style="font-size: 16px; text-decoration: underline; cursor: pointer; color:${this.theme.questionColor} ;"
						onclick="ContentSettingsHandler.handleMatrixInputs(this)"
						data_action="add" data_col_row="columns">
						Add column
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover mt-3">
						<thead>
							${columns}
						</thead>
						<tbody>
							${rows}
						</tbody>
					</table>
				</div>

				<div class="d-flex justify-content-start mb-10">
					<div class="mt-10 ml-5" style="font-size: 16px; text-decoration: underline; cursor: pointer; color:${this.theme.questionColor} ;"
						onclick="ContentSettingsHandler.handleMatrixInputs(this)"
						data_action="add" data_col_row="rows">
						Add row
					</div>
				</div>
			</div>
		`
		return box3HTML
	}



	static box3_withDate(data){
		this.setData(data)
		let box3HTML = ""
		let day = ""
		let month = ""
		let year = ""
		let separatorHTML = ""
		let separator = ""
		let formatHTML = ""

		day = `
			<div class="col-md-3 date-box px-0">
				<div class="question_color" style="color:${this.theme.questionColor}">Day</div>
				<input class="w-75 date-input" type="text" name="" style="color:${this.theme.questionColor};outline-color:${this.theme.questionColor}">
			</div>
		`
		month = `
			<div class="col-md-3 date-box px-0">
				<div class="question_color" style="color:${this.theme.questionColor}">Month</div>
				<input class="w-75 date-input" type="text" name="" style="color:${this.theme.questionColor};outline-color:${this.theme.questionColor}">
			</div>
		`

		year = `
			<div class="col-md-3 date-box px-0">
				<div class="question_color" style="color:${this.theme.questionColor}">Year</div>
				<input class="w-100 ml_minus10 date-input" type="text" name="" style="color:${this.theme.questionColor};outline-color:${this.theme.questionColor}">
			</div>
		`


		if (this.settings.selected_separator == 0) {
			separator = '/'
		}else if (this.settings.selected_separator == 1) {
			separator = '-'
		}else{
			separator = '.'
		}
		separatorHTML = `
			<div class="col-md-1 px-0 question_color" style="display: flex;justify-content: center;align-items: center;">
				<h3 class="date-separator align-self-end" style="color:${this.theme.questionColor}">${separator}</h3>
			</div>
		`

		if (this.settings.selected_format == 0) {
			formatHTML +=  month
			formatHTML +=  separatorHTML
			formatHTML +=  day
			formatHTML +=  separatorHTML
			formatHTML +=  year
		}else if (this.settings.selected_format == 1) {
			formatHTML +=  day
			formatHTML +=  separatorHTML
			formatHTML +=  month
			formatHTML +=  separatorHTML
			formatHTML +=  year
		}else{
			formatHTML +=  year
			formatHTML +=  separatorHTML
			formatHTML +=  month
			formatHTML +=  separatorHTML
			formatHTML +=  day
		}


		//set box 3 content
		box3HTML = `
			<div class="box3" style="padding-top:30px;">
				<div class="row pt-3" style="margin-bottom:100px;margin-top:50px">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="row">
							${formatHTML}
							<div class="col-md-1"></div>
						</div>
					</div>
				</div>
			</div>
		`
		return box3HTML	
	}


	static box3_withLegal(data){
		this.setData(data)
		let box3HTML = ""	

		box3HTML += `
			<div class="box3">
				<div class="option_container" style="display: flex;width: 100%;margin-bottom:100px;margin-top:50px !important">
					<div class="choice-panel">
						<div class="choice-label">A</div> &nbsp;
						<div style="display: inline;">
							<input type="text" value="I accept" readonly style="outline:none;width:115px;border:none;background-color:transparent;cursor:pointer">
						</div>
					</div>
					<div class="choice-panel">
						<div class="choice-label">B</div> &nbsp;
						<div style="display: inline;">
							<input type="text" value="I don't accept" readonly style="outline:none;width:115px;border:none;background-color:transparent;cursor:pointer">
						</div>
					</div>
				</div>
			</div>
		`
		return box3HTML
	}

	static box3_withFileUpload(data){
		this.setData(data)
		let box3HTML = ""	

		box3HTML += `
			<div class="box3">
				<div class="upload_panel" type="file">
					<div style="margin-bottom: 10px;"><i class="fas fa-upload" style="font-size: 40px; color : lightblue;"></i>
					</div>
					<div>Choose file or drag here</div>
					<div>Size limit: 10MB</div>
				</div>
			</div>
		`
		return box3HTML
	}



	//==============================
	//partial html elements

	static phoneNumberElements(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<div class='mr-3'>
					<i class="fas fa-chevron-down" style="font-size: 15px; color: ${this.theme.questionColor};"></i>
					<span style="color:${this.theme.questionColor}">${this.settings.country?this.settings.country:``}</span>
				</div>
				<div>
					<input type="tel" class="form-control" placeholder="123-456-789" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
					style="border:1px solid ${this.theme.questionColor}">
				</div>
			</div>
		`
	}

	static answerElements(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<textarea class='form-control' row='3' cols="12"
				placeholder="Type your answer here"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
				" readonly>Type your answer here</textarea>
			</div>
		`
	}

	static emailElements(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<input class='form-control' placeholder="name@example.com"
				value="name@example.com"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
				" readonly>
			</div>
		`
	}

	static numberElements(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<input class='form-control' placeholder="Type your answer here"
				value="Type your answer here"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
				" readonly>
			</div>
		`
	}


	static dropdownElement(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<select class='form-control' multiple
					style="
						border:1px solid ${this.theme.questionColor};
						color:${this.theme.answerColor};
						font-size:${this.fontSize.description};
					">
					<option>01</option>
					<option>02</option>
					<option>03</option>
					<option>04</option>
				</select>
			</div>
		`
	}

	static websiteElement(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<input class='form-control' placeholder="https://"
				value="https://"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
				" readonly>
			</div>
		`
	}

	static dateSelectElement(){
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<input type="date" class='form-control'
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
				">
			</div>
		`
	}

	static socialIconsElement(){
		return this.settings.social_icons?`
			<div id="social_icons" class="d-flex justify-content-center pt-0">
				<a href="#" style="padding:10px">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_facebook_color} !important;"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>
				</a>
				<a href="#" style="padding:10px">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_twitter_color} !important;"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path></svg>
				</a>
				<a href="#" style="padding:10px">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_linkedin_color} !important;"><circle cx="4.983" cy="5.009" r="2.188"></circle><path d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z"></path></svg>
				</a>
				<a href="#" style="padding:10px">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_youtube_color} !important;"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"></path></svg>
				</a>
				<a href="#" style="padding:10px">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_instagram_color} !important;"><path d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z"></path><circle cx="11.994" cy="11.979" r="3.003"></circle></svg>
				</a>
				<a href="#" style="padding:10px">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_tiktok_color} !important;"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"></path></svg>
				</a>
			</div>
		`:``
	}

}