class Form{
	constructor(key, id) {
	    this.publishable_key = key;
	    this.targetElementID = id;
	    //clean the local storage
		//localStorage.clear()
	}

	renderForm(){
		//clean the local storage
		localStorage.clear()

		if (document.getElementById(this.targetElementID) != null) {
			console.log(`The target element found`)
			//console.log(document.getElementById(this.targetElementID))
		}else{
			//console.log(`The target element not found ${this.targetElementID}`)
			alert(`The target element not found ${this.targetElementID}`)
			return
		}

		//console.log(`${this.publishable_key} ${this.targetElementID}`)
		let myHeaders = new Headers();
  		//myHeaders.append("Authorization", this.publishable_key);
  		myHeaders.append("Content-Type", "application/json");
  		
	  	const requestOptions = {
	    	method: "POST",
	    	headers: myHeaders,
	    	body: JSON.stringify({
	    		"publishable_key":this.publishable_key
	    	})
	  	};


	  	const theFormIdStorageName = "lara.com.form_features.the-form-id"
	  	const apiHost = FormLayerComponents.apiHostURL
  		fetch(`${apiHost}/api/features/form`, requestOptions)
    	.then((response) => {
    		return response.text()
    	})
	    .then((result) => {
	    	let theForm = JSON.parse(result)
	    	console.log("FormAPI Response: ", theForm)
    		if (theForm.hasOwnProperty("success") && theForm.success === false) {
    			document.getElementById(this.targetElementID).innerHTML = theForm.msg
    		}else{
		    	localStorage.setItem(theFormIdStorageName, theForm.id)
				console.log(`The form id ${theForm.id} | ${localStorage.getItem(theFormIdStorageName)}`)
		      	FormLayerComponents.renderFormAsHTML(result, this.targetElementID, this.publishable_key)
    		}
	    })
    	.catch((error) => console.log("Form Fetch Error: ", error));
	}
}

class FormLayerComponents{
	static theFormID = null
	static elementIDStorageName = "lara.com.form_features.target_element_id"
	static keyStorageName = "lara.com.form_features.publishable_key"
	static formDataStorageName = "lara.com.form_features.form_data"
	static myThemesDataStorageName = "lara.com.form_features.my_themes"
	static settingsDataStorageName = "lara.com.form_features.settings"
	static answersStorageName = "lara.com.form_features.form-responses"
	static navigatingPreStorageName = "lara.com.form_features.layer-navigating-pre"
	static currentLayerAnswersData = null
	static apiHostURL = "https://affiliateambassadorteam.com"
	//static apiHostURL = "http://localhost:8000"
	static fileViewPath = `${this.apiHostURL}/public/uploads/forms_files/response_files`
	static formBranding = "STARKE"
	static showKeyboardInstruction = false
	static layouts = [
		"layout1",
		"layout2",
		"layout3",
		"layout4",
		"layout5",
		"layout6"
	];

	static wrapperElId = "lara-featured-form-the-wrapper-element"//the form parent wrapper id
	static elPrefixClass = "lara-form-"//the form elements prefix class

	//theme designing config data
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

	static theme = null
	static settings = null
	static fontSize = null

	// static getFormId(){
	// 	const storageName = "lara.com.form_features.the-form-id"
	// 	const formId = localStorage.getItem(storageName)
	// 	console.log(`Called GetFormId Method: `, formId)
	// 	return formId
	// }

	
	//form layer renderer
	//================================================
	static renderFormAsHTML(result, elementID_, publishableKey_){
		//set storage data
		result = JSON.parse(result)
		this.theFormID = result.id
		console.log(`${this.elementIDStorageName} | ${this.theFormID}`)

		//const site_id = result.site_id
	    let formData = JSON.parse(result.form_data)
	    let myThemesData = (result.my_themes_data == '' || result.my_themes_data == null ? [] : JSON.parse(result.my_themes_data))
	    let settingsData = JSON.parse(result.settings_data)
	    console.log(formData)//should be array
	    console.log(myThemesData)//should be array
	    console.log(settingsData)//should be an object
	    
	    //set missing properties & make first index active true
	    //console.log(typeof(formData))
	    formData.map((item, index)=>{
	      if (index == 0) {
	      	item.isActive = true;
	      }else{
	      	item.isActive = false;
	      }
	      //set missing outcome
	      if (!item.data.logics.hasOwnProperty('outcome')) {
	        item.data.logics['outcome'] = []
	      }
	    })
	    
	    //convert string to boolean if found...
	    function getObject(theObject) {
	      var result = null;
	      if(theObject instanceof Array) {
	          for(var i = 0; i < theObject.length; i++) {
	              result = getObject(theObject[i]);
	              if (result) {
	                  break;
	              }   
	          }
	      }
	      else
	      {
	          for(var prop in theObject) {
	              //console.log(prop + ': ' + theObject[prop]);
	              //console.log(`${theObject[prop]} value bai`)
	              if(theObject[prop] === 'true' || theObject[prop] === 'false') {
	                  theObject[prop] = (theObject[prop] === 'true'?true:false)
	              }
	              if(theObject[prop] instanceof Object || theObject[prop] instanceof Array) {
	                  result = getObject(theObject[prop]);
	                  if (result) {
	                      break;
	                  }
	              } 
	          }
	      }
	      return result;
	    }
	    getObject(formData)
	    getObject(myThemesData)
	    getObject(settingsData)

	    //set data in local storage
	    localStorage.setItem(this.elementIDStorageName, elementID_)
	    localStorage.setItem(this.keyStorageName, publishableKey_)


	    //rearrange the formData- put all endScreens at the end of array
	    let endScreens = []
	    let othersScreens = []
	    formData.map((item, index)=>{
	    	if (item.type === 'endScreen') {
	    		endScreens.push(item)
	    	}else{
	    		othersScreens.push(item)
	    	}
	    })
	    //put all in new array
	    formData = new Array()
	    othersScreens.map((item)=>{
	    	formData.push(item)
	    })
	    endScreens.map((item)=>{
	    	formData.push(item)
	    })

	    
	    localStorage.setItem(this.formDataStorageName, JSON.stringify(formData))
	    localStorage.setItem(this.myThemesDataStorageName, (myThemesData.length > 0 ? JSON.stringify(myThemesData) : null))
	    localStorage.setItem(this.settingsDataStorageName, JSON.stringify(settingsData))
	    
	    
	    
	    console.log('Parsing done string to boolean')
	    //get styles
	    let styles = this.formStyles()
	    const head = document.getElementsByTagName('head')[0];
	    head.insertAdjacentHTML("beforeend", styles)

	    this.renderLayer()//render the current active layer/question
	    
	    //console.log(this.formDataStorageName)
	    //console.log(localStorage.getItem(this.formDataStorageName))
	    //console.log(localStorage.getItem(this.myThemesDataStorageName))
	    //console.log(localStorage.getItem(this.settingsDataStorageName))
	}


	static targetElement(){
		//console.log(localStorage.getItem(this.elementIDStorageName))
		return document.getElementById(localStorage.getItem(this.elementIDStorageName))
	}
	static getPreviousLayers(){
		return localStorage.getItem(this.navigatingPreStorageName) != null ? JSON.parse(localStorage.getItem(this.navigatingPreStorageName)) : []
	}
	static savePreLayers(list){
		localStorage.setItem(this.navigatingPreStorageName, JSON.stringify(list))
		console.log(`List of pre layers`)
		console.log(list)
	}

	//get all items/contents of form data
	static getFormData(){
		//get all form data or []
		//console.log(this.formDataStorageName)
		return localStorage.getItem(this.formDataStorageName) != null ? JSON.parse(localStorage.getItem(this.formDataStorageName)) : [];
	}

	//get target active item
	static getFormDataActiveItem(){
		//get only the isActive=true item else null
		const data = localStorage.getItem(this.formDataStorageName) != null ? JSON.parse(localStorage.getItem(this.formDataStorageName)) : [];
		let activeFormData = null
		for(let i=0; i < data.length; i++){
			if (data[i].isActive) {
				activeFormData = data[i]
				console.log(`Active layer found: ${data[i].id}`)
				break
			}
		}
		return activeFormData
	}

	//get settings data
	static getSettingsData(){
		return localStorage.getItem(this.settingsDataStorageName) != null ? JSON.parse(localStorage.getItem(this.settingsDataStorageName)) : null;
	}

	//layer navigator
	static layerNavigator(direction, inputValue=null, checkLogics=true){
		const direction_list = ["next", "pre"]
		if (!direction_list.includes(direction)) {
			alert(`The direction ${direction} is invalid!`)
			return
		}

		if (inputValue != null) {
			//save the value first before nevigate
			const res = FormAnswersHandler.handleInputsAnswer(inputValue, true)
			if (res === "dont_navigate") {
				return//don't navigate
			}
		}

		if (checkLogics && direction === direction_list[0]) {
			//check for is required question answer given or not
			const state_ = this.checkIsRequiredQuestionAnswerGiven()
			if (!state_) {
				return;//don't navigate
			}

			//check logics
			FormAnswersHandler.checkIsRulesConditionsSatisfied()
			return
		}

		//check for required question answer
		if (direction === direction_list[0]) {
			const state_ = this.checkIsRequiredQuestionAnswerGiven()
			if (!state_) {
				return;//don't navigate
			}
		}
		

		//get current item
		let formData = this.getFormData()
		for(let i=0; i < formData.length; i++){
			if (formData[i].isActive) {
				if (direction === direction_list[0]) {
					//next
					const nextIndex = i+1
					if (formData[nextIndex]) {
						return this.renderLayer(formData[nextIndex].id)
					}
					//no next item, show popup submit confirmation button
					this.confirmationModal()
					return
				}else{
					//pre
					if (i == 0) {
						console.log(`The 0 index is already rendered!`)
						return
					}

					const preIndex = i-1
					if (formData[preIndex]) {
						const preLayers = this.getPreviousLayers()
						if (preLayers.length) {
							//check is pre layers has reserved
							for(let pre_i=0; pre_i<preLayers.length; pre_i++){
								if (preLayers[pre_i]['question_id'] === formData[i].id) {
									console.log(`has pre layer reserved`)
									this.renderLayer(preLayers[pre_i]['back_to'])
									return
								}
							}
						}
						
						this.renderLayer(formData[preIndex].id)
						return
					}
					console.log(`The pre index item not found`)
					return

				}
			}
		}

	}

	//check for required or not required answers
	static checkIsRequiredQuestionAnswerGiven(){
		const formData = this.getFormData()
		const currentAnswers = FormAnswersHandler.getAnswers();
		let activeItem = null

		for(let i=0; i < formData.length; i++){
			if (formData[i].isActive) {
				activeItem = formData[i]
				break
			}
		}

		//don't allow to go further
		if (!activeItem) {
			alert("Active Screen Not Found")
			return false;
		}

		//check is question is required or not
		if (activeItem.type === "welcomeScreen" || activeItem.type === "endScreen") {
			return true;//no questioin
		}

		if (activeItem.data.settings.hasOwnProperty("required")) {
			if (activeItem.data.settings.required) {
				//check answer has give or not
				let isAnswerGiven = false
				for (let i = 0; i < currentAnswers.length; i++) {
					if (currentAnswers[i].question_id === activeItem.id) {
						isAnswerGiven = true
						break
					}
				}

				if (!isAnswerGiven) {
					alert("The answer is required")
					return false
				}
			}
		}
		return true
	}


