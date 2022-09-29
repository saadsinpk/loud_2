class LogicHandler{
	static jump_options = [
		{label:"Submit Form", value:"submitForm"}
	]

	//a sample data format
	static outcomeQuizDataFormat = {
		multipleChoiceID:null,//set id of multi choise
		selected_option_indexes:[],//set selected options indexes
	}


	//the rules data format
	static branchingRulesOperators = [
		"is", "is_not"
	]
	static branchingRulesConditions = [
		"and", "or"
	]
	static branchingRulesDataFormat = {
		ruleType:"if",
		conditions:[
			{
				question_id:null,
				condition:"root_if",
				operator:this.branchingRulesOperators[0],
				optionIndex:null,
			}
		],
		then:{
			"jumpto":{
				"question_id":null//the content will set here to jump to
			},
		},
	}
	


	static renderLogicHTML(){
		BaseLayout.leftLogicsLayout()

		let htmlContent = ""
		htmlContent += `
			<div class="container p-0 pt-5">
				<p class="font-weight-bold">Content</p>
				<button type="button"
					class="btn btn-link text-dark text-left"
					onclick="LogicHandler.renderBranchingPanel()">
					<h4>Question branching</h4>
					<p id="question-branching-logic-unset">Send people down different paths</p>
				</button>
			</div>
			<div class="container p-0 pt-5 d-none">
				<p class="font-weight-bold">Endings</p>
				<button type="button" class="btn btn-link text-dark text-left"
				onclick="LogicHandler.renderOutcomeQuizPanel()">
					<h4>Outcome Quiz</h4>
					<p>Link answers to endings</p>
				</button>
			</div>
		`
		const htmlFLow = this.renderLogicsFlow()

		
		$("#myTabContent #main--content-left .left--logic-flow-space").html(htmlFLow)
		renderRightSidebarContent('logic', htmlContent)
	}

	static renderLogicsFlow(){
		let selected_content_types = []
		let selected_endScreen_types = []
		const selectedContents = ContentsHandler.getSelectedContents()
		let flowHTMLItems = ""
		let currentContent = null


		if (!selectedContents.length) {
			return `<div style="width: 100%; text-align: center; font-size: 16px; font-weight: bold; color: red; padding-top: 5%;">No Data Available</div>`
		}

		selectedContents.map((item, index)=>{
			if (item.type !== "endScreen") {
				selected_content_types.push(item)
			}else{
				selected_endScreen_types.push(item)
			}
		})

		selected_content_types.map((item, index)=>{
			currentContent = null
			ContentsHandler.contentList.map((content, contentIndex)=>{
				if (content.type === item.type) {
					currentContent = content
				}
			})

			flowHTMLItems += `
				
				<div class='flow-item-wrapper'>
					<div class="d-flex justify-content-center align-items-center ">
						<div class="flow-box">
							<div class='icon-box'>
								<div class='pr-2'><i class="${currentContent.icon}"></i></div>
								<div class='font-weight-bold'>${item.type === 'welcomeScreen' ? 'WS':index}</div>
							</div>
							<div class="">
								<h4 class='title'>${item.data.settings.title}</h4>
							</div>
						</div>
						<div class="flow-box-line">
							<div class="line"><i class='fas fa-arrow-right'></i></div>
						</div>
					</div>
				</div>
				
			`
		})
		

		if (selected_endScreen_types.length > 0) {

			flowHTMLItems += `<div class="verticalLine" style="min-height: 350px; width: 3px; background: #ddd;"></div>`
			flowHTMLItems += `<div class="endScreensWrapper">`
			selected_endScreen_types.map((item, index)=>{
				currentContent = null
				ContentsHandler.contentList.map((content, contentIndex)=>{
					if (content.type === item.type) {
						currentContent = content
					}
				})

				flowHTMLItems += `
					<div class="single-end-screen-box">
						<div class="boxy">
							<div class="line"></div>
							<div class="flow-box">
								<div class='icon-box'>
									<div class='pr-2'><i class="${currentContent.icon}"></i></div>
								</div>
								<div class="mt-2">
									<h4 class='title'>${item.data.settings.title}</h4>
								</div>
							</div>
						</div>
					</div>
				`
			})
			flowHTMLItems += `</div>`
		}


		return `
			<div class="d-flex justify-content-center align-items-center flow-block-wrapper p-5">
				${flowHTMLItems}
			</div>
		`
	}


	static renderBranchingPanel(isOpenModal=false){
		if (!isOpenModal) {
			//then remove modal id if exists
			$("#branchingPanelModal").remove()
		}
		
		const selectedContents = ContentsHandler.getSelectedContents()
		let selected_content_types = []
		let selected_ending_types = []
		let brachingHTML = ""

		selectedContents.map((item, index)=>{
			if (item.type !== "endScreen" && item.type !== "welcomeScreen") {
				selected_content_types.push(item)
			}else if(item.type === "endScreen"){
				selected_ending_types.push(item)
			}
		})
		//console.log(selected_content_types)

		selected_content_types.map((item, index)=>{
			//build html jump options
			const jumpToOptionsHTML = this.getJumpToOptionsHTML(index, item, selected_content_types, selected_ending_types)
			const rulesHTML = this.getBranchingRulesHTML(item);


			brachingHTML += `
				<div class="card mb-3">
					<div class="card-header d-flex justify-content-start align-items-center">
						<div><b>${index+1}.</b></div> <div style="background:transparent;border:none;outline:none;padding-left:10px;font-weight:bold">${item.data.settings.title}</div>
					</div>
					<div class="card-body">
						<div class="d-flex mb-3">
							<div>Always jump to</div>
							<div class="dropdown w-100 pl-3">
								<select class="form-control" onchange="LogicHandler.handleBranchingJumping('${item.id}', this.value)">
									${jumpToOptionsHTML}
								</select>
							</div>
						</div>
						${rulesHTML != ''?
							rulesHTML:``
						}
					</div>
					<div class='card-footer'>
						${item.type === "multipleChoice"?
							`<div>
								<button onclick="LogicHandler.addBranchingRule('${item.id}')" class='btn btn-secondary btn-sm'><i class='fas fa-plus'></i> Add Rule</button>
							</div>`:``
						}
					</div>
				</div>
			`
		})


		if (isOpenModal) {
			$("#branchingPanelModal .modal-body").html(brachingHTML)
			return
		}



		let branchingPanelModalHTML = ""
		branchingPanelModalHTML += `
			<div class="modal fade" id="branchingPanelModal" tabindex="-1" aria-labelledby="branchingPanelModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-xl">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="branchingPanelModalLabel">Branching and Calculations</h5>
			      </div>
			      <div class="modal-body" style="background:#eaeaea">
			        ${brachingHTML == '' ? `No Data Available` : brachingHTML}
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" onclick="LogicHandler.hideModal()" >Close</button>
			      </div>
			    </div>
			  </div>
			</div>
		`

		$("body").append(branchingPanelModalHTML)
		$("body #branchingPanelModal").modal('show')
	}



	static getJumpToOptionsHTML(currentItemIndex, currentItem, contents, endings){
		console.log(`currentItem in jump options`)
		console.log(currentItem)

		let jumpToOptionsHTML = `<option value="">None</option>`
		const contentList = contents[currentItemIndex]
		let selected = ""
		contents.map((item, index)=>{
			if (item.type !== currentItem.type) {
				if (currentItem.data.logics.branching.jump_to === item.id) {
					selected = "selected"
				}else{
					selected = ""
				}
				jumpToOptionsHTML += `
					<option ${selected} value="${item.id}">${index+1}. ${item.data.settings.title}</option>
				`
			}
		})

		if (endings.length) {
			jumpToOptionsHTML += `<option disabled>-- Ending Screens --</option>`
			endings.map((item, index)=>{
				if (currentItem.data.logics.branching.jump_to === item.id) {
					selected = "selected"
				}else{
					selected = ""
				}
				jumpToOptionsHTML += `<option ${selected} value="${item.id}">${index+1}. ${item.data.settings.title}</option>`
			})
		}

		//
		if (currentItem.data.logics.branching.jump_to === this.jump_options[0].value) {
			selected = "selected"
		}else{
			selected = ""
		}

		jumpToOptionsHTML += `<option ${selected} value="${this.jump_options[0].value}">${this.jump_options[0].label}</option>`
		return jumpToOptionsHTML
	}



	//handle data
	//========================================
	static handleBranchingJumping(contentID, value){
		if (contentID == '') {
			alert('Invalid data!')
			return
		}
		//validate content id
		let selectedContents = ContentsHandler.getSelectedContents();
		let contentIndex = null
		let isEndingScreen = false
		let valueIndex = null

		//validate content
		selectedContents.map((item, index)=>{
			if (item.id === contentID) {
				if (item.type === "welcomeScreen") {
					//alert('Invalid content type selected!')
					console.log('The welcomeScreen || endScreen is not allowed to set branching...')
					return
				}else{
					if (item.type === "endScreen") {
						isEndingScreen = true
					}
					contentIndex = index
				}
			}
		})



		//check data
		if (contentIndex == null) {
			alert('The content not found or invalid!')
			this.renderBranchingPanel(true)//true = modal is open
			return
		}

		if (value == '') {
			//set null value
			selectedContents[contentIndex].data.logics.branching.jump_to = null
			this.saveChanges(selectedContents)
			return
		}



		
		if (value === this.jump_options[0].value) {
			selectedContents[contentIndex].data.logics.branching.jump_to = this.jump_options[0].value
			this.saveChanges(selectedContents)
			return
		}

		//validate value
		selectedContents.map((item, index)=>{
			if (item.id === value) {
				valueIndex = index
			}
		})
		//check data
		if (valueIndex == null) {
			alert('The selected value is invalid')
			this.renderBranchingPanel(true)//true = modal is open
			return
		}

		//if ending screen
		if (isEndingScreen) {
			selectedContents[contentIndex].data.logics.branching.jump_to = value//the target item id
			this.saveChanges(selectedContents)
			return
		}

		//check the index is before
		//jump to back not possible
		if (valueIndex < contentIndex) {
			alert('Error! Jumping to back item is not possible\nPlease select an option that after of content')
			this.renderBranchingPanel(true)//true = modal is open
			return
		}

		selectedContents[contentIndex].data.logics.branching.jump_to = value//the target item id
		this.saveChanges(selectedContents)
	}


	//get html data of branching rules
	static getBranchingRulesHTML(theItem){
		if (theItem.type !== "multipleChoice") {
			return "";
		}
		//find the target content
		let selectedContents = ContentsHandler.getSelectedContents();
		let contentIndex = null

		//validate content
		selectedContents.map((item, index)=>{
			if (item.id === theItem.id) {
				contentIndex = index
			}
		})

		if (contentIndex == null) {
			return "Something wrong- the target multipleChoice type not found"
		}

		//check has rules or not
		if (theItem.data.logics.branching.rules == "" || theItem.data.logics.branching.rules == null) {
			return "";//no branching contents available
		}


		let htmlContent = ""
		let ruleTypeHTML = ""
		let questionDropdownsHTML = ""
		let optionsDropdownsHTML = ""
		let conditionOptionsHTML = ""
		
		theItem.data.logics.branching.rules.rules.map((rule, ruleIndex)=>{
			//console.log(`loop in rules`)
			htmlContent += `<div class="single-rule-wrapper mb-5" style="border: 1px solid #efefef; padding: 10px;">`
				htmlContent += `<div class="single-rule mb-2">`

				rule.conditions.map((condition, conditionIndex)=>{
					ruleTypeHTML = ""
					questionDropdownsHTML = ""
					optionsDropdownsHTML = ""
					conditionOptionsHTML = ""
					

					//get question dropdowns
					questionDropdownsHTML = this.getBranchingRulesHTMLDropdowns('contentsDropdown', condition, ruleIndex, conditionIndex, theItem)
					optionsDropdownsHTML  = this.getBranchingRulesHTMLDropdowns('optionsDropdown', condition, ruleIndex, conditionIndex, theItem)

					//first index condition should be alwasy root_if..
					this.branchingRulesConditions.map((cont)=>{
						conditionOptionsHTML += `<option ${condition.condition === cont?`selected`:``} value="${cont}">${cont}</option>`
					})

					if (condition.condition === "root_if") {
						ruleTypeHTML = `
							<select class="form-control">
								<option value="if" selected >${rule.ruleType}</option>
							</select>`
							conditionOptionsHTML = ""
					}

					htmlContent += `
						<div class="condition-parent-row mb-2">
							${
								conditionOptionsHTML != ''?
								`<div class="w-100 mb-2 mt-2">
									<select class="form-control" style="width:130px;margin-left:100px"
									onchange="LogicHandler.branchingConditionsOnChangeSave('condition', '${ruleIndex}', '${conditionIndex}', '${theItem.id}', this.value)">
										${conditionOptionsHTML}
									</select>
								</div>`:``
							}
							<div class="d-flex justify-content-between w-100">
								<div class="condtion-if mr-2" style="width:100px">
									${ruleTypeHTML}
								</div>
								<div class="parent-condition d-flex justify-content-between w-100 mb-3">
									<div class="w-100 mr-2">
										<div class="dropdown">
										  ${questionDropdownsHTML}
										</div>
									</div>
									<div style="width:60px">
										<button onclick="LogicHandler.removeBranchingRuleCondition(event, '${ruleIndex}', '${conditionIndex}', '${theItem.id}')" class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>
									</div>
								</div>
							</div>
						</div>
					`


					//get options logic
					htmlContent += `
						<div class="single-condition d-flex justify-content-between w-100">
							<div class="condtion-if mr-2" style="width:100px"></div>
							<div class="w-100 mr-2">
								<div class="d-flex justify-content-between">
									<div class="operator-box" style="width:130px">
										<select onchange="LogicHandler.branchingConditionsOnChangeSave('operator', '${ruleIndex}', '${conditionIndex}', '${theItem.id}', this.value)" class="form-control">
											<option ${condition.operator === 'is'?`selected`:``}  value="is">is</option>
											<option ${condition.operator === 'is_not'?`selected`:``} value="is_not">is not</option>
										</select>
									</div>
									<div class="dropdown w-100">
									  ${optionsDropdownsHTML}
									</div>
									<div style="width:60px">
										<button class='btn btn-secondary btn-sm d-none'><i class='fas fa-trash-alt'></i></button>
									</div>
								</div>
							</div>
						</div>
					`
				})

				htmlContent += "</div>" 


				//set add condition button
				htmlContent += `
				<div class='add-condition-btn mb-3'>
					<a href="" style="margin-left:100px" 
					onclick="LogicHandler.addBranchingRuleCondition(event, '${ruleIndex}', '${theItem.id}')"><i class='fas fa-plus'></i> Add Condition</a>
				</div>`

				//set then html
				optionsDropdownsHTML = ""
				optionsDropdownsHTML = this.getAllQuestionsAsDropdown(rule.then.jumpto.question_id, theItem, ruleIndex)

				htmlContent += `
					<div class="then d-flex justify-content-between w-100">
						<div class="condtion-if mr-2" style="width:100px">
							<select class="form-control">
								<option value="then" selected >Then</option>
							</select>
						</div>
						<div class="parent-condition d-flex justify-content-between w-100">
							<select class="form-control" style="width:130px">
								<option disabled>-- LOGIC --</option>
								<option selected>Jump to</option>
							</select>
							<div class="w-100">
								<div class="dropdown w-100">
								  ${optionsDropdownsHTML}
								</div>
							</div>
							<div style="width:60px"></div>
						</div>
					</div>
				`

				//set rule delete button
				htmlContent += `
				<div class='delete-rule-btn mb-3 text-right mt-3'>
					<a href="" style="margin-left:100px" onclick="LogicHandler.removeBranchingRule(event, '${ruleIndex}', '${theItem.id}')"><i class='fas fa-trash-alt'></i> Delete this rule</a>
				</div>`
			htmlContent += `</div>`//the rule wrapper end here


		})

		return htmlContent
	}


	static branchingConditionsOnChangeSave(propertyName, ruleIndex, conditionIndex, itemId, value){
		if (propertyName == '' || ruleIndex == '' || conditionIndex == '' || itemId == '' || value == '') {
			alert("Invalid request, please refresh the page and try again!")
			return
		}

		//find the target item
		let isDataUpdated = false
		let callThisFunctionAgain = false

		let selectedContents = ContentsHandler.getSelectedContents();
		selectedContents.map((item, index)=>{
			if (item.id === itemId && item.type === 'multipleChoice') {
				if (item.data.logics.branching.rules == '' || item.data.logics.branching.rules == null || !item.data.logics.branching.rules.hasOwnProperty('rules')) {
					//set rules
					item.data.logics.branching.rules = {
						"rules":[],
						"in_all_other_cases_jump_to":{"content_id":null}
					}

					let newRule = this.branchingRulesDataFormat
					newRule.conditions[0].question_id = itemId//default set the current multipleChoice id
					newRule.conditions[0].optionIndex = 0//set default 

					item.data.logics.branching.rules["rules"].push(newRule)
					
					this.saveChanges(selectedContents, false, false)
					callThisFunctionAgain = true
					return
					
				}

				if (item.data.logics.branching.rules.rules[ruleIndex]) {
					
					if (item.data.logics.branching.rules.rules[ruleIndex]["conditions"][conditionIndex]) {
						//check has the property
						if (item.data.logics.branching.rules.rules[ruleIndex]["conditions"][conditionIndex].hasOwnProperty(propertyName)) {
							item.data.logics.branching.rules.rules[ruleIndex]["conditions"][conditionIndex][propertyName] = value
							if (propertyName === "question_id") {
								item.data.logics.branching.rules.rules[ruleIndex]["conditions"][conditionIndex]["optionIndex"] = 0//set default option as 0
							}
							isDataUpdated = true
							this.saveChanges(selectedContents)
							return
						}
					}

				}
			}
		})

		if (callThisFunctionAgain) {
			this.branchingConditionsOnChangeSave(propertyName, ruleIndex, conditionIndex, itemId, value);
			return
		}
		if (!isDataUpdated) {
			alert("Something went wrong, the condition was not added")
			return
		}

	}


	static isQuestionIdValid(questionID){
		let isValid = false
		ContentsHandler.getSelectedContents().map((item, index)=>{
			if (item.id === questionID && item.type !== 'welcomeScreen') {
				isValid = true
				return
			}
		})
		return isValid
	}
	static addBranchingRuleCondition(e, ruleIndex, itemId){
		e.preventDefault()

		if (itemId.id == '' || ruleIndex == '') {
			alert("Invalid request, please refresh the page and try again!")
			return
		}

		//find the target item
		let isItemAdded = false
		let selectedContents = ContentsHandler.getSelectedContents();
		selectedContents.map((item, index)=>{
			if (item.id === itemId && item.type === 'multipleChoice') {
				if (item.data.logics.branching.rules.rules[ruleIndex]) {
					
					item.data.logics.branching.rules.rules[ruleIndex]["conditions"].push({
					    question_id: item.id,
					    condition: this.branchingRulesConditions[0],
					    operator: this.branchingRulesOperators[0],
					    optionIndex: 0
					})
					this.saveChanges(selectedContents)
					isItemAdded = true
				}
			}
		})

		if (!isItemAdded) {
			alert("Something went wrong, the condition was not added")
			return
		}
	}



	static removeBranchingRule(e, ruleIndex, itemId){
		e.preventDefault()
		if (!confirm('Are you sure?')) {
			return
		}

		if (itemId.id == '' || ruleIndex == '') {
			alert("Invalid request, please refresh the page and try again!")
			return
		}

		//find the target item
		let isItemRemoved = false
		let selectedContents = ContentsHandler.getSelectedContents();
		selectedContents.map((item, index)=>{
			if (item.id === itemId && item.type === 'multipleChoice') {
				if (item.data.logics.branching.rules.rules[ruleIndex]) {
					if (item.data.logics.branching.rules.rules.length == 1) {
						//so its last item
						item.data.logics.branching.rules = null//revert to initial data format
					}else{
						item.data.logics.branching.rules.rules.splice(ruleIndex, 1)//remove the item
					}
					
					this.saveChanges(selectedContents)
					isItemRemoved = true
				}
			}
		})

		if (!isItemRemoved) {
			alert("The rule was not found")
			return
		}

	}

	static removeBranchingRuleCondition(e, ruleIndex, conditionIndex, itemId){
		e.preventDefault()
		if (!confirm('Are you sure?')) {
			return
		}

		if (ruleIndex == '' || conditionIndex == '' || itemId == '') {
			alert("Invalid request, please refresh the page and try again!")
			return
		}

		//find the target item
		let isItemRemoved = false
		let selectedContents = ContentsHandler.getSelectedContents();
		selectedContents.map((item, index)=>{
			if (item.id === itemId && item.type === 'multipleChoice') {
				if (item.data.logics.branching.rules.rules[ruleIndex]) {
					if (item.data.logics.branching.rules.rules[ruleIndex]['conditions'][conditionIndex]) {
						//check is it last index or not
						
						if (item.data.logics.branching.rules.rules[ruleIndex]['conditions'].length == 1) {
							console.log(`The last condition can't be delete`)
							isItemRemoved = true
							return
						}

						//remove the target index
						item.data.logics.branching.rules.rules[ruleIndex]['conditions'].splice(conditionIndex, 1)//remove the item
						//now check if there only one item make it condition null
						if (item.data.logics.branching.rules.rules[ruleIndex]['conditions'].length == 1) {
							item.data.logics.branching.rules.rules[ruleIndex]['conditions'][0].condition = "root_if"
						}
						isItemRemoved = true
						this.saveChanges(selectedContents)
					}
					
				}
			}
		})

		if (!isItemRemoved) {
			alert("The condition was not found")
			return
		}
	}

	static getBranchingRulesHTMLDropdowns(type, currentCondition, ruleIndex, conditionIndex, theItem){
		//return "ok init"
		const types =["contentsDropdown", "optionsDropdown"]
		if (!types.includes(type)) {
			return "Invalid Type to Build Dropdown"
		}
		

		let htmlSelectedOption = ""
		let htmlDropdowns = `<div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">`
		const selectedContents = ContentsHandler.getSelectedContents();
		
		if (type === types[0]) {
			//build drowpdown for mulitplseChose type content only
			selectedContents.map((item, index)=>{
				if (item.type === "multipleChoice") {
					if (currentCondition.question_id === item.id) {
						//active item
						htmlSelectedOption = `
							<button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
							    ${item.data.settings.title}
							</button>`
					}else{
						htmlDropdowns += `<span class="dropdown-item w-100" style="cursor:pointer"
						onclick="LogicHandler.branchingConditionsOnChangeSave('question_id', '${ruleIndex}', '${conditionIndex}', '${theItem.id}', '${item.id}')">${item.data.settings.title}</span>`	
					}
					
				}
			})
			htmlDropdowns += '</div>'
			htmlDropdowns = htmlSelectedOption+htmlDropdowns
			return htmlDropdowns
		}


		//options
		//build drowpdown for options
		selectedContents.map((item, index)=>{
			if (item.type === "multipleChoice" && currentCondition.question_id === item.id) {
				item.data.settings.options.map((option, optionIndex)=>{
					if (optionIndex == currentCondition.optionIndex) {
						//active item
						htmlSelectedOption = `
							<button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
							    ${option.value}
							</button>`
					}else{
						htmlDropdowns += `<span class="dropdown-item w-100" style="cursor:pointer"
							onclick="LogicHandler.branchingConditionsOnChangeSave('optionIndex', '${ruleIndex}', '${conditionIndex}', '${theItem.id}', '${optionIndex}')">${option.value}</span>`	
					}
				})
			}
		})

		htmlDropdowns += '</div>'
		htmlDropdowns = htmlSelectedOption+htmlDropdowns
		return htmlDropdowns
	}

	//add branching rule
	static addBranchingRule(contentID){
		if (contentID == '') {
			alert("The target multipleChoice id is required")
			return
		}

		//find the target content
		let selectedContents = ContentsHandler.getSelectedContents();
		let contentIndex = null
		let shouldContinueNext = true

		//validate content
		selectedContents.map((item, index)=>{
			if (item.id === contentID) {
				if (item.type !== "multipleChoice") {
					alert("The content type is invalid")
					return
				}else{
					contentIndex = index
				}
			}
		})

		if (contentIndex == null) {
			console.log("The contentIndex is null")
			return
		}

		//check is there any rules already added or not
		if (selectedContents[contentIndex].data.logics.branching.rules == '' || 
			selectedContents[contentIndex].data.logics.branching.rules == null || 
			!selectedContents[contentIndex].data.logics.branching.rules.hasOwnProperty("rules")) {
			//no rules added
			selectedContents[contentIndex].data.logics.branching.rules = {
				"rules":[],
				"in_all_other_cases_jump_to":{"content_id":null}
			}
		}
		//now add rule
		let newRule = this.branchingRulesDataFormat
		newRule.conditions[0].question_id = selectedContents[contentIndex].id//default set the current multipleChoice id
		newRule.conditions[0].optionIndex = 0//set default 

		selectedContents[contentIndex].data.logics.branching.rules.rules.push(newRule)
		
		this.saveChanges(selectedContents)
	}

	static getAllQuestionsAsDropdown(selectedItemID, excludeItem, ruleIndex){
		let htmlSelectedOption = ""
		let htmlDropdowns = `<div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">`
		const selectedContents = ContentsHandler.getSelectedContents();
		let isSelectedContentFound = false

		selectedContents.map((item, index)=>{
			if (item.id !== excludeItem.id && item.type !== 'welcomeScreen') {
				if (selectedItemID === item.id) {
					//active item
					htmlSelectedOption = `
						<button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
						    ${item.data.settings.title}
						</button>`
					isSelectedContentFound = true
				}else{
					htmlDropdowns += `<span onclick="LogicHandler.branchingRulesThenJumpToSave('${excludeItem.id}', '${ruleIndex}', '${item.id}')" class="dropdown-item w-100" style="cursor:pointer">${item.data.settings.title}</span>`	
				}
				
			}
		})

		if (!isSelectedContentFound) {
			htmlSelectedOption = `
				<button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
				    Select
				</button>`
		}
		htmlDropdowns += '</div>'
		htmlDropdowns = htmlSelectedOption+htmlDropdowns
		return htmlDropdowns
	}

	static branchingRulesThenJumpToSave(itemID, ruleIndex, newItemID){
		let isDataUpdated = false
		let selectedContents = ContentsHandler.getSelectedContents();
		let theTargetItemIndex = null

		selectedContents.map((item, index)=>{
			if (item.id === itemID && item.type === 'multipleChoice') {
				theTargetItemIndex = index
				return
			}
		})

		if (theTargetItemIndex == null) {
			alert("The item id not found")
			return
		}
		//check index
		if (!selectedContents[theTargetItemIndex].data.logics.branching.rules.rules[ruleIndex]) {
			alert("Invalid rule index")
			return
		}
		//validate new item id
		if (!this.isQuestionIdValid(newItemID)) {
			alert("The selected question is not valid")
			return
		}
		//update data
		selectedContents[theTargetItemIndex].data.logics.branching.rules.rules[ruleIndex].then.jumpto.question_id = newItemID
		this.saveChanges(selectedContents)

	}



	//common method to save data
	static saveChanges(list, renderModal=true, alertChanges=true){
		console.log('Saving logics branching...')
		localStorage.setItem(selectedContentsStorageName, JSON.stringify(list));
		if(renderModal){
			//true = modal is open
			this.renderBranchingPanel(true)
		}
		
		if (alertChanges) {
			Helpers.changesSavedAlert()
		}
	}




	//outcome quiz
	//=======================================
	//modal of outcome quiz
	static renderOutcomeQuizPanel(isOpenModal=false){
		if (!isOpenModal) {
			//then remove modal id if exists
			$("#outcomeQuizModal").remove()
		}
		let htmlContent = ""
		let outComeHTML = ""
		const selectedContents = ContentsHandler.getSelectedContents()
		let selected_content_types = []
		let selected_ending_types = []
		let multipleChoices = []
		let multipleChoicesSelectedOptionsHTML = ""
		let multipleChoicesHTML = ""

		selectedContents.map((item, index)=>{
			if (item.type !== "endScreen" && item.type !== "welcomeScreen") {
				selected_content_types.push(item)
			}else if(item.type === "endScreen"){
				selected_ending_types.push(item)
			}
			if(item.type === "multipleChoice"){
				multipleChoices.push(item)
			}
		})

		
		

		selected_ending_types.map((item, index)=>{
			multipleChoicesHTML = ""
			multipleChoicesSelectedOptionsHTML = ""

			if (item.data.logics.outcome.length) {
				console.log("item.data.logics.outcome")
				console.log(item.data.logics.outcome)
				item.data.logics.outcome.map((outcomeMulti, outcomeIndex)=>{
					if(!outcomeMulti.selected_option_indexes) return

					if (outcomeMulti.selected_option_indexes.length) {
						outcomeMulti.selected_option_indexes.map((multiOptionsIndex, outcomeOptionIndex)=>{
							//console.log(`${outcomeOption.value}`)
							const the_target_option = this.getOptionFromMultipleChoise(item.id, outcomeIndex, outcomeOptionIndex, selected_content_types, outcomeMulti.multipleChoiceID, multiOptionsIndex)
							if (the_target_option) {
								multipleChoicesSelectedOptionsHTML += `
								<div class='selected-outcome-quiz-option'>
									${the_target_option.value} 
									<i title="Remove this option" class='fas fa-times' style="padding:0px 5px 0 5px"
									onclick="LogicHandler.removeOutcomeSelectedOption('${item.id}', '${outcomeIndex}', '${outcomeOptionIndex}')"></i>
								</div>`
							}
							
						})
					}
				})
			}
			multipleChoicesHTML = this.getMultiChoisesHTML(multipleChoices, item)
			
			outComeHTML += `
				<div class="card mb-3" style="border-radius:5px;padding:10px">
					<div class="card-header" style="display:block">
						<b>${ContentsHandler.endScreenSerials[index]}. ${item.data.settings.title}</b>
						<div class="dropdown mb-4 mt-3">
						  	${multipleChoicesSelectedOptionsHTML != ""?
						    	`
						    		<div style="display:flex;justify-content:start;align-items:center; background-color:#E4E6EF;padding:5px">
						    			${multipleChoicesSelectedOptionsHTML}
						    		</div>
						    	`
						    	:``
						    }
						  <button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button" id="dropdownMenuButton_${index}" data-toggle="dropdown" aria-expanded="false"
						  style="border-radius:0">
						    Choose Answers
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_${index}">
						    ${multipleChoicesHTML != ''? multipleChoicesHTML : `No Multiple Choices Question Found`}
						  </div>
						</div>
					</div>
				</div>
			`
		})

		//if there any ending screens
		if (!selected_ending_types.length) {
			outComeHTML = `No ending screen found`
		}


		if (isOpenModal) {
			$("#outcomeQuizModal .modal-body").html(outComeHTML)
			return
		}

		htmlContent += `
		<div class="modal fade" id="outcomeQuizModal" tabindex="-1" aria-labelledby="outcomeQuizModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="outcomeQuizModalLabel">Outcome Quiz</h5>
		        <button type="button" class="close" onclick="LogicHandler.hideModal()">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        ${outComeHTML}
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" onclick="LogicHandler.hideModal()" >Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		`

		$("body").append(htmlContent)
		$("body #outcomeQuizModal").modal('show')
	}



	static getMultiChoisesHTML(multipleChoices, endScreen){
		let multipleChoicesHTML = ""

		multipleChoices.map((mutli, index)=>{
			multipleChoicesHTML += `<span class="dropdown-item" href="#" style="cursor:auto;font-weight:bold">${index+1}. ${mutli.data.settings.title}</span>`
			mutli.data.settings.options.map((option, optionIndex)=>{
				multipleChoicesHTML += `
					<span class="dropdown-item" href="#" style="cursor:pointer;display: flex; justify-content: start; align-items: center;"
					onclick="LogicHandler.saveOutcomeQuiz('${endScreen.id}', '${mutli.id}', '${optionIndex}')">
						<span style="background-color:#d65c99;color:#fff;padding:5px 10px;margin-right:5px;border-radius:4px">${option.label}</span> 
						${option.value}
					</span>`
			})
		})
		return multipleChoicesHTML
	}

	static saveOutcomeQuiz(endScreenID, multipleChoiceID, optionIndexNo){
		if (endScreenID == '') {
			alert('The end screen id is required')
			return
		}
		if (multipleChoiceID == '') {
			alert('The multiple choice id is required')
			return
		}
		if (isNaN(optionIndexNo)) {
			alert('The option index number is required')
			return
		}

		//get data and validate
		let selectedContents = ContentsHandler.getSelectedContents()
		let endScreenItemIndex = null
		let multiChoiseItemIndex = null
		let errorMsg = null

		//validate end screen id
		selectedContents.map((item, index)=>{
			if (item.id === endScreenID) {
				if (item.type === "endScreen") {
					endScreenItemIndex = index
				}else{
					errorMsg = 'Invalid endScreen selected!'
					return
				}
			}
		})

		//validate multi choice
		selectedContents.map((item, index)=>{
			if (item.id === multipleChoiceID) {
				if (item.type === "multipleChoice") {
					multiChoiseItemIndex = index
				}else{
					errorMsg = 'Invalid multiple choice type selected!'
					return
				}
			}
		})

		if (errorMsg != null) {
			alert(errorMsg)
			return
		}

		//check mutl has options
		if (!selectedContents[multiChoiseItemIndex].data.settings.options.length) {
			alert(`Invalid options selected- the multiple choise ${selectedContents[multiChoiseItemIndex].data.settings.title} has no options`)
			return
		}
		//check option index is valid
		if (!selectedContents[multiChoiseItemIndex].data.settings.options[optionIndexNo]) {
			alert(`The option you have selected is invalid!`)
			return
		}

		//check the option is already selected or not
		if (selectedContents[endScreenItemIndex].data.logics.outcome.length > 0) {
			selectedContents[endScreenItemIndex].data.logics.outcome.map((outCome, index)=>{
				if (outCome.multipleChoiceID === multipleChoiceID) {
					if (!outCome.selected_option_indexes) return

					if (outCome.selected_option_indexes.length) {
						outCome.selected_option_indexes.map((optionIndex)=>{
							if (optionIndex == optionIndexNo) {
								errorMsg = "You have already selected option"
								return
							}
						})
					}
				}
			})
		}

		if (errorMsg != null) {
			alert(errorMsg)
			return
		}

		//save changes
		let isDataSaved = false
		if (selectedContents[endScreenItemIndex].data.logics.outcome.length > 0) {
			selectedContents[endScreenItemIndex].data.logics.outcome.map((outCome, index)=>{
				if (outCome.multipleChoiceID === multipleChoiceID) {
					//update
					if (!outCome.selected_option_indexes) {
						outCome["selected_option_indexes"] = new Array()
					}
					outCome.selected_option_indexes.push(optionIndexNo)
					this.saveOutcomeQuizChanges(selectedContents)
					isDataSaved = true
					return
				}
			})
		}

		if (isDataSaved) {
			return
		}

		//save new item
		let new_data = this.outcomeQuizDataFormat
		new_data.multipleChoiceID = multipleChoiceID
		new_data.selected_option_indexes.push(optionIndexNo)
		selectedContents[endScreenItemIndex].data.logics.outcome.push(new_data)
		this.saveOutcomeQuizChanges(selectedContents)
	}

	static getOptionFromMultipleChoise(endScreenID, outcomeIndex, outcomeOptionIndex, selectedContents, multipleChoiceID, multiOptionsIndex){
		//get the specific target index
		let targetOption = null
		selectedContents.map((item, index)=>{
			if (item.id === multipleChoiceID && item.type === "multipleChoice") {
				//the item type should be mutliple choice
				if (item.data.settings.options[multiOptionsIndex]) {
					targetOption = item.data.settings.options[multiOptionsIndex]
					return
				}else{
					//delete the index from outcome....
					targetOption = false 
				}
			}
		})

		if (!targetOption) {
			//delete
			console.log(`The target option index not found in multiChoiseItemIndex...so remvong from outcome`)
			this.removeOutcomeSelectedOption(endScreenID, outcomeIndex, outcomeOptionIndex, false)//don't render anything
		}
		return targetOption
	}

	static removeOutcomeSelectedOption(endScreenID, outcomeIndex, optionIndex, shouldRenderNext=true){
		if (endScreenID == '') {
			alert('The target endScreen id is required')
			return
		}
		if (isNaN(outcomeIndex)) {
			alert('The outcome multi choice index is requried')
			return
		}
		if (isNaN(optionIndex)) {
			alert('The option index is requried')
			return
		}

		//find end screen
		let selectedContents = ContentsHandler.getSelectedContents()
		let endScreenItemIndex = null
		let shouldContinueNext = false
		selectedContents.map((item, index)=>{
			if (item.id === endScreenID && item.type === "endScreen") {
				endScreenItemIndex = index
				shouldContinueNext = true
				return
			}
		})
		if (!shouldContinueNext) {
			alert("The end screen not found")
			return
		}

		//validate indexes
		if (!selectedContents[endScreenItemIndex].data.logics.outcome[outcomeIndex]) {
			alert("The outcome multi index not found")
			return
		}

		if (!selectedContents[endScreenItemIndex].data.logics.outcome[outcomeIndex].selected_option_indexes[optionIndex]) {
			alert("The outcome option index not found")
			return
		}

		selectedContents[endScreenItemIndex].data.logics.outcome[outcomeIndex].selected_option_indexes.splice(optionIndex, 1)//remove the target index
		this.saveOutcomeQuizChanges(selectedContents, shouldRenderNext)

	}


	static saveOutcomeQuizChanges(list, shouldRenderNext=true){
		console.log('Saving outcome quiz...')
		localStorage.setItem(selectedContentsStorageName, JSON.stringify(list));
		if (shouldRenderNext) {
			this.renderOutcomeQuizPanel(true)
			Helpers.changesSavedAlert()
		}
	}


	static deleteMultipleChoiceFromOutcomeQuiz(multipleChoiceID){
		let isDataRemoved = false
		let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.type === "endScreen") {
				//search end screen
				if (item.data.logics.outcome.length) {
					item.data.logics.outcome.map((outcome, outcomeIndex)=>{
						if (outcome.multipleChoiceID === multipleChoiceID) {
							item.data.logics.outcome.splice(outcomeIndex, 1)//remove one item
							isDataRemoved = true
						}
					})
				}
			}
		})

		if (isDataRemoved) {
			this.saveOutcomeQuizChanges(selectedContents, false)
		}
	}


	static hideModal(){
		$(".modal").modal("hide")
	}
}