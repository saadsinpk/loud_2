class ContentSettingsHandler{
	static layerParentRef = "#whatMain"
	static settingsRef = "#question-settings-block"
	static layerTitleRef = ".box1 input[name='title']"
	static layerDesRef = ".box1 input[name='description']"
	static settingsParentRef = "#question-settings-block"
	



	//handle multi choices
	//- add, remove options and options text
	static handleMultipleChoice(actionType, choiceIndexToRemoveOrModify=null, targetInputID=null){
		const actionsIn = ["add", "remove", "setOptionValue"]
		let input = null

		if (!actionsIn.includes(actionType)) {
			alert("The action type is invalid")
			return
		}else{
			if (actionType !== actionsIn[0]) {
				if (choiceIndexToRemoveOrModify == '') {
					alert("The action of selected choice index is invalid")
					return
				}
			}
			if (actionType === actionsIn[2]) {
				if (targetInputID == null) {
					alert("Invalid choice input...")
					return
				}
				input = $(`${this.layerParentRef} #${targetInputID}`)
				if (!input.length || input.val() == '') {
					alert("The choice text is required")
				}
			}
		}

		let selectedContents = ContentsHandler.getSelectedContents()
		let activeItem = null
		let activeItemIndex = null

		if (!selectedContents.length) {
			alert("Invalid Request")
			return
		}

		selectedContents.map((item, index)=>{
			if (item.isActive) {
				activeItem = item
				activeItemIndex = index
			}
		})


		const multipleChoiceLabel = ContentDataFormats.multipleChoiceOptionsLabel
		

		//process the action
		if(actionType === actionsIn[0]){
			//add
			if (selectedContents[activeItemIndex].data.settings.options.length === multipleChoiceLabel.options_max) {
				alert("You have reached the limit of choices")
				return
			}
			const lastChoiceIndex = (selectedContents[activeItemIndex].data.settings.options.length - 1)
			const labelText = multipleChoiceLabel.labels[(lastChoiceIndex+1)]
			const newChoice = {label:labelText, value:'choice'}
			selectedContents[activeItemIndex].data.settings.options.push(newChoice)			

		}else if (actionType === actionsIn[1]) {
			//remove item
			if (!selectedContents[activeItemIndex].data.settings.options.length) {
				alert("Invalid item to remove!")
				return
			}else if (selectedContents[activeItemIndex].data.settings.options.length == 1) {
				console.log(`The last item can't be removed`)
				return
			}

			selectedContents[activeItemIndex].data.settings.options.splice(choiceIndexToRemoveOrModify, 1)//one remove
			//re order the label of indexs
			selectedContents[activeItemIndex].data.settings.options.map((op, index)=>{
				op.label = multipleChoiceLabel.labels[index]
			})
		}else{
			//update valud
			selectedContents[activeItemIndex].data.settings.options[choiceIndexToRemoveOrModify].value = input.val()
		}

		//save changes
		this.saveSettingChanges(selectedContents)
		
		//render layer
		ContentsHandler.renderLayer(activeItem.id, false)//only render layer
		//toast
		Helpers.changesSavedAlert()
	}


	//handle picture choice
	static handlePictureChoice(actionType, targetIndex=null){
		const actionsIn = ["add", "remove", "open_explorer", "preview"]

		if (!actionsIn.includes(actionType)) {
			alert("The action type is invalid")
			return
		}else{
			if (actionType === actionsIn[2] || actionType === actionsIn[3]) {
				if (targetIndex == null) {
					alert("Invalid preview target index")
					return
				}
			}

			if (actionType === actionsIn[2]) {
				$(`${this.layerParentRef} input#input--tag--${targetIndex}`).click()
				return
			}

			if (actionType === actionsIn[3]) {
				//preview the image
				const input = $(`${this.layerParentRef} input#input--tag--${targetIndex}`)
				if (!input.length) {
					alert("The target input not found")
					return
				}
				//console.log(`Target index ${targetIndex}`)
				if (input.val() == '') {
					//console.log('picture value empty')
					$(`${this.layerParentRef} div#preview--picture--in--${targetIndex}`).html(`<i class="fas fa-images" style="font-size: 40px; color:green;"></i>`)
					return
				}
				//read the file
				//console.log('picture value not empty')
				if (!$(`${this.layerParentRef} div#preview--picture--in--${targetIndex}`).length) {
					alert('preview div not found')
				}
				let reader = new FileReader();
	            reader.onload = function(e){
	                $("#preview--picture--in--"+targetIndex).html(`<img src="" width="100%" height="100%">`);
	                $("#preview--picture--in--"+targetIndex+" img").attr("src", e.target.result);
	            }
	 			//console.log(input.get(0).files[0])
	            reader.readAsDataURL(input.get(0).files[0]);
	            return
			}
		}



		let selectedContents = ContentsHandler.getSelectedContents()
		let activeItem = null

		if (!selectedContents.length) {
			alert("Invalid Request")
			return
		}

		let shouldContinueNext = true
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				if (actionType === actionsIn[0]) {
					//add
					item.data.settings.total_pictures = (item.data.settings.total_pictures + 1)//increment one
				}else{
					//remove
					if (item.data.settings.total_pictures > 1) {
						item.data.settings.total_pictures = (item.data.settings.total_pictures - 1)//reduce one...
					}else{
						shouldContinueNext = false
						return//
					}
				}
				activeItem = item
			}
		})

		if (!shouldContinueNext) {
			return//stop execution next...
		}

		//save changes
		this.saveSettingChanges(selectedContents)
		
		//render layer
		ContentsHandler.renderLayer(activeItem.id, false)//only render layer
		//toast
		Helpers.changesSavedAlert()
	}

	//handle matrix input 
	static handleMatrixInputs(a){
		const actionIn = ["save", "remove", "add"]
		const col_rowIn = ["columns", "rows"]

		const action  = $(a).attr("data_action")
		const col_row  = $(a).attr("data_col_row")
		const indexNo  = $(a).attr("data_index_no")

		if (!actionIn.includes(action)) {
			alert("The action type is invalid")
			return
		}

		if (action !== actionIn[2]) {
			if (indexNo == '') {
				alert("The index number is required")
				return
			}
		
			if (action === actionIn[0]) {
				if ($(a).val() == '') {
					alert(`The ${col_row} name is required`)
					return
				}
			}
		}

		if (!col_rowIn.includes(col_row)) {
			alert("The type of column or row is invalid")
			return
		}


		//get current active data
		let selectedContents = ContentsHandler.getSelectedContents()
		let activeItem = null
		let shouldContinueNext = true

		

		if (action === actionIn[1]) {
			//remove index
			selectedContents.map((item, index)=>{
				if (item.isActive) {
					if (item.data.settings[col_row].length == 1 ) {
						console.log(`The last item can't be deleted`)
						shouldContinueNext = false
						return
					}

					if (item.data.settings[col_row][indexNo]) {
						item.data.settings[col_row].splice(indexNo, 1)//remove this col or row
					}else{
						alert(`The target ${col_row} index was invaid!`)
						shouldContinueNext = false
						return
					}
					activeItem = item
				}
			})

		}else if(action === actionIn[2]){
			//add
			selectedContents.map((item, index)=>{
				if (item.isActive) {
					item.data.settings[col_row].push({label:`${col_row === col_rowIn[0] ? `Col `:`Row `} ${item.data.settings[col_row].length+1}`})
					activeItem = item
				}
			})

		}else{
			//save
			selectedContents.map((item, index)=>{
				if (item.isActive) {
					if (item.data.settings[col_row][indexNo]) {
						item.data.settings[col_row][indexNo].label = $(a).val()
					}else{
						alert(`The target ${col_row} index was invaid!`)
						shouldContinueNext = false
						return
					}
					
					activeItem = item
				}
			})
		}


		if (!shouldContinueNext) {
			console.log('Stop continue ...')
			return
		}

		this.saveSettingChanges(selectedContents)
		ContentsHandler.renderLayer(activeItem.id, false)//only render the layer
		Helpers.changesSavedAlert()

	}





	//common moudles
	//====================================================
	static handleSettingsButtons(a, actionType){
		const actionsIn = ["save", 'set_btn_txt']
		const propertyName = $(a).attr('name')

		if (!actionType.includes(actionType)) {
			alert("The action type is invalid")
			return
		}

		if ($(a).val() == '') {
			alert("The button text is required")
			return
		}

		if (actionType === actionsIn[1]) {
			//console.log($(a).val())
			$(`${this.layerParentRef} button#button--button-submit`).html($(a).val())
			return
		}
		
		this.settingsChangesSet(propertyName, $(a).val())

	}

	static handleSettingsInputs(a, validationTypes){
		//multiple validations rules should come as | separator
		//first index should be alwasy "optional", "required"
		const validationTypeList = ["optional", "required", "url", "email", "number", "min_max"]
		const rules_arr = validationTypes.split("|")
		let shouldContinueNext = true

		if (!rules_arr.length) {
			alert("Input validations rules are required!")
			return
		}
		const propertyName = $(a).attr("name")
		if (propertyName == '') {
			alert("Invalid input type/name detected")
			return
		}

		const required_or_not = [validationTypeList[0], validationTypeList[1]]
		if (!required_or_not.includes(rules_arr[0])) {
			alert("The input validation rules are not valid!")
			return
		}else if (rules_arr[0] === validationTypeList[1] && $(a).val() == '') {
			alert(`The ${propertyName} field is required`)
			return
		}
		
		//required field, so validate data
		rules_arr.map((rule)=>{
			if (!validationTypeList.includes(rule)) {
				alert(`Input validations rule ${rule} is invalid`)
				shouldContinueNext = false
				return
			}
			
			if (rule === validationTypeList[2] && $(a).val() != '') {
				//url
				if (!Helpers.isValidURL($(a).val())) {
					alert("Your url is invalid")
					shouldContinueNext = false
					return
				}
			}

			if (rule === validationTypeList[3] && $(a).val() != '') {
				//email
				if (!Helpers.isValidURL($(a).val())) {
					alert("Your email is invalid")
					shouldContinueNext = false
					return
				}
			}

			if (rule === validationTypeList[4] && $(a).val() != '') {
				//number 
				if (!Helpers.isNumber($(a).val())) {
					alert("Please enter only number")
					shouldContinueNext = false
					return
				}				
			}

			if (rule === validationTypeList[5] && $(a).val() != '') {
				//min max format ex: 0-4
				const min_max = $(a).attr("min_max")
				if (min_max == '') {
					alert("Invalid validation rules! the min and max attribute not found!")
					shouldContinueNext = false
					return 
				}

				const min_max_arr = min_max.split('-')
				if (min_max_arr.length !== 2) {
					alert("Invalid validation rules of min and max attribute!")
					shouldContinueNext = false
					return 
				}
				console.log(`min_max_arr ${min_max_arr} | ${min_max_arr[0]} ${min_max_arr[1]}`)

				if (parseInt($(a).val()) < min_max_arr[0]) {
					alert(`The ${propertyName} field value can't be less than ${min_max_arr[0]}`)
					shouldContinueNext = false
					return 
				}
				if (parseInt($(a).val()) > min_max_arr[1]) {
					// console.log($(a).val())
					// console.log(min_max_arr[1])
					alert(`The ${propertyName} field value can't be greater than ${min_max_arr[1]}`)
					shouldContinueNext = false
					return 
				}
			}
		})
		

		if (!shouldContinueNext) {
			return
		}


		let value_ = null
		if ($(a).val() != '') {
			value_ = $(a).val()
		}
		this.settingsChangesSet(propertyName, value_)
		
	}


	static handleSettingsCheckboxes(a){
		const propertyName = $(a).attr('name')
		if ($(a).prop('checked') === true) {
			//save changes
			this.settingsChangesSet(propertyName, true)
		}else{
			this.settingsChangesSet(propertyName, false)
		}
	}


	static handleSettingsSelect(a, validations){
		const valueIn = ["in:countries", "in:icons", "in:1-5", "in:0-2"]
		const validationTypeList = ["optional", "required", ...valueIn]

		const rules_arr = validations.split("|")

		if (!rules_arr.length) {
			alert("Input validations rules are required!")
			return
		}
		const propertyName = $(a).attr("name")
		if (propertyName == '') {
			alert("Invalid input type/name detected")
			return
		}

		const required_or_not = [validationTypeList[0], validationTypeList[1]]
		if (!required_or_not.includes(rules_arr[0])) {
			alert("The input validation rules are not valid!")
			return
		}else if (rules_arr[0] === validationTypeList[1] && $(a).val() == '') {
			alert(`The ${propertyName} field is required`)
			return
		}

		//validate country
		//required field, so validate data
		let shouldContinueNext = true
		rules_arr.map((rule)=>{
			if (!validationTypeList.includes(rule)) {
				alert(`Input validations rule ${rule} is invalid`)
				shouldContinueNext = false
				return
			}
			
			if (rule === valueIn[0] && $(a).val() != '') {
				//validate countries
				let isValidCountry = false
				DataList.countryList().map((country)=>{
					if (country.code === $(a).val()) {
						isValidCountry = true
					}
				})
				if (!isValidCountry) {
					alert("Your country is invalid!")
					shouldContinueNext = false
					return
				}
			}

			if (rule === validationTypeList[3] && $(a).val() != '') {
				//icon
				const rating_object = ContentDataFormats.formats['rating']
				const icons = rating_object.settings.rating_icons
				let isValidIcon = false
				icons.map((icon)=>{
					if (icon.value === $(a).val()) {
						isValidIcon = true
					}
				})
				if (!isValidIcon) {
					alert(`The ${propertyName} field is invalid`)
					shouldContinueNext = false
					return
				}
			}


			if (rule === validationTypeList[4] && $(a).val() != '') {
				//range in:1-5
				if (parseInt($(a).val()) > 5 || parseInt($(a).val()) < 1) {
					alert(`The ${propertyName} field should be between 1 to 5`)
					shouldContinueNext = false
					return
				}
			}

			if (rule === validationTypeList[5] && $(a).val() != '') {
				//range in:0-2
				if (parseInt($(a).val()) > 2 || parseInt($(a).val()) < 0) {
					alert(`The ${propertyName} field value is invalid`)
					shouldContinueNext = false
					return
				}
			}
		})
		

		if (!shouldContinueNext) {
			return
		}

		let value__ = null
		if ($(a).val() != '') {
			value__ = $(a).val()
		}
		this.settingsChangesSet(propertyName, value__)
	}


	static settingsChangesSet(propertyName, value){
		let selectedContents = ContentsHandler.getSelectedContents()
		let activeItem = null
		let shouldContinueNext = true

		selectedContents.map((item, index)=>{
			if (item.isActive) {
				if (item.data.settings.hasOwnProperty(propertyName)) {
					item.data.settings[propertyName] = value
				}else{
					alert(`The target object has no such property ${propertyName}`)
					shouldContinueNext = false
					return
				}
				activeItem = item
			}
		})

		if (!shouldContinueNext) {
			console.log('Stop continue ...')
			return
		}

		this.saveSettingChanges(selectedContents)
		ContentsHandler.renderLayer(activeItem.id, false)//only render the layer
		QuestionHandler.renderQuestionHTML()
		Helpers.changesSavedAlert()
	}


	//save changes
	static saveSettingChanges(list){
		console.log(`Saving Data...`)
		localStorage.setItem(selectedContentsStorageName, JSON.stringify(list));
	}
}