	//type should be the active content layer type
	static renderLayer(id=null){
		this.targetElement().innerHTML = "Loading form, please wait..."
		//set current answers data

		//get layers
		let formData = this.getFormData()
		if (!formData.length) {
			console.log(`No form data found`)
			return
		}

		let activeItem = null
		if (id == null) {
			//then get active item
			let activeLayer = this.getFormDataActiveItem()
			if (activeLayer == null) {
				console.log('No active layer found')
				return
			}
			activeItem = activeLayer
		}else{
			//console.log(`Get curret  selected contents`)
			formData.map((item)=>{
				if (item.id === id) {
					item.isActive = true
					activeItem = item
				}else{
					item.isActive = false
				}

			})

			if (activeItem != null) {
				localStorage.setItem(this.formDataStorageName, JSON.stringify(formData));	
			}
			
		}

		//check is active item found or not
		if (activeItem == null) {
			if (id != null) {
				alert("The next layer id is invalid")
			}
			console.log(`Something wrong... no active item found`)
			return
		}

		console.log(`Rendering ${activeItem.id} | ${activeItem.type} layer`)
		//set current layer answers data if found
		const answersData = FormAnswersHandler.getAnswers()
		console.log(`The init- current all answers`)
		console.log(answersData)


		let isAnswerFound = false
		if (answersData.length > 0) {
			//check is there any answers for current rendering question
			answersData.map((answer, answerIndex)=>{
				if (answer.question_id === activeItem.id) {
					this.currentLayerAnswersData = answer
					console.log(`Answer found`)
					console.log(this.currentLayerAnswersData)
					isAnswerFound = true
				}
			})
		}
		if (!isAnswerFound) {
			this.currentLayerAnswersData = null
		}


		let layerContent = `
		<div id="${this.wrapperElId}">
		<div class="toast-featured-form-custom-toster"></div>
		`;
		//set progress if have
		const settingsData = this.getSettingsData()
		layerContent += settingsData.form_branding?this.getFormBranding():``
		layerContent += settingsData.progress_bar?this.getProgressBar():``

		if(activeItem.type === "welcomeScreen"){
			layerContent += this.welcomeScreenLayer();
		}else if (activeItem.type === "multipleChoice") {
			layerContent += this.multipleChoiceLayer();
		}else if (activeItem.type === "phoneNumber") {
			layerContent += this.phoneNumberLayer();
		}else if (activeItem.type === "shortText" || activeItem.type === "longText") {
			layerContent += this.shortOrLongTextLayer();
		}else if (activeItem.type === "statement") {
			layerContent += this.statementLayer();
		}else if (activeItem.type === "pictureChoice") {
			layerContent += this.pictureChoiceLayer();
		}else if (activeItem.type === "ranking") {
			layerContent += this.rankingLayer();
		}else if (activeItem.type === "yesNo") {
			layerContent += this.yesNoLayer();
		}else if (activeItem.type === "email") {
			layerContent += this.emailLayer();
		}else if (activeItem.type === "opinionScale") {
			layerContent += this.opinionScaleLayer();
		}else if (activeItem.type === "rating") {
			layerContent += this.ratingLayer();
		}else if (activeItem.type === "matrix") {
			layerContent += this.matrixLayer();
		}else if (activeItem.type === "date") {
			layerContent += this.dateLayer();
		}else if (activeItem.type === "number") {
			layerContent += this.numberLayer();
		}else if (activeItem.type === "dropdown") {
			layerContent += this.dropdownLayer();
		}else if (activeItem.type === "legal") {
			layerContent += this.legalLayer();
		}else if (activeItem.type === "fileUpload") {
			layerContent += this.fileUploadLayer();
		}else if (activeItem.type === "website") {
			layerContent += this.websiteLayer();
		}else if (activeItem.type === "birthday") {
			layerContent += this.birthdayLayer();
		}else if (activeItem.type === "endScreen") {
			layerContent += this.endScreenLayer();
		}

		layerContent += `</div>`
		this.targetElement().innerHTML = layerContent

		const activeItem_ = this.getFormDataActiveItem()
		console.log(`current active layer`, activeItem_)

		this.appendSubmitBtnInTheActiveScreen()
	}

	//apend submit button in the active screen
	static appendSubmitBtnInTheActiveScreen(){
		const answersData = FormAnswersHandler.getAnswers()
		const activeItem = this.getFormDataActiveItem()
		const formData = this.getFormData()

		if (!answersData.length) {
			return;//if there is no answers yet-- then don't expose submit btn
		}

		//check the current active item is first item or not
		if (activeItem.id === formData[0].id) {
			return;//first item
		}

		if (activeItem.type === "welcomeScreen" || activeItem.type === "statement" || activeItem.type === "legal") {
			return
		}

		const classPrefix = FormLayerComponents.elPrefixClass
		const wrapper_cl = `${classPrefix}--submit-btn-in-screen`
		const submitBtn = `
		<div class="${wrapper_cl}" style="display:flex; justify-content:center;margin-top:20px">
			<button style="
				font-family:${this.theme.fontFamily.value};
				font-size: ${this.fontSize.elements};
				background-color:${this.theme.buttonBGColor};
				color:${this.theme.buttonTextColor};
				display:flex;
				justify-content:space-between;
				text-transform:uppercase;
				"
				onclick="FormAnswersHandler.submitTheForm(true, false, 'Are you Sure? If all questions are not completed, then you will be able to re-answer the remaning questions later, if you submit the form.')">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: ${this.theme.buttonTextColor};"><path d="m21.426 11.095-17-8A1 1 0 0 0 3.03 4.242l1.212 4.849L12 12l-7.758 2.909-1.212 4.849a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81z"></path></svg>
					</div>
					<div>
						Submit
					</div>
				</button>
		</div>`
		
		//console.log(`querySelector: #${this.wrapperElId} .${classPrefix}box3`)
		const targetEl = document.querySelector(`#${this.wrapperElId} .${classPrefix}box3`)
		let html_ = targetEl.innerHTML
		html_ += submitBtn
		targetEl.innerHTML = html_
	}



	//the list of layers
	static welcomeScreenLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		//console.log('The layer data')
		//console.log(data)
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)

	}

	static multipleChoiceLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withMultiChoice(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)

	}



	static phoneNumberLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		//console.log('The layer data')
		//console.log(data)
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, 'addPhoneElement', 'before')
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static shortOrLongTextLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		//console.log('The layer data')
		//console.log(data)
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, 'addAnswerElement', 'before')
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static statementLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		//console.log('The layer data')
		//console.log(data)
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}



	static pictureChoiceLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		//console.log('The layer data')
		//console.log(data)
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withPictureChoice(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
		
	}


	static rankingLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withMultiChoice(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static yesNoLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withYesNo(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static emailLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, "addEmailElement", "before")
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static opinionScaleLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withOpinionScale(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static ratingLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withRating(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static matrixLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withMatrix(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static dateLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withDate(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static numberLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, "addNumberElement", "before")
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static dropdownLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, "addDropdownElement", "before")
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static legalLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withLegal(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static fileUploadLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withFileUpload(data)
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static websiteLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, "addWebsiteElement", "before")
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static birthdayLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, "addDateSelectElement", "before")
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static endScreenLayer(){
		let data = null
		
		//find the element
		this.getFormData().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
	

		//set data's
		const box1HTML = FormLayerComponents.box1(data)
		const box2HTML = FormLayerComponents.box2(data)
		const box3HTML = FormLayerComponents.box3_withButton(data, "addSocialIconsElement", "before")
		

		//build layer layout
		return FormLayerComponents.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}





	/*
	| Layers components related methods
	*/

	//set data for layer component
	static setData(data){
		//segment data from data to use easily...
		this.theme = data.data.theme.theme
		this.settings = data.data.settings
		this.fontSize = this.fontSizes[this.theme.fontSize]
	}


	//form layers components
	static box1(data){
		this.setData(data)

		//set box 1 content
		const box1HTML = `
			<div class="${this.elPrefixClass}box1">
				<div class="${this.elPrefixClass}title-box">
					
					${this.settings.hasOwnProperty('quotation_marks') && this.settings.quotation_marks?
						`<div style="margin-right:8px"><i style="font-size:${this.fontSize.elements};color:${this.theme.questionColor};font-weight:bold" class='fas fa-quote-left'></i></div>` : ``
					}

					${this.settings.title_link?`<a href="${this.settings.title_link}">` :``}					
						<h2 ${this.settings.title_link?`title="Title linked to: ${this.settings.title_link}"`:``} 
						class="${this.elPrefixClass}title"
						style="font-family:${this.theme.fontFamily.value};font-size:${this.fontSize.title};color:${this.theme.questionColor};font-weight:${this.theme.titleFontWeight};font-style:${this.theme.titleFontStyle};${this.settings.title_link?`text-decoration:underline`:``}">
							${this.settings.title}
						</h2>
					${this.settings.title_link?`</a>` : ``}

					${this.settings.hasOwnProperty('required') && this.settings.required?
						`<span style="font-size:25px;color:${this.theme.questionColor};font-weight:bold;margin-left:8px">*</span>`:``
					}
					
				</div>
				<div style="text-align:center;font-family:${this.theme.fontFamily.value};font-size:${this.fontSize.description};color:${this.theme.questionColor};font-weight:${this.theme.descriptionFontWeight};font-style:${this.theme.descriptionFontStyle}">
					${this.settings.description ? `${this.settings.description}` : ``}
				</div>
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
				box2ImgStyle = `max-height: 300px;max-width:100%;`
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
					<div class="${this.elPrefixClass}upload-image-preview" ${box2ImageBoxStyle}>
						${this.settings.image_path ? `<img src="${this.settings.image_path}" alt="${this.settings.image_or_video_alt_text}" style="${box2ImgStyle}filter:brightness(${this.settings.image_brightness});" >`:''}
						${this.settings.video_path ? `
							<video class="myvideo" alt="${this.settings.image_or_video_alt_text}">
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

		//get settingsData
		const settingsData = this.getSettingsData()
		const keyboard_instruction = settingsData.messages.keyboard_instruction


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

		//navigation buttons
		const preNextButtons = this.buildPreAndNextButtons(data)

		//set box 3 content
		const box3HTML = `
			<div class="${this.elPrefixClass}box3">
				${elementsHTML != null && position === positions[0]?
					`<div style="margin-bottom:25px">
						${elementsHTML}
					</div>`:``
				}

				${this.settings.show_button?
					`<div class="${this.elPrefixClass}button-elements"
					style="${elements?`display:none`:``}">
						<div>
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							"
							${
								data.type === "statement"?
								`onclick="FormLayerComponents.layerNavigator('next', 'agreed')"`:
								`onclick="FormLayerComponents.layerNavigator('next')"`
							}
							
							>
								${this.settings.button_text}
							</button>
						</div>

						${FormLayerComponents.showKeyboardInstruction?`
							<div>
								<div style="padding-left:10px;display:flex; align-items:center">
									<div style="margin-right:10px">
										<span style="color:${this.theme.questionColor};font-family:${this.theme.fontFamily.value};">
											${keyboard_instruction}
										</span>
									</div>
									<div>
										<svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: ${this.theme.questionColor};transform: ;msFilter:;"><path d="M20 2H10a2 2 0 0 0-2 2v2h8a2 2 0 0 1 2 2v8h2a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"></path><path d="M4 22h10c1.103 0 2-.897 2-2V10c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2zm2-10h6v2H6v-2zm0 4h6v2H6v-2z"></path></svg>
									</div>
								</div>
							</div>
						`:``}

					</div>`:``
				}



				${elements?
					//show next and pre button
					`
					<div style="display:flex;justify-content:center">
						<div style="margin-right:10px">
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px
							"
							onclick="FormLayerComponents.layerNavigator('pre')"
							>
								${preNextButtons.pre}
							</button>
						</div>
						${preNextButtons.next?`
							<div>
								<button style="
								font-family:${this.theme.fontFamily.value};
								font-size: ${this.fontSize.elements};
								background-color:${this.theme.buttonBGColor};
								color:${this.theme.buttonTextColor};
								padding:10px 15px
								"
								onclick="FormLayerComponents.layerNavigator('next')"
								>
									${preNextButtons.next}
								</button>
							</div>
						`:``}
						
					</div>
					`
					:``
				}

				${data.type === "statement"?
					`
					<div style="display:flex;justify-content:center">
						<div style="margin-top:50px">
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px;
							"
							onclick="FormLayerComponents.layerNavigator('pre')"
							>
								Pre
							</button>
						</div>
					</div>
					`:``
				}
				
			</div>
		`
		return box3HTML
	}


	static box3_withMultiChoice(data){
		this.setData(data)
		let box3HTML = ""
		let optionsHTML = ""
		//console.log(this.currentLayerAnswersData)

		data.data.settings.options.map((option, index)=>{
			optionsHTML += `
				<div class="${this.elPrefixClass}single-option" style="display: flex; width: 100%; align-items: center; margin-bottom: 10px;">
					<div style="margin-right:10px">
						<label class="${this.elPrefixClass}switchable-input">
	                      <input name="option" 
	                      type="${data.data.settings.multi_select?`checkbox`:`radio`}"
	                      id="${this.elPrefixClass}single-choice-input--${index}"
	                      onclick="FormAnswersHandler.handleMultipleChoice(this)"
	                      value="${option.value}"
	                      ${this.currentLayerAnswersData && this.currentLayerAnswersData.response.includes(option.value)?`checked` : ``}>
	                      <span class="${this.elPrefixClass}switch-slider ${this.elPrefixClass}switch-round"></span>
	                    </label>
					</div>
					<div>
						<label for="${this.elPrefixClass}single-choice-input--${index}" style="cursor:pointer">${option.value}</label>
					</div>
				</div>
			`
		})

		//navigation buttons
		const preNextButtons = this.buildPreAndNextButtons(data)
		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				${optionsHTML}
				<div style="display:flex; justify-content:center;padding-top:30px">
					<div style="margin-right:10px">
						<button pre-btn="" style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
						"
						onclick="FormLayerComponents.layerNavigator('pre')">
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button next-btn="" style="
								font-family:${this.theme.fontFamily.value};
								font-size: ${this.fontSize.elements};
								background-color:${this.theme.buttonBGColor};
								color:${this.theme.buttonTextColor};
							"
							onclick="FormLayerComponents.layerNavigator('next')">
								${preNextButtons.next}
							</button>
						</div>
					`:``}
					
				</div>
			</div>
		`
		return box3HTML
	}

	static box3_withPictureChoice(data){
		this.setData(data)
		let box3HTML = ""
		let addPicturesHTML = ""
		const fileViewPath = FormLayerComponents.fileViewPath


		for (let i =0; i < this.settings.total_pictures; i++) {
			addPicturesHTML += `
			<div class="${this.elPrefixClass}picture_select ${this.settings.superize?`${this.elPrefixClass}super_size`:``}"
			style="background-color:${this.theme.buttonBGColor};color:${this.theme.buttonTextColor};border:none">
				<div style="height:100%">
					<label for="${this.elPrefixClass}file--input--tag--${i}" class="${this.elPrefixClass}picture_image"
					id="${this.elPrefixClass}file--input--tag--${i}--preview">
						${this.currentLayerAnswersData && this.currentLayerAnswersData.response[i] ? 
							`<img src="${fileViewPath}/${this.currentLayerAnswersData.response[i]}" style='width:100%;max-height:100%'>`:
							`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: ${this.theme.buttonTextColor};"><path d="M4 5h13v7h2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-2H4V5z"></path><path d="m8 11-3 4h11l-4-6-3 4z"></path><path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path></svg>`
						}
					</label>
				</div>

				<div class="${this.elPrefixClass}picture_label" style='display:${this.settings.show_labels?`block`:`none`}'>Choice ${i + 1}</div>
				${
					this.currentLayerAnswersData && this.currentLayerAnswersData.response[i] ?
					`
					<div onclick="FormAnswersHandler.deleteFormFile('${this.currentLayerAnswersData.response[i]}')" class="${this.elPrefixClass}picture-delete-button"
					style="background:transparent;color:${this.theme.buttonTextColor};border:1px solid ${this.theme.buttonTextColor}">
						<span>
							<svg height="10" width="10" preserveAspectRatio="xMidYMin slice" viewBox="0 0 9.2 9.2" style="fill:${this.theme.buttonTextColor}">
								<path d="M4.6 3.2L7.8 0l1.4 1.4L6 4.6l3.2 3.2-1.4 1.4L4.6 6 1.4 9.2 0 7.8l3.2-3.2L0 1.4 1.4 0l3.2 3.2z"></path>
							</svg>
						</span>
					</div>
					`:``
				}
				
				<input hidden onchange="FormAnswersHandler.filePreviewAndUpload('${this.elPrefixClass}file--input--tag', '${i}')" type="file"
				id="${this.elPrefixClass}file--input--tag--${i}">
			</div>`
		}
		
		const preNextButtons = this.buildPreAndNextButtons(data)
		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				${this.settings.multi_select ?
					`<div class="row pt-5">
						<p class="ml-5 multiple_image_selection" style="margin-bottom: -10px;display:block">Choose as many as you like</p>
					</div>`
					:``
				}

				<div style="display:flex;justify-content:start;align-items:center;flex-wrap:wrap">
					${addPicturesHTML}
				</div>


				<div style="display:flex; justify-content:center;padding-top:30px">
					<div style="margin-right:10px">
						<button pre-btn="" style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
						"
						onclick="FormLayerComponents.layerNavigator('pre')">
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button next-btn="" style="
								font-family:${this.theme.fontFamily.value};
								font-size: ${this.fontSize.elements};
								background-color:${this.theme.buttonBGColor};
								color:${this.theme.buttonTextColor};
							"
							onclick="FormLayerComponents.layerNavigator('next')">
								${preNextButtons.next}
							</button>
						</div>
					`:``}
					
				</div>
			</div>
		`
		return box3HTML
	}

	static box3_withYesNo(data){
		this.setData(data)
		let box3HTML = ""
		const preNextButtons = this.buildPreAndNextButtons(data)

		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				<div style="display:flex;width:100%;;margin-top:10px;justify-content:center">
					<div onclick="FormLayerComponents.layerNavigator('next', 'YES')"
					style="
						${this.currentLayerAnswersData && this.currentLayerAnswersData.response === 'YES'?
							`background-color: ${this.theme.buttonBGColor};color: ${this.theme.buttonTextColor};border:none;`:
							`background-color: transparent !important;color: ${this.theme.answerColor};border:1px solid ${this.theme.buttonBGColor};`
						}
					    box-shadow: ${this.theme.questionColor.replace("!important", "")} 0px 0px 0px 1px inset;
					    width: 100px;
					    padding: 10px;
					    border-radius: 5px;
					    text-align: center;
					    font-weight: 800;
					    cursor:pointer;
					    margin-right:10px;
					">
						YES
					</div>
					<div onclick="FormLayerComponents.layerNavigator('next', 'NO')"
					style="
						${this.currentLayerAnswersData && this.currentLayerAnswersData.response === 'NO'?
							`background-color: ${this.theme.buttonBGColor};color: ${this.theme.buttonTextColor};border:none;`:
							`background-color: transparent !important;color: ${this.theme.answerColor};border:1px solid ${this.theme.buttonBGColor};`
						}
					    width: 100px;
					    padding: 10px;
					    border-radius: 5px;
					    text-align: center;
					    font-weight: 800;
					    cursor:pointer;
					    margin-right:10px;
					">
						NO
					</div>
				</div>

				<div style="display:flex;justify-content:center;margin-top:40px">
					<div>
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
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
			scalesHTML += `
			<div class="${this.elPrefixClass}option_scale" 
			style="cursor:pointer;padding:10px 5px;margin-right:3px;text-align:center;font-size:${this.fontSize.elements};width:${width}%;border:1px solid ${this.theme.buttonBGColor};
			${this.currentLayerAnswersData && this.currentLayerAnswersData.response == from?
				`background-color:transparent !important;color:${this.theme.buttonBGColor}`:
				`background-color:${this.theme.buttonBGColor};color:${this.theme.buttonTextColor}`
			}
			"
			onclick="FormAnswersHandler.handleInputsAnswer('${from}')">${from}</div>`
			from++
		}


		const preNextButtons = this.buildPreAndNextButtons(data)
		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				<div id="${this.elPrefixClass}opinion_options" style="display:flex;justify-content:center;flex-wrap:nowrap;margin-bottom:20px;margin-top:50px">
					${scalesHTML}
				</div>
				<div style="display:flex;justify-content:center;margin-bottom:30px">
					<div style="padding:5px;margin-right:3px;width:33.33%;text-align:left;color:${this.theme.questionColor};font-size:${this.fontSize.description}">${this.settings.first_label?this.settings.first_label:``}</div>
					<div style="padding:5px;margin-right:3px;width:33.33%;text-align:center;color:${this.theme.questionColor};font-size:${this.fontSize.description}">${this.settings.second_label?this.settings.second_label:``}</div>
					<div style="padding:5px;margin-right:3px;width:33.33%;text-align:right;color:${this.theme.questionColor};font-size:${this.fontSize.description}">${this.settings.third_label?this.settings.third_label:``}</div>
				</div>

				<div style="display:flex;justify-content:center">
					<div style="margin-right:10px">
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px
							"
							onclick="FormLayerComponents.layerNavigator('next')"
							>
								${preNextButtons.next}
							</button>
						</div>
					`:``}
					
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

		let selectedIcon = ""
		let fillColor = this.theme.answerColor
		const answer = (this.currentLayerAnswersData? parseInt(this.currentLayerAnswersData.response) : false)

		for (let i = 1; i <= this.settings.rating_points; i++) {
			selectedIcon = ""
			if (answer) {
				if (answer >= i) {
					fillColor = `green !important`
				}else{
					fillColor = this.theme.answerColor
				}
			}
			if (this.settings.selected_rating_icon === "star") {
				selectedIcon = 	`
				<span style="cursor:pointer">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: ${fillColor};"><path d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z"></path></svg>
				</span>`
			}else if (this.settings.selected_rating_icon === "lightbulbs") {
				selectedIcon = `
				<span style="cursor:pointer">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: ${fillColor};"><path d="M9 20h6v2H9zm7.906-6.288C17.936 12.506 19 11.259 19 9c0-3.859-3.141-7-7-7S5 5.141 5 9c0 2.285 1.067 3.528 2.101 4.73.358.418.729.851 1.084 1.349.144.206.38.996.591 1.921H8v2h8v-2h-.774c.213-.927.45-1.719.593-1.925.352-.503.726-.94 1.087-1.363zm-2.724.213c-.434.617-.796 2.075-1.006 3.075h-2.351c-.209-1.002-.572-2.463-1.011-3.08a20.502 20.502 0 0 0-1.196-1.492C7.644 11.294 7 10.544 7 9c0-2.757 2.243-5 5-5s5 2.243 5 5c0 1.521-.643 2.274-1.615 3.413-.373.438-.796.933-1.203 1.512z"></path></svg>
				</span>`
			}else if (this.settings.selected_rating_icon === "users") {
				selectedIcon = `
				<span style="cursor:pointer">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: ${fillColor};"><path d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z"></path></svg>
				</span>`
			}else if (this.settings.selected_rating_icon === "pencil") {
				selectedIcon = `
				<span style="cursor:pointer">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" style="fill: ${fillColor};"><path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z"></path></svg>
				</span>`
			}else{
				//ticks
				selectedIcon = `
				<span style="cursor:pointer">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: ${fillColor};"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
				</span>`
			}

			ratingsHTML += `<span onclick="FormAnswersHandler.handleInputsAnswer(${i})">${selectedIcon}</span>`
		}


		const preNextButtons = this.buildPreAndNextButtons(data)
		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				<div style="display:flex;justify-content:center;flex-wrap:nowrap;margin:40px 0">
					${ratingsHTML}
				</div>

				<div style="display:flex;justify-content:center">
					<div style="margin-right:10px">
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px
							"
							onclick="FormLayerComponents.layerNavigator('next')"
							>
								${preNextButtons.next}
							</button>
						</div>
					`:``}
					
				</div>
			</div>
		`
		return box3HTML
	}


	static box3_withMatrix(data){
		this.setData(data)
		let box3HTML = ""
		let columns = `<th style="text-align:left;color:${this.theme.questionColor};padding:10px;border-bottom:1px solid ${this.theme.questionColor}">Row No.</th>`
		let rows = ""
		this.settings.columns.map((col, index)=>{
			columns += `
				<th style="text-align:left;color:${this.theme.questionColor};padding:10px;border-bottom:1px solid ${this.theme.questionColor}">
					<div
					style="border:none;outline:none;background-color:transparent;color:${this.theme.questionColor}">
						${col.label}
					</div>
				</th>`
		})

		let rowInputsHTML = ""
		let checked = ""
		//console.log(this.settings.columns[1])

		this.settings.rows.map((row, index)=>{
			rowInputsHTML = ""
			for (let i = 0; i < this.settings.columns.length; i++) {
				checked = ""
				if (this.currentLayerAnswersData) {
					for(let jj=0; jj<this.currentLayerAnswersData.response.length; jj++){
						if (this.currentLayerAnswersData.response[jj].rowValue === row.label && this.currentLayerAnswersData.response[jj].columnValue === this.settings.columns[i].label) {
							checked = "checked"
							break
						}
					}
				}

				rowInputsHTML += `
					<td style="text-align:left;color:${this.theme.questionColor};padding:10px;border-bottom:1px solid ${this.theme.questionColor}">
						<input type='${this.settings.multi_select?`checkbox`:`radio`}' name="${this.elPrefixClass}row_input"
						onclick="FormAnswersHandler.handleMatrixInputs(this, '${row.label}', '${this.settings.columns[i].label}')"
						${checked}>
					</td>`
			}

			rows += `
				<tr>
					<td style="text-align:left;color:${this.theme.questionColor};padding:10px;border-bottom:1px solid ${this.theme.questionColor}">
						<div
						style="border:none;outline:none;background-color:transparent;color:${this.theme.questionColor}">
							${row.label}
						</div>
					</td> 
					${rowInputsHTML}
				</tr>
			`
		})

		const preNextButtons = this.buildPreAndNextButtons(data)
		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				<div class="${this.elPrefixClass}table-responsive" style="overflow-x:auto;box-sizing:border-box">
					<table class="${this.elPrefixClass}table-matrix" style="width:100%;min-width:600px;box-sizing:border-box">
						<thead>
							${columns}
						</thead>
						<tbody>
							${rows}
						</tbody>
					</table>
				</div>

				<div style="display:flex;justify-content:center;margin-top:40px">
					<div style="margin-right:10px">
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px
							"
							onclick="FormLayerComponents.layerNavigator('next')"
							>
								${preNextButtons.next}
							</button>
						</div>
					`:``}
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

		//the iso date format YYYY MM DD
		const current_val_array = this.currentLayerAnswersData?this.currentLayerAnswersData.response.split('-'):['', '', '']
		const currentYearVal = current_val_array[0]
		const currentMonthVal = current_val_array[1]
		const currentDayVal = current_val_array[2]

		day = `
			<div class="col-md-3 date-box px-0">
				<div style="color:${this.theme.questionColor}">Day</div>
				<input value="${currentDayVal}" type="number" name="date-split-day" style="color:${this.theme.answerColor};outline-color:${this.theme.questionColor};padding:10px;border-radius:4px;width:100px;height:20px;-webkit-appearance: none;-moz-appearance: textfield;">
			</div>
		`
		month = `
			<div class="col-md-3 date-box px-0">
				<div style="color:${this.theme.questionColor}">Month</div>
				<input value="${currentMonthVal}" type="number" name="date-split-month" style="color:${this.theme.answerColor};outline-color:${this.theme.questionColor};padding:10px;border-radius:4px;width:100px;height:20px;-webkit-appearance: none;-moz-appearance: textfield;">
			</div>
		`

		year = `
			<div>
				<div style="color:${this.theme.questionColor}">Year</div>
				<input value="${currentYearVal}" type="number" name="date-split-year" style="color:${this.theme.answerColor};outline-color:${this.theme.questionColor};padding:10px;border-radius:4px;width:100px;height:20px;-webkit-appearance: none;-moz-appearance: textfield;">
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
			<div style="color:${this.theme.questionColor};display:flex;justify-content:center;align-items:center;height:20px;padding:10px 5px;margin-top:15px">${separator}</div>
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

		const preNextButtons = this.buildPreAndNextButtons(data)

		//set box 3 content
		box3HTML = `
			<div class="${this.elPrefixClass}box3" style="padding-top:30px;">
				<div style="display:flex;justify-content:center;align-items:center">
					${formatHTML}
				</div>

				<div style="display:flex;justify-content:center;margin-top:40px">
					<div style="margin-right:10px">
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px
							"
							onclick="FormLayerComponents.layerNavigator('next', 'date')"
							>
								${preNextButtons.next}
							</button>
						</div>
					`:``}
					
				</div>
			</div>
		`
		return box3HTML	
	}


	static box3_withLegal(data){
		this.setData(data)
		let box3HTML = ""	
		const preNextButtons = this.buildPreAndNextButtons(data)

		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				<div style="display:flex;width:100%;justify-content:center;margin-bottom:50px;margin-top:50px !important">
					<div style="padding:10px;width:130px;border-radius:4px;cursor:pointer;margin-right:10px;
					${this.currentLayerAnswersData && this.currentLayerAnswersData.response === 'accept'?
						`background-color:${this.theme.buttonBGColor};color:${this.theme.buttonTextColor};border:1px solid ${this.theme.buttonBGColor};`:
						`color:${this.theme.answerColor};border:1px solid ${this.theme.answerColor};`
					}" onclick="FormLayerComponents.layerNavigator('next', 'accept')">
						I accept
					</div>
					<div style="padding:10px;width:130px;border-radius:4px;cursor:pointer;
					${this.currentLayerAnswersData && this.currentLayerAnswersData.response === 'not_accept'?
						`background-color:${this.theme.buttonBGColor};color:${this.theme.buttonTextColor};border:1px solid ${this.theme.buttonBGColor};`:
						`color:${this.theme.answerColor};border:1px solid ${this.theme.answerColor};`
					}" onclick="FormLayerComponents.layerNavigator('next', 'not_accept')">
						I don't accept
					</div>
				</div>
				
				<div style="display:flex;justify-content:center;margin-top:40px">
					<div>
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
					</div>
				</div>

			</div>
		`
		return box3HTML
	}

	static box3_withFileUpload(data){
		this.setData(data)
		let box3HTML = ""
		const fileViewPath = FormLayerComponents.fileViewPath
		const preNextButtons = this.buildPreAndNextButtons(data)

		box3HTML += `
			<div class="${this.elPrefixClass}box3">
				${//one file always in response array
				this.currentLayerAnswersData?
					`<div style="display:flex;justify-content:end;cursor:pointer;">
						<span onclick="FormAnswersHandler.deleteFormFile('${this.currentLayerAnswersData.response[0]}')">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 20 20" style="fill: ${this.theme.buttonBGColor};"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V7h16l.001 12H4z"></path><path d="m15.707 10.707-1.414-1.414L12 11.586 9.707 9.293l-1.414 1.414L10.586 13l-2.293 2.293 1.414 1.414L12 14.414l2.293 2.293 1.414-1.414L13.414 13z"></path></svg>
						</span>
					</div>
					<div style="display:flex;justify-content:center">
						<img src="${fileViewPath}/${this.currentLayerAnswersData.response[0]}" style="max-width:100%; max-height:200px"/>
					</div>`
					:
					`<label for="${this.elPrefixClass}-hidden-file-upload-tag" style="height:150px;width:100%;display:flex;justify-content:center;border:1px solid ${this.theme.questionColor}">
						<div style="margin-bottom: 10px;text-align:center">
							<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 30 30" style="fill: ${this.theme.answerColor};margin-left:10px"><path d="M18.944 11.112C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.611 5.757 9.15 3.609 9.792 2 11.82 2 14c0 2.757 2.243 5 5 5h11c2.206 0 4-1.794 4-4a4.01 4.01 0 0 0-3.056-3.888zM13 14v3h-2v-3H8l4-5 4 5h-3z"></path></svg>
							<div style="color:${this.theme.answerColor}">Choose file or drag here</div>
							<div style="color:${this.theme.answerColor}">Size limit: 10MB</div>
						</div>
					</label>
					<input id="${this.elPrefixClass}-hidden-file-upload-tag" type="file" style="display:none"
					onchange="FormAnswersHandler.filePreviewAndUpload('${this.elPrefixClass}-hidden-file-upload-tag')">
					`
				}
				

				<div style="display:flex;justify-content:center;margin-top:40px">
					<div style="margin-right:10px">
						<button style="
						font-family:${this.theme.fontFamily.value};
						font-size: ${this.fontSize.elements};
						background-color:${this.theme.buttonBGColor};
						color:${this.theme.buttonTextColor};
						padding:10px 15px
						"
						onclick="FormLayerComponents.layerNavigator('pre')"
						>
							${preNextButtons.pre}
						</button>
					</div>
					${preNextButtons.next?`
						<div>
							<button style="
							font-family:${this.theme.fontFamily.value};
							font-size: ${this.fontSize.elements};
							background-color:${this.theme.buttonBGColor};
							color:${this.theme.buttonTextColor};
							padding:10px 15px
							"
							onclick="FormLayerComponents.layerNavigator('next')"
							>
								${preNextButtons.next}
							</button>
						</div>
					`:``}
					
				</div>
			</div>
		`
		return box3HTML
	}



	//==============================
	//partial html elements

	static phoneNumberElements(){
		return `
			<div style="margin-bottom:30px">
				<div class='mr-3'>
					<i class="fas fa-chevron-down" style="font-size: 15px; color: ${this.theme.questionColor};"></i>
					<span style="color:${this.theme.questionColor}">${this.settings.country?this.settings.country:``}</span>
				</div>
				<div>
					<input type="tel" class="form-control" placeholder="123-456-789" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
					style="border:1px solid ${this.theme.questionColor};padding:10px;width:100%;box-sizing:border-box"
					value="${this.currentLayerAnswersData?this.currentLayerAnswersData.response:``}"
					onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
					>
				</div>
			</div>
		`
	}

	static answerElements(){
		return `
			<div style="display:flex;justify-content:center">
				<textarea row='3' cols="12"
				placeholder="Type your answer here"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
					width:100%;
					padding:10px
				"
				onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
				>${this.currentLayerAnswersData?this.currentLayerAnswersData.response:``}</textarea>
			</div>
		`
	}

	static emailElements(){
		return `
			<div style="display:flex;justify-content:center;">
				<input type="email" placeholder="name@example.com"
				value="${this.currentLayerAnswersData?this.currentLayerAnswersData.response:``}"
				onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
					padding:10px;
					width:100%
				">
			</div>
		`
	}

	static numberElements(){
		return `
			<div style="display:flex;justify-content:center">
				<input type="number" placeholder="Type your answer here"
				value="${this.currentLayerAnswersData?this.currentLayerAnswersData.response:``}"
				onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
					padding:10px;
					width:100%
				">
			</div>
		`
	}


	static dropdownElement(){
		const currentVal = this.currentLayerAnswersData?this.currentLayerAnswersData.response:null;
		return `
			<div class="d-flex ml-5 mt-10 align-items-center">
				<select
					onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
					style="
						border:1px solid ${this.theme.questionColor};
						color:${this.theme.answerColor};
						font-size:${this.fontSize.description};
						width:100%;
						padding:10px
					">
					<option ${currentVal == '01' ? `selected`:``} value="01">01</option>
					<option ${currentVal == '02' ? `selected`:``} value="02">02</option>
					<option ${currentVal == '03' ? `selected`:``} value="03">03</option>
					<option ${currentVal == '04' ? `selected`:``} value="04">04</option>
				</select>
			</div>
		`
	}

	static websiteElement(){
		return `
			<div style="display:flex;justify-content:center;">
				<input type="url" placeholder="https://example.com"
				value="${this.currentLayerAnswersData?this.currentLayerAnswersData.response:``}"
				onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
					width:100%;
					padding:10px
				">
			</div>
		`
	}

	static dateSelectElement(){
		return `
			<div style="display:flex;justify-content:center;">
				<input type="date"
				value="${this.currentLayerAnswersData?this.currentLayerAnswersData.response:``}"
				onchange="FormAnswersHandler.handleInputsAnswer(this.value)"
				style="
					border:1px solid ${this.theme.questionColor};
					color:${this.theme.answerColor};
					font-size:${this.fontSize.description};
					width:100%;
					padding:10px
				">
			</div>
		`
	}

	static socialIconsElement(){
		return this.settings.social_icons?`
			<div style="display:flex; justify-content:center; align-items:center; padding:15px;padding-top:0px;margin-top:-15px">
				${this.settings.social_links_facebook?
					`<a style="padding:10px" target="_blank" href="${this.settings.social_links_facebook}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_facebook_color} !important;"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>
					</a>`
					:``}
				${this.settings.social_links_twitter?`
					<a style="padding:10px" target="_blank" href="${this.settings.social_links_twitter}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_twitter_color} !important;"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path></svg>
					</a>
				`:``}
				${this.settings.social_links_linkedin?`
					<a style="padding:10px" target="_blank"  href="${this.settings.social_links_linkedin}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_linkedin_color} !important;"><circle cx="4.983" cy="5.009" r="2.188"></circle><path d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z"></path></svg>
					</a>
				`:``}

				${this.settings.social_links_youtube?`
					<a style="padding:10px" target="_blank" href="${this.settings.social_links_youtube}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_youtube_color} !important;"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"></path></svg>
					</a>
				`:``}

				${this.settings.social_links_instagram?`
					<a style="padding:10px" target="_blank" href="${this.settings.social_links_instagram}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_instagram_color} !important;"><path d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z"></path><circle cx="11.994" cy="11.979" r="3.003"></circle></svg>
					</a>`
				:``}

				${this.settings.social_links_tiktok?`
					<a style="padding:10px" target="_blank" href="${this.settings.social_links_tiktok}">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 23" style="fill: ${this.settings.social_icons_tiktok_color} !important;"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"></path></svg>
					</a>`
				:``}
				
			</div>
		`:``
	}



	//the layout builder
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
				<div class="${this.elPrefixClass}content_panel" style="${layerBackground}">

					<div class="${this.elPrefixClass}boxes_together">
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
				<div class="${this.elPrefixClass}content_panel" style="flex-direction: row; padding: 0;${layerBackground}" >

					<div class="${this.elPrefixClass}boxes_together" style='width:50%'>
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
				<div class="${this.elPrefixClass}content_panel" style="flex-direction: row; padding: 0;${layerBackground}" >
					<div style='width:50%;width: 50%; display: flex; justify-content: center; align-items: center;'>
						${box2HTML}
					</div>

					<div class="${this.elPrefixClass}boxes_together" style='width:50%'>
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
				<div class="${this.elPrefixClass}content_panel" 
				style="${file_path_set}">

					<div class="${this.elPrefixClass}boxes_together">
						${box1HTML}
						${box3HTML}
					</div>
					
				</div>
			`
			return dataHTML
		}

		return `Error, (${data.data.settings.layer_layout}) no such layout found`
	}

	//button text or icons
	static buildPreAndNextButtons(data){
		const settings = this.getSettingsData()
		const currentActiveItem = this.getFormDataActiveItem()
		
		//check is current active item is last item or not
		const formData = this.getFormData()
		


		let nextBtnTxt = "Next"
		let nextBtnArrowIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" style="fill: ${data.data.theme.theme.buttonTextColor}"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>`
		
		
		//Remove Pre/Next Btn from last screen
		let hasNextItems = true
		for(let i=0; i < formData.length; i++){
			if (formData[i].id === currentActiveItem.id) {
				if (!formData[(i+1)]) {
					hasNextItems = false
				}
			}
		}
		

		const pre = settings.navigation_arrows?
					`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" style="fill: ${data.data.theme.theme.buttonTextColor}"><path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>`:
					`Pre`;

		const next = settings.navigation_arrows ? nextBtnArrowIcon : nextBtnTxt;
		
		if (!hasNextItems){
			return {
				pre:pre,
				next:null
			}
		}

		const btns = {
			pre:pre,
			next:next
		}
		return btns
	}

	//form branding html
	static getFormBranding(){
		return `
			<div style="padding:10px;display:flex;justify-content:center;color:#212121;background-color:#fff;font-size:16px;font-weight:bold;text-transform:uppercase;width:100%">
				<div>
					<div>${this.formBranding} <sub style="font-size:9px;color:#212121;position:relative">Powered by</sub></div>
				</div>
			</div>
		`
	}
	static getProgressBar(){
		const formData = this.getFormData()
		let activeIndex = null
		formData.map((item, index)=>{
			if (item.isActive) {
				if (item.type === "endScreen") {
					activeIndex = 100
				}else{
					activeIndex = index
				}
				return
			}
		})

		if (activeIndex > 0 && activeIndex < 100) {
			activeIndex += 1
		}

		const progress = (activeIndex === 100 ? 100 : Math.round((100 * activeIndex) / formData.length))
		console.log(`${formData.length} | ${activeIndex} | ${progress}`)

		return `
			<div style="display:flex;justify-content:center;width:100%">
				<div style="position:relative;display: flex; flex-direction: column; width: 600px; background: #999999; border-radius: 5px; padding: 2px;height:12px">
					<div style="position:absolute;top:0;width:${progress}%;font-size:14px;color:#fff;padding:0;border-radius:5px;background-color:forestgreen">${progress}%</div>
				</div>
			</div>
		`

	}


	//form styles
	static formStyles(){
		return `
		<style type="text/css">
			#${this.wrapperElId}{
				display: -webkit-box;
			    display: -ms-flexbox;
			    display: flex;
			    -ms-flex-wrap: wrap;
			    flex-wrap: wrap;
			    justify-content:center
			}

			#${this.wrapperElId} .${this.elPrefixClass}content_panel{
				background-color: white !important;
				display: flex;
			    flex-direction: column;
			    max-width: 600px;
			    width:100%;
			    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			    padding: 15px;
			    border-radius: 10px;
			    overflow-x:auto !important;
			}
			#${this.wrapperElId} .${this.elPrefixClass}content_panel .${this.elPrefixClass}boxes_together{
				padding:50px 0
			}
			#${this.wrapperElId} .${this.elPrefixClass}title-box {
				display:flex;
				padding-top:30px;
				padding-bottom:15px;
				justify-content:center
			}
			#${this.wrapperElId} .${this.elPrefixClass}title-box h2.${this.elPrefixClass}title{
				margin:0
			}


			#${this.wrapperElId} .${this.elPrefixClass}box3{
				padding-top:50px;
				padding-bottom:30px;
			}
			#${this.wrapperElId} .${this.elPrefixClass}box3 button{
				border:none;
				cursor:pointer;
				border-radius:3px;
				padding:0.50rem 1rem;
			}
			#${this.wrapperElId} .${this.elPrefixClass}box3 .${this.elPrefixClass}button-elements{
				display:flex;
				align-items:center;
				justify-content:center
			}


			/* Switchable inputs */
			#${this.wrapperElId} .${this.elPrefixClass}switchable-input {
			  position: relative;
			  display: inline-block;
			  width: 60px;
			  height: 34px;
			}
			#${this.wrapperElId} .${this.elPrefixClass}switchable-input input {
			  opacity: 0;
			  width: 0;
			  height: 0;
			}
			#${this.wrapperElId} .${this.elPrefixClass}switchable-input .${this.elPrefixClass}switch-slider {
			  position: absolute;
			  cursor: pointer;
			  top: 0;
			  left: 0;
			  right: 0;
			  bottom: 0;
			  background-color: #ccc;
			  -webkit-transition: .4s;
			  transition: .4s;
			  border-radius:34px
			}

			#${this.wrapperElId} .${this.elPrefixClass}switchable-input .${this.elPrefixClass}switch-slider:before {
			  position: absolute;
			  content: "";
			  height: 26px;
			  width: 26px;
			  left: 4px;
			  bottom: 4px;
			  background-color: white;
			  -webkit-transition: .4s;
			  transition: .4s;
			  border-radius:34px
			}

			#${this.wrapperElId} .${this.elPrefixClass}switchable-input input:checked + .${this.elPrefixClass}switch-slider {
			  background-color: #2196F3;
			}

			#${this.wrapperElId} .${this.elPrefixClass}switchable-input input:focus + .${this.elPrefixClass}switch-slider {
			  box-shadow: 0 0 1px #2196F3;
			}

			#${this.wrapperElId} .${this.elPrefixClass}switchable-input input:checked + .${this.elPrefixClass}switch-slider:before {
			  -webkit-transform: translateX(26px);
			  -ms-transform: translateX(26px);
			  transform: translateX(26px);
			}
			#${this.wrapperElId} .${this.elPrefixClass}switchable-input .${this.elPrefixClass}switch-slider.${this.elPrefixClass}round {
			  border-radius: 34px;
			}

			#${this.wrapperElId} .${this.elPrefixClass}switchable-input .${this.elPrefixClass}switch-slider.${this.elPrefixClass}round:before {
			  border-radius: 50%;
			}



			/*picture select*/
			#${this.wrapperElId} .${this.elPrefixClass}picture_select{
				width: 140px;
			    height: 150px;
			    position: relative;
			    margin: 30px 2%;
			    display: block;
			    justify-content: center;
			    align-items: center;
			    border: 1px solid rgb(0, 153, 255);
			    border-radius: 10px;
			}
			#${this.wrapperElId} .${this.elPrefixClass}picture_select.${this.elPrefixClass}super_size{
				width: 200px;
    			height: 210px;
			}
			#${this.wrapperElId} .${this.elPrefixClass}picture_image{
				width: 100%;
			    height: 100%;
			    cursor: pointer;
			    display: flex;
			    justify-content: center;
			    align-items: center;
			    border-radius: 10px 10px 10px 10px;
			    background-color: rgb(183 209 249 / 33%);
    			color: black;
			}
			#${this.wrapperElId} .${this.elPrefixClass}picture_label{
			    height: 25px;
			    text-align: center;
			    bottom: 0;
			    width: 100%;
			    position: absolute;
			    border-radius: 0 0 10px 10px;
			}
			#${this.wrapperElId} .${this.elPrefixClass}picture-delete-button{
			    display: none;
			    position: absolute;
			    right: 0;
			    top: 3px;
			    border-radius: 50%;
			    color: white;
			    width: 25px;
			    height: 25px;
			    cursor: pointer;
			    text-align: center;
			    justify-content: center;
			    align-items: center;
			}
			#${this.wrapperElId} .${this.elPrefixClass}picture_select:hover > .${this.elPrefixClass}picture-delete-button{
				display:flex
			}


			/* popup modal */
			#${this.wrapperElId} .${this.elPrefixClass}popup-modal{
				position: fixed;
			    top: 0;
			    left: 0;
			    z-index: 999999999999;
			    display: flex;
			    justify-content:center;
			    width: 100%;
			    height: 100%;
			    overflow: hidden;
			    outline: 0;
			}
			#${this.wrapperElId} .${this.elPrefixClass}popup-modal .${this.elPrefixClass}modal-dialog{
				transition: -webkit-transform .3s ease-out;
			    transition: transform .3s ease-out;
			    transition: transform .3s ease-out,-webkit-transform .3s ease-out;
			    -webkit-transform: translate(0,-50px);
			    transform: translate(0,-50px);
    			margin: 1.75rem auto;
    			position: relative;
			    width: auto;
			    margin: .5rem;
			    pointer-events: none;
			    min-width:300px;
			    margin-top:8%;
			    background:#efefef;
			    max-width: 700px;
			    min-width: 700px;
			    min-height:400px;
			    max-height:400px;
			}
			#${this.wrapperElId} .${this.elPrefixClass}popup-modal .${this.elPrefixClass}modal-dialog .${this.elPrefixClass}modal-content{
				position: relative;
			    display: -ms-flexbox;
			    display: flex;
			    -ms-flex-direction: column;
			    flex-direction: column;
			    width: 100%;
			    pointer-events: auto;
			    background-color: #fff;
			    background-clip: padding-box;
			    border: 1px solid rgba(0,0,0,.2);
			    border-radius: .3rem;
			    outline: 0;
			}

			#${this.wrapperElId} .${this.elPrefixClass}popup-modal .${this.elPrefixClass}modal-dialog .${this.elPrefixClass}modal-content .${this.elPrefixClass}modal-header{
				display: -ms-flexbox;
			    display: flex;
			    -ms-flex-align: start;
			    align-items: flex-start;
			    -ms-flex-pack: justify;
			    justify-content: space-between;
			    padding: 1rem 1rem;
			    border-bottom: 1px solid #dee2e6;
			    border-top-left-radius: calc(.3rem - 1px);
			    border-top-right-radius: calc(.3rem - 1px);
			    background-color:#ddd
			}
			#${this.wrapperElId} .${this.elPrefixClass}popup-modal .${this.elPrefixClass}modal-dialog .${this.elPrefixClass}modal-content .${this.elPrefixClass}modal-body{
				min-height:400px;
			}

			#${this.wrapperElId} .toast-featured-form-custom-toster{

			}

			#${this.wrapperElId} .lara-form-upload-image-preview{
				max-width:600px !important;
				max-height:350px !important;
			}
		</style>
		`;
	}



	//submit the form
	static confirmationModal(action='show'){
		if (action === "cancel") {
			document.getElementById(`${this.elPrefixClass}popup-modal-confirmation`).remove()
			return
		}
		const modal = `<div class="${this.elPrefixClass}popup-modal" id="${this.elPrefixClass}popup-modal-confirmation">
			<div class="${this.elPrefixClass}modal-dialog">
				<div class="${this.elPrefixClass}modal-content">
					<div class="${this.elPrefixClass}modal-header">
						<h5 style="margin:0;padding:10px 15px;font-size:18px">The form is end</h5>
					</div>
					<div class="${this.elPrefixClass}modal-body">
						<div style="margin-bottom: 40px; margin-top: 60px; text-align: center; font-weight: bold; font-size: 18px;">
							<label>Do you want to submit the form?</label>
						</div>
						<div style="display:flex;justify-content:center">
							<button type='button' onclick="FormAnswersHandler.submitTheForm()" style="font-size:16px;font-weight:bold;color:#fff;border:none;outline:none;padding:8px 12px;margin-right:8px;cursor:pointer;background:forestgreen;border-radius:3px">Yes, Submit</button>
							<button type='button' onclick="FormLayerComponents.confirmationModal('cancel')" style="font-size:16px;font-weight:bold;color:#777;border:none;outline:none;padding:8px 12px;cursor:pointer;background:red;color:#fff;border-radius:3px">No, Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>`;

		document.getElementById(this.wrapperElId).insertAdjacentHTML('beforeend', modal)
	}
}

class FormAnswersHandler{
	static answersStorageName = FormLayerComponents.answersStorageName
	static layerParentRef = null
	static answer_base_format = {
		question_id:null,
		question_type:null,
		response:null
	}

	//set parent reference id
	static setPrarentRef(){
		this.layerParentRef = FormLayerComponents.wrapperElId
	}

	static getAnswers(){
		//console.log(this.answersStorageName)
		return localStorage.getItem(this.answersStorageName) == null || localStorage.getItem(this.answersStorageName) == 'null' || localStorage.getItem(this.answersStorageName) == '' ? [] : JSON.parse(localStorage.getItem(this.answersStorageName));
	}


	//matrix answer handling
	static handleMatrixInputs(a, rowName, columnName){
		if (rowName == '' || columnName == '') {
			alert(`Invalid request- row name or column name is empty, please refresh the page and try again`)
			return
		}

		if (!a) {
			alert(`The target input not found`)
			return
		}

		let actionAdd = true
		if (!a.checked) {
			actionAdd = false
		}


		//validate column and row name
		const formData = FormLayerComponents.getFormData()
		let currentAnswers = this.getAnswers();
		let activeItem = null
		let activeItemIndex = null

		if (!formData.length) {
			alert("Invalid request, no form data found")
			return
		}

		if (!currentAnswers.length) {
			if (!actionAdd) {
				alert(`Invalid request- no previous answers found to modify`)
				return
			}
		}


		formData.map((item, index)=>{
			if (item.isActive) {
				//check is value is valid or not
				activeItem = item
				activeItemIndex = index
			}
		})

		if (activeItem == null) {
			alert(`The active question not found`)
			return
		}


		const columns = activeItem.data.settings.columns
		const rows = activeItem.data.settings.rows
		let isColumnNameValid = false
		let isRowNameValid = false

		for(let i=0; i<columns.length; i++){
			if (columns[i].label === columnName) {
				isColumnNameValid = true
				break
			}
		}

		for(let i=0; i<rows.length; i++){
			if (rows[i].label === rowName) {
				isRowNameValid = true
				break
			}
		}

		if (!isColumnNameValid) {
			alert(`Sorry- the column value is not valid, please refresh the page and try again`)
			return
		}

		if (!isRowNameValid) {
			alert(`Sorry- the row value is not valid, please refresh the page and try again`)
			return
		}


		let isAnswerUpdated = false
		const isMultiSelect = activeItem.data.settings.multi_select?true:false
		
		if (currentAnswers.length) {
			//try to update if found
			for(let i=0; i<currentAnswers.length; i++){
				if (currentAnswers[i]['question_id'] === activeItem.id) {
					//answer exists, so update
					let theResponseAnsIndex = null
					currentAnswers[i]['response'].map((ans, ansIndex)=>{
						if (ans.columnValue === columnName && ans.rowValue === rowName) {
							theResponseAnsIndex = ansIndex
							return
						}
					})

					if (actionAdd && theResponseAnsIndex != null) {
						console.log(`The answer is already saved`)
						isAnswerUpdated = true
						return
					}

					if (isMultiSelect) {
						
						if (actionAdd) {
							console.log(`updating answer ${columnName} ${rowName}`)
							currentAnswers[i]['response'].push({
								columnValue:columnName,
								rowValue:rowName,
							})
							this.saveAnswer(currentAnswers)
							isAnswerUpdated = true
							return
						}

						//else remove
						console.log(`update- removing answer ${columnName} ${rowName}`)
						//remove the target index
						if (theResponseAnsIndex == null) {
							alert(`The target answer not found to modify`)
							return
						}

						currentAnswers[i]['response'].splice(theResponseAnsIndex, 1)//remove the answer response index
						if (!currentAnswers[i]['response'].length) {
							currentAnswers.splice(i, 1) //remove the answer index, as its has no answer
						}
						this.saveAnswer(currentAnswers)
						isAnswerUpdated = true
						return
						
					}else{
						//not multi select
						if (actionAdd) {
							console.log(`updating answer not multi ${columnName} ${rowName}`)
							currentAnswers[i]['response'] = new Array()
							currentAnswers[i]['response'].push({
								columnValue:columnName,
								rowValue:rowName,
							})

							this.saveAnswer(currentAnswers)
							isAnswerUpdated = true
							return
						}

						//else remove the answer index completely
						currentAnswers.splice(i, 1) //remove the answer index
						this.saveAnswer(currentAnswers)
						isAnswerUpdated = true
						return

					}
				}
			}
		}

		if (!isAnswerUpdated) {
			//inserting answer
			let newAnswer = this.answer_base_format
			newAnswer.question_id = activeItem.id
			newAnswer.question_type = activeItem.type
			newAnswer.response = new Array()
			newAnswer.response.push({
				columnValue:columnName,
				rowValue:rowName,
			})
			currentAnswers.push(newAnswer)
			this.saveAnswer(currentAnswers)
		}
	}


	//handle multi choices
	//- add, remove options and options text
	static handleMultipleChoice(a){
		if (!a) {
			alert(`The target input not found`)
			return
		}

		const ansValue = a.value
		if (ansValue == '') {
			alert("Invalid request, the answer value is empty!")
			return
		}

		let actionAdd = true
		if (!a.checked) {
			actionAdd = false
		}

		const formData = FormLayerComponents.getFormData()
		let currentAnswers = this.getAnswers();
		let activeItem = null
		let activeItemIndex = null

		if (!formData.length) {
			alert("Invalid request, no form data found")
			return
		}

		if (!currentAnswers.length) {
			if (!actionAdd) {
				alert(`Invalid request- no previous answers found to modify`)
				return
			}
		}


		formData.map((item, index)=>{
			if (item.isActive) {
				//check is value is valid or not
				activeItem = item
				activeItemIndex = index
			}
		})

		if (activeItem == null) {
			alert(`The active question not found`)
			return
		}


		//validate answer
		let isAnswerValueIsValid = false
		let answerIndex = null
		activeItem.data.settings.options.map((option, optionIndex)=>{
			if (option.value === ansValue) {
				isAnswerValueIsValid = true
				answerIndex =  optionIndex
			}
		})

		if (!isAnswerValueIsValid) {
			alert(`The answer value is invalid`)
			FormLayerComponents.renderLayer(activeItem.id)
			return
		}



		let isAnswerUpdatedOrRemoved = false
		if (currentAnswers.length) {
			//update answer
			currentAnswers.map((currentAns, currentAnsIndex)=>{
				if (currentAns.question_id === activeItem.id) {
					if (!actionAdd) {
						//remove answer
						isAnswerUpdatedOrRemoved = true
						console.log(`removing ans : ${ansValue}`)
						currentAns.response.splice(currentAns.response.indexOf(ansValue), 1)

						if (!currentAns.response.length) {
							//remove this answer
							currentAnswers.splice(currentAnsIndex, 1)//remove the complete answer from array
							this.saveAnswer(currentAnswers)
							return
						}
						this.saveAnswer(currentAnswers)
						return
					}else if (activeItem.data.settings.multi_select) {
						//question exists so update
						isAnswerUpdatedOrRemoved = true
						if (currentAns.response.includes(ansValue)) {
							console.log(`the answer is already given`)
							return
						}

						currentAns.response.push(ansValue)
						this.saveAnswer(currentAnswers)
						return

					}else{
						currentAns.response = new Array()
						currentAns.response.push(ansValue)
						this.saveAnswer(currentAnswers)
						isAnswerUpdatedOrRemoved = true
						return
					}
				}
			})
		}

		if (!isAnswerUpdatedOrRemoved) {
			//then insert
			let newAnswer = this.answer_base_format
			newAnswer.question_id = activeItem.id
			newAnswer.question_type = activeItem.type
			newAnswer.response = new Array()
			newAnswer.response.push(ansValue)
			currentAnswers.push(newAnswer)
			this.saveAnswer(currentAnswers)
		}
		//this.checkIsRulesConditionsSatisfied()
	}

	static checkIsRulesConditionsSatisfied(){
		let activeItem = null
		const formData = FormLayerComponents.getFormData()
		if (!formData.length) {
			console.log(`Invalid request, no form data found`)
			FormLayerComponents.layerNavigator('next', null, false)
			return
		}

		formData.map((item, index)=>{
			if (item.isActive) {
				//check is value is valid or not
				activeItem = item
				return
			}
		})
		if (activeItem == null) {
			console.log(`Invalid request, active item not found`)
			FormLayerComponents.layerNavigator('next', null, false)
			return 
		}

		//always jump to and rules conditions if has set
		let preLayers = FormLayerComponents.getPreviousLayers()

		if (activeItem.type === 'multipleChoice') {
			if (!activeItem['data']['logics']['branching']['rules']) {
				console.log(`No rules...`)
				FormLayerComponents.layerNavigator('next', null, false)
				return 
			}
		}else{
			if (activeItem['data']['logics']['branching']['jump_to'] != null) {
				if (activeItem['data']['logics']['branching']['jump_to'] === "submitForm") {
					alert(`Depending on your answers & settings, we are now going to submitting & saving answers automatically`)
					this.submitTheForm(false)
					return
				}

				//check is it valid item id or not
				for(let i=0; i<formData.length; i++){
					if (formData[i].id === activeItem['data']['logics']['branching']['jump_to']) {
						//set back data
						let isPreLayerUpdated = false
						for(let pre_i=0; pre_i<preLayers.length; pre_i++){
							if (preLayers[pre_i]['question_id'] === activeItem['data']['logics']['branching']['jump_to']) {
								preLayers[pre_i]['back_to'] =  activeItem.id
								isPreLayerUpdated = true
								break
							}
						}
						
						if (!isPreLayerUpdated) {
							preLayers.push({
								"question_id":activeItem['data']['logics']['branching']['jump_to'],
								"back_to":activeItem.id
							})
						}
						FormLayerComponents.savePreLayers(preLayers)

						FormLayerComponents.renderLayer(activeItem['data']['logics']['branching']['jump_to'])
						console.log(`always jump to ${activeItem['data']['logics']['branching']['jump_to']}`)
						return
					}
				}
			}

			FormLayerComponents.layerNavigator('next', null, false)
			return 
		}
		
		
		if (!activeItem['data']['logics']['branching']['rules']['rules']) {
			console.log(`No rules inside rules...`)
			FormLayerComponents.layerNavigator('next', null, false)
			return 
		}

		//get active item answers
		const allAnswers = this.getAnswers()

		let activeItemAnswer = null
		allAnswers.map((ans, ansIndex)=>{
			if (ans.question_id === activeItem.id) {
				activeItemAnswer = ans
				return
			}
		})
		if (!activeItemAnswer) {
			console.log(`No answer found`)
			FormLayerComponents.layerNavigator('next', null, false)
			return 
		}

		//has rules
		const rules = activeItem['data']['logics']['branching']['rules']
		
		let isRuleConditionsSatisfied = false
		let then = null

		rules['rules'].map((rule, ruleIndex)=>{
			let continueLoop = false

			//map contiditions
			let trueOrFalse = []
			let andOr = []
			rule['conditions'].map((con, conIndex)=>{
				const result_ = this.testConditions(con, allAnswers, formData);
				trueOrFalse.push(result_)
				andOr.push(con['condition'])
			})
			console.log(`ruleIndex ${ruleIndex}`)
			console.log(trueOrFalse)
			console.log(andOr)

			//evaluate the final express
			let hasSatisfiedAny = false
			for(let i=0; i < trueOrFalse.length; i++){
				//check is there any conditions has been satified or not
				if (trueOrFalse[i] === true) {
					//check is there any or
					console.log(trueOrFalse[i])
					console.log(`${i} satified`)
					hasSatisfiedAny = true
					break
				}
			}
			//check is there any and condition has been desatified
			if (hasSatisfiedAny) {
				if (!andOr.includes("or")) {
					console.log(`not has any- or`)
					//then all conditions should satified
					let isAllSatified = true
					for(let i=0; i < trueOrFalse.length; i++){
						//check is there any conditions has been satified or not
						if (trueOrFalse[i] === false) {
							isAllSatified = false
							break
						}
					}
					if (isAllSatified) {
						isRuleConditionsSatisfied = true
						then = rule['then']
						return
					}else{
						continueLoop = true
					}

				}else if(andOr.includes("or")){
					//then check any or are satified
					console.log(`has or`)
					let isAnyOrSatisfied = false
					for(let i=0; i < andOr.length; i++){
						//check is there any conditions has been satified or not
						if (andOr[i] === 'or' && trueOrFalse[i] === true) {
							isAnyOrSatisfied = true
							break
						}
					}
					if (isAnyOrSatisfied) {
						isRuleConditionsSatisfied = true
						then = rule['then']
						return
					}else{
						continueLoop = true
					}
				}
				// else{
				// 	console.log(`Yes has and`)
				// 	for(let i=0; i<andOr.length; i++){
				// 		if (andOr[i] === 'and') {
				// 			if (!trueOrFalse[i]) {
				// 				//the rule conditions are not satified completely
				// 				continueLoop = true
				// 				break
				// 			}
				// 		}
				// 	}
				// }
			}else{
				continueLoop = true
			}
					

			//check loop state
			if (!continueLoop) {
				isRuleConditionsSatisfied = true
				then = rule['then']
				return
			}
		})

		console.log(`are logics satified : ${isRuleConditionsSatisfied}`)
		console.log(then)

		if (isRuleConditionsSatisfied) {
			for(let i=0; i<formData.length; i++){
				if (formData[i].id === then['jumpto']['question_id']) {
					console.log(`then jump to question_id is valid`)
					
					let isPreLayerUpdated = false
					for(let pre_i=0; pre_i<preLayers.length; pre_i++){
						if (preLayers[pre_i]['question_id'] === then['jumpto']['question_id']) {
							preLayers[pre_i]['back_to'] =  activeItem.id
							isPreLayerUpdated = true
							break
						}
					}
					if (!isPreLayerUpdated) {
						preLayers.push({
							"question_id":then['jumpto']['question_id'],
							"back_to":activeItem.id
						})
					}
					FormLayerComponents.savePreLayers(preLayers)
					
					FormLayerComponents.renderLayer(then['jumpto']['question_id'])
					return
				}
			}

			//check for on submit
			console.log(`then jump to question_id is not valid ...`)
		}

		
		console.log(`Not satified-- rendering next layer`)
		//delete pre record if have for this active item
		for(let pre_i=0; pre_i<preLayers.length; pre_i++){
			if (preLayers[pre_i]['back_to'] === activeItem.id) {
				preLayers.splice(pre_i, 1)
				FormLayerComponents.savePreLayers(preLayers)
				break
			}
		}

		FormLayerComponents.layerNavigator('next', null, false)
		return 
	}

	static testConditions(con, allAnswers, formData){
		let theAnswer = null
		let theRuleOption = null
		//console.log(allAnswers)
		//console.log(con['question_id'])

		allAnswers.map((item, index)=>{
			if (item.question_id === con['question_id']) {
				//console.log(`The answer id matched`)
				theAnswer = item
				return
			}
		})

		formData.map((item, index)=>{
			if (item.id === con['question_id']) {
				if (item.data.settings.options[parseInt(con['optionIndex'])]) {
					theRuleOption = item.data.settings.options[parseInt(con['optionIndex'])]
					return
				}
			}
		})

		console.log(theAnswer)
		if (theAnswer == null) {
			console.log(`No answers found`)
			return false
		}
		console.log(theAnswer)

		if (theRuleOption == null) {
			console.log(`the target option not found`)
			return false
		}
		

		

		console.log(`The operator: ${con['operator']}`)
		console.log(`The index: ${parseInt(con['optionIndex'])}`)
		console.log(theAnswer['response'])
		console.log(`The target option`)
		console.log(theRuleOption)

		if (con['operator'] === 'is') {
			console.log('Yes its is, should include')
			if (theAnswer['response'].includes(theRuleOption['value'])) {
				//condition satisfied
				console.log('is satified')
				return true
			}
		}

		if (con['operator'] === 'is_not') {
			if (!theAnswer['response'].includes(theRuleOption['value'])) {
				//condition satisfied
				return true
			}
		}
		return false

	}




	static handleInputsAnswer(inputValue, calledFromNavigator=false){
		//the types of inputs will be handled
		//number, text, textarea, phone, email
		if (inputValue == '') {
			alert("The answer is required")
			return
		}

		const formData = FormLayerComponents.getFormData()
		console.log('the formData')
		console.log(formData)
		let currentAnswers = this.getAnswers();
		let activeItem = null
		let shouldRenderAfterDone = false
		
		let hasError = true;
		let errorMsg = "The active question not found"

		if (!formData.length) {
			alert("Invalid request, no form data found")
			return
		}


		formData.map((item, index)=>{
			if (item.isActive) {
				if (item.type === "phoneNumber") {
					//validate phone nuber data
					if (!this.isNumber(inputValue)) {
						errorMsg = "The phone number should be number"
						return
					}
					if (inputValue.length > 16) {
						errorMsg = "The phone number can't be greater than 16 digits"
						return
					}
					
					//save the answer
					hasError = false
					activeItem = item
					return
				}


				if (item.type === "shortText" || item.type === "longText") {
					if (inputValue.length > parseInt(item.data.settings.max_characters_input)) {
						errorMsg = `The answer can't be greater than ${item.data.settings.max_characters_input} characters`
						return
					}

					hasError = false
					activeItem = item
					return
				}

				if (item.type === "statement") {
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "yesNo") {
					const valueIn = ["YES", "NO"]
					if (!valueIn.includes(inputValue)) {
						errorMsg = `The answer is invalid, should be YES or NO`
						return
					}
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "email") {
					if (!this.isValidEmail(inputValue)) {
						errorMsg = `The email is invalid`
						return
					}
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "opinionScale") {
					const input_vl = parseInt(inputValue)
					console.log(input_vl)
					console.log(parseInt(item.data.settings.from))
					console.log(parseInt(item.data.settings.to))
					if (input_vl >= parseInt(item.data.settings.from)  && input_vl <= parseInt(item.data.settings.to)) {
						hasError = false
						activeItem = item
						shouldRenderAfterDone = true
						return
					}
					errorMsg = `The answer value is invalid`
					return
					
				}

				if (item.type === "rating") {
					const input_vl = parseInt(inputValue)
					if (input_vl > 0 && input_vl <= parseInt(item.data.settings.rating_points)) {
						hasError = false
						activeItem = item
						shouldRenderAfterDone = true
						return
					}
					errorMsg = `The rating value is invalid`
					return
					
				}

				if (item.type === "date") {
					const parent_wrapper_id = FormLayerComponents.wrapperElId
					const day = document.querySelector(`#${parent_wrapper_id} input[name='date-split-day']`)
					const month = document.querySelector(`#${parent_wrapper_id} input[name='date-split-month']`)
					const year = document.querySelector(`#${parent_wrapper_id} input[name='date-split-year']`)

					if (!day || !month || !year) {
						errorMsg = `Invalid date fields`
						return
					}
					if (day.value == '') {
						errorMsg = `The day field is required`
						return
					}
					if (month.value == '') {
						errorMsg = `The month field is required`
						return
					}
					if (year.value == '') {
						errorMsg = `The year field is required`
						return
					}

					
					const days = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"]
					const months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
					console.log(`Day: ${day.value} | Month: ${month.value} | Year: ${year.value}`)

					if (!days.includes(day.value)) {
						errorMsg = `The date day value is invalid, should be two digits in 01 to 31`
						return
					}
					if (!months.includes(month.value)) {
						errorMsg = `The date month value is invalid, should be two digits in 01 to 12`
						return
					}

					if (year.value.length !== 4) {
						errorMsg = `The date year value is invalid, should be 4 digits of a year`
						return
					}

					if (!this.isNumber(year.value)) {
						errorMsg = `The year value is invalid`
						return
					}

					//build date as iso date format - YYYY-MM-DD  so that later in display case we can change
					inputValue = `${year.value}-${month.value}-${day.value}`
					
					hasError = false
					activeItem = item
					return
				}


				if (item.type === "number") {
					if (!this.isNumber(inputValue)) {
						errorMsg = `The answer value is invalid`
						return
					}
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "dropdown") {
					//have to work with dropdown
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "legal") {
					const valueIN = ["accept", "not_accept"]
					if (!valueIN.includes(inputValue)) {
						errorMsg = `The answer value is invalid`
						return
					}
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "website") {
					if (!this.isValidURL(inputValue)) {
						errorMsg = `The url is invalid`
						return
					}
					hasError = false
					activeItem = item
					return
				}

				if (item.type === "birthday") {
					hasError = false
					activeItem = item
					return
				}
			}
		})

		if (hasError) {
			alert(errorMsg)
			if (calledFromNavigator) {
				return "dont_navigate"
			}
			return
		}



		//save the answer
		let is_updated = false
		if (currentAnswers.length) {
			//has items
			for(let i=0; i < currentAnswers.length; i++){
				//console.log(`loop id: ${currentAnswers[i]['question_id']} | active id ${activeItem.id}`)
				if (currentAnswers[i]['question_id'] === activeItem.id) {
					//update
					console.log(`Updating answer : ${inputValue}`)
					currentAnswers[i].response = inputValue
					this.saveAnswer(currentAnswers)
					is_updated = true
					break
				}
			}
		}

		//insert answer
		if (!is_updated) {
			console.log(`Inserting answer : ${inputValue}`)
			let newAnswer = this.answer_base_format
			newAnswer.question_id = activeItem.id
			newAnswer.question_type = activeItem.type
			newAnswer.response = inputValue
			currentAnswers.push(newAnswer)
			this.saveAnswer(currentAnswers)
		}

		if (shouldRenderAfterDone) {
			FormLayerComponents.renderLayer(activeItem.id)
		}
		
	}

	//preview file
	static filePreviewAndUpload(prefixID, index=null){
		if (prefixID == '') {
			alert(`Something wrong, the input identifier not found. Please refresh the page and try again`)
			return
		}
		const parent_wrapper_id = FormLayerComponents.wrapperElId
		let inputID = null

		if (index == null) {
			inputID = `#${parent_wrapper_id} input#${prefixID}`
		}else{
			inputID = `#${parent_wrapper_id} input#${prefixID}--${index}`
		}
		
		//console.log(`${inputID} | ${previewID}`)
		const input = document.querySelector(inputID)
		
		
		//console.log(input)
		//console.log(preview)
		if (input == null) {
			alert(`The target preview element not found, please refresh the page and try again`)
			return
		}
		
		if (input.value == '') {
			alert(`The file is required`)
			return
		}

		//preview file
		const file = input.files[0];
 		
 		let allow_types = ['image']
 		// if (isThemeBgImage) {
 		// 	allow_types.length = 1//allow only image
 		// }
 		if (!file) {
 			alert(`No file found`)
 			return
 		}

       
    	const fileType = file.type.split('/')[0]
    	if (!allow_types.includes(fileType)) {
    		alert(`The file type ${fileType} is not allowed`)
    		return 
    	}


    	//get current active item
    	const formData = FormLayerComponents.getFormData()
		console.log('the formData')
		console.log(formData)
		let currentAnswers = this.getAnswers();
		let activeItem = null

		if (!formData.length) {
			alert("Invalid request, no form data found")
			return
		}


		formData.map((item, index)=>{
			if (item.isActive) {
				activeItem = item
				return
			}
		})	

		if (activeItem == null) {
			alert(`Something went wrong, we didn't found active question`)
			return
		}


    	//upload file to the server
    	let myHeaders = new Headers();
  		//myHeaders.append("Authorization", this.publishable_key);
  		myHeaders.append('Accept', 'application/json');

		const formPostData = new FormData();
		formPostData.append('file', file);
		formPostData.append('form_id', FormLayerComponents.theFormID);
	    const options = {
	      method: 'POST',
	      headers: myHeaders,
	      body: formPostData
	    };

	    const apiHost = FormLayerComponents.apiHostURL
    	fetch(`${apiHost}/api/features/form/upload-file`, options)
    	.then(response => response.text())
    	.then(function(response){
    		console.log(response)
    		const res = JSON.parse(response)

    		if (res.success) {
    			console.log(`Hurrah file uploaded`)
    			
    			//save the answer
				let is_updated = false
				const isMultiFiles = (activeItem.type === "pictureChoice" && parseInt(activeItem.data.settings.total_pictures) > 1 ? true:false)
				if (currentAnswers.length) {
					//has items
					for(let i=0; i < currentAnswers.length; i++){
						//console.log(`loop id: ${currentAnswers[i]['question_id']} | active id ${activeItem.id}`)
						if (currentAnswers[i]['question_id'] === activeItem.id) {
							//update
							console.log(`Updating answer file upload`)
							if (!isMultiFiles) {
								currentAnswers[i].response = new Array()//
							}
							currentAnswers[i].response.push(res.file_name)
							
							FormAnswersHandler.saveAnswer(currentAnswers)
							is_updated = true
							break
						}
					}
				}

				//insert answer
				if (!is_updated) {
					console.log(`Inserting answer file upload`)
					let newAnswer = FormAnswersHandler.answer_base_format
					newAnswer.question_id = activeItem.id
					newAnswer.question_type = activeItem.type
					newAnswer.response = new Array()
					newAnswer.response.push(res.file_name)
					currentAnswers.push(newAnswer)
					FormAnswersHandler.saveAnswer(currentAnswers)
				}

				FormLayerComponents.renderLayer(activeItem.id)
				return
		    }

		    alert(res.msg)
    	})
    	.catch((error)=>{
    		alert("An error occured during file uploading...")
    		console.log(error)
    	})
	}

	static deleteFormFile(fileName){
		if (fileName == '') {
			alert("The file name is required")
			return
		}

		//get current active item
    	const formData = FormLayerComponents.getFormData()
		console.log('the formData')
		console.log(formData)
		let currentAnswers = this.getAnswers();
		let activeItem = null

		if (!formData.length) {
			alert("Invalid request, no form data found")
			return
		}


		formData.map((item, index)=>{
			if (item.isActive) {
				activeItem = item
				return
			}
		})

		if (activeItem == null) {
			alert(`Something went wrong, we didn't found active question`)
			return
		}

		//delete the file
		const isMultiFiles = (activeItem.type === "pictureChoice" && parseInt(activeItem.data.settings.total_pictures) > 1 ? true:false)
		
		//has items
		let is_file_found = false
		for(let i=0; i < currentAnswers.length; i++){
			//console.log(`loop id: ${currentAnswers[i]['question_id']} | active id ${activeItem.id}`)
			if (currentAnswers[i]['question_id'] === activeItem.id) {
				//update
				console.log(`Updating answer file delete`)
				if (!isMultiFiles) {
					//delete the answer fully
					currentAnswers.splice(i,  1)//remove the answer
					this.saveAnswer(currentAnswers)
					is_file_found = true
					break
				}else{

					currentAnswers[i].response.map((file_, fileIndex)=>{
						if (file_ === fileName) {
							console.log(`The file found`)
							currentAnswers[i].response.splice(fileIndex, 1)//remove the item
							if (!currentAnswers[i].response.length > 0) {
								currentAnswers.splice(i,  1)//remove the answer
							}
							is_file_found = true
							this.saveAnswer(currentAnswers)
							return
						}
					})
					
				}
			}
		}

		if (!is_file_found) {
			alert(`The is not found`)
			return
		}


    	//upload file to the server
    	let myHeaders = new Headers();
  		//myHeaders.append("Authorization", this.publishable_key);
  		myHeaders.append('Accept', 'application/json');
  		myHeaders.append('Content-Type', 'application/json');

	    const options = {
	      method: 'POST',
	      headers: myHeaders,
	      body: JSON.stringify({
	      	"fileName":fileName,
	      	"form_id":FormLayerComponents.theFormID
	      })
	    };

	    const apiHost = FormLayerComponents.apiHostURL
    	fetch(`${apiHost}/api/features/form/delete-file`, options)
    	.then(response => response.text())
    	.then(function(response){
    		console.log(response)
    		const res = JSON.parse(response)

    		if (res.success) {
    			//re render the layer
    			FormLayerComponents.renderLayer(activeItem.id)
    			console.log(`Hurrah file deleted from server`)
    			return
		    }
		    alert(res.msg)
    	})
    	.catch((error)=>{
    		alert("An error occured during file deleting...")
    		console.log(error)
    	})

	}


	static saveAnswer(answers){
		this.setPrarentRef()
		localStorage.setItem(this.answersStorageName, (answers.length > 0 ? JSON.stringify(answers): JSON.stringify(null)))
		console.log(`The current answers`)
		console.log(answers)

		// const toast = `
		// <div class="toasting-box-custom">
		// 	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #000000"><path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"></path></svg>
		// 	Your answer has been draft
		// </div>
		// `
		//const wrapper = document.getElementById(this.layerParentRef)
		//console.log(wrapper)
		//console.log(wrapper.querySelector(".toast-featured-form-custom-toster")[0])
		//wrapper.querySelector(".toast-featured-form-custom-toster")[0].innerHTML = toast
		// setTimeout(()=>{
		// 	wrapper.querySelector(`.toast-featured-form-custom-toster`).innerHTML = "";
		// }, 2000)
	}

	//submit the form
	static submitTheForm(shouldReturnConfirmation=true, isPopModal=true, alertMsg=null){
		if (shouldReturnConfirmation) {
			if (!confirm((alertMsg ? alertMsg : 'Are yous sure?'))) {
				return
			}
		}
		

		const formData = FormLayerComponents.getFormData()
		if (!formData.length) {
			alert(`The form data not found, invalid request!`)
			return
		}

		const currentAnswers = this.getAnswers();
		if (!currentAnswers.length) {
			alert(`Sorry, you did not response of any questions`)
			return
		}
		//check for email input
		let enteredEmailAddress = null
		for (let i = 0; i < currentAnswers.length; i++) {
			if (currentAnswers[i].question_type === "email") {
				if (currentAnswers[i].response != "") {
					enteredEmailAddress = currentAnswers[i].response;
					break;
				}
			}
		}

		if (!enteredEmailAddress) {
			const email_ = prompt("We didn't find any email, please enter your email");
			if (!email_) {
				return alert("Sorry email is required")
			}
			if (!this.isValidEmail(email_)) {
				return alert("Sorry the email address is not valid!")
			}
			enteredEmailAddress = email_
		}

		const settingsData = FormLayerComponents.getSettingsData()

		let myHeaders = new Headers();
  		//myHeaders.append("Authorization", this.publishable_key);
  		myHeaders.append('Accept', 'application/json');
  		myHeaders.append('Content-Type', 'application/json');

	    const options = {
	      method: 'POST',
	      headers: myHeaders,
	      body: JSON.stringify({
	      	"response_data":currentAnswers,
	      	"form_id":FormLayerComponents.theFormID,
	      	"responder_email":enteredEmailAddress
	      })
	    };

	    if (isPopModal) {
	    	const classPrefix = FormLayerComponents.elPrefixClass
		    const popup_modal = document.querySelector(`#${classPrefix}popup-modal-confirmation .lara-form-modal-body`)
		    if (!popup_modal) {
		    	alert(`Something wrong, the popup confirmation modal not found`)
		    	return
		    }
		    popup_modal.innerHTML = `<p style="color:#212121;font-size:16px;text-align:center">Please wait form is submitting...</p>`
	    }
	    

	    const apiHost = FormLayerComponents.apiHostURL

    	fetch(`${apiHost}/api/features/form/store`, options)
    	.then(response => response.text())
    	.then(function(response){
    		console.log(response)
    		const res = JSON.parse(response)
    		if (res.success) {
    			alert(res.msg)
    			localStorage.clear()
    			localStorage.clear()

    			if (settingsData.redirect_on_completion && settingsData.redirect_on_completion_to_url != '') {
    				window.location.href = settingsData.redirect_on_completion_to_url
    			}else{
    				window.location.href = window.location.href
    			}
    			
    		}else{
    			if (res.msg) {
    				alert(res.msg)
    			}else{
    				alert(`Something unkown error occured! please try again later.`)
    				window.location.reload(true)
    			}
    			
    		}
    		
    	})
    	.catch((error)=>{
    		console.log(error)
    		alert(`Something went wrong.... please reload the page and try again`)
    		
    		//window.location.reload(true)
    	})

    	//FormLayerComponents.confirmationModal('cancel')

	}



	//helpers methods
	static isValidURL(urlString) {
        let url;
        try {
            url = new URL(urlString);
        } catch (_) {
            return false;  
        }

        return url.protocol === "http:" || url.protocol === "https:";
    }

    static isNumber(number){
        const pattern = /^[0-9]$/;
        const arr = number.split('')
        //console.log(arr)
        for (let i = 0; i < arr.length; i++) {
            if (!pattern.test(arr[i])) {
                console.log(`${arr[i]} not a number`)
                return false
                break
            }
        }
        return true
    }

    static isValidEmail(email){
	  	return String(email)
	    .toLowerCase()
	    .match(
	      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	    );
		
    }

}
