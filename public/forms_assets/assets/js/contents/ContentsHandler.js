class ContentsHandler{
	static endScreenSerials = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"]
	static contentList = [
		{
			type:"welcomeScreen",
			icon:"fas fa-desktop",
			iconColor:"#000",
			iconBgColor:"#f1ece3",
			bgColor:"#f1ece3",
			title:"Welcome Screen",
			subTitle:"Invite your audience in"
		},
		{
			type:"multipleChoice",
			icon:"fas fa-check",
			iconColor:"#000",
			iconBgColor:"#d65c99",
			bgColor:"#d65c99",
			title:"Multiple Choice",
			subTitle:null
		},
		{
			type:"phoneNumber",
			icon:"fas fa-phone-alt",
			iconColor:"#000",
			iconBgColor:"#adebe4",
			bgColor:"#adebe4",
			title:"Phone Number",
			subTitle:null
		},
		{
			type:"shortText",
			icon:"fas fa-align-left",
			iconColor:"#000",
			iconBgColor:"#379cfb",
			bgColor:"#379cfb",
			title:"Short Text",
			subTitle:null
		},
		{
			type:"longText",
			icon:"fas fa-align-left",
			iconColor:"#000",
			iconBgColor:"#379cfb",
			bgColor:"#379cfb",
			title:"Long Text",
			subTitle:null
		},
		{
			type:"statement",
			icon:"fas fa-quote-left",
			iconColor:"#000",
			iconBgColor:"#d65c99",
			bgColor:"#d65c99",
			title:"Statement",
			subTitle:null
		},
		{
			type:"pictureChoice",
			icon:"fas fa-images",
			iconColor:"#000",
			iconBgColor:"#adebe4",
			bgColor:"#adebe4",
			title:"Picture choice",
			subTitle:null
		},
		{
			type:"ranking",
			icon:"fas fa-grip-lines",
			iconColor:"#000",
			iconBgColor:"#adebe4",
			bgColor:"#adebe4",
			title:"Ranking",
			subTitle:null
		},
		{
			type:"yesNo",
			icon:"fas fa-dot-circle",
			iconColor:"#000",
			iconBgColor:"#379cfb",
			bgColor:"#379cfb",
			title:"Yes/No",
			subTitle:null
		},
		{
			type:"email",
			icon:"far fa-envelope",
			iconColor:"#000",
			iconBgColor:"#d65c99",
			bgColor:"#d65c99",
			title:"Email",
			subTitle:null
		},
		{
			type:"opinionScale",
			icon:"fas fa-industry",
			iconColor:"#000",
			iconBgColor:"#adebe4",
			bgColor:"#adebe4",
			title:"Opinion Scale",
			subTitle:null
		},
		{
			type:"rating",
			icon:"fas fa-star",
			iconColor:"#000",
			iconBgColor:"#379cfb",
			bgColor:"#379cfb",
			title:"Rating",
			subTitle:null
		},
		{
			type:"matrix",
			icon:"fas fa-window-restore",
			iconColor:"#000",
			iconBgColor:"#d65c99",
			bgColor:"#d65c99",
			title:"Matrix",
			subTitle:null
		},
		{
			type:"date",
			icon:"fas fa-calendar-week",
			iconColor:"#000",
			iconBgColor:"#379cfb",
			bgColor:"#379cfb",
			title:"Date",
			subTitle:null
		},
		{
			type:"number",
			icon:"fas fa-sort-numeric-up-alt",
			iconColor:"#000",
			iconBgColor:"#adebe4",
			bgColor:"#adebe4",
			title:"Number",
			subTitle:null
		},
		{
			type:"dropdown",
			icon:"fas fa-chevron-down",
			iconColor:"#000",
			iconBgColor:"#d65c99",
			bgColor:"#d65c99",
			title:"Dropdown",
			subTitle:null
		},
		{
			type:"legal",
			icon:"fas fa-balance-scale-right",
			iconColor:"#000",
			iconBgColor:"#379cfb",
			bgColor:"#379cfb",
			title:"Legal",
			subTitle:null
		},
		{
			type:"fileUpload",
			icon:"fas fa-file-word",
			iconColor:"#000",
			iconBgColor:"#adebe4",
			bgColor:"#adebe4",
			title:"File upload",
			subTitle:null
		},
		{
			type:"website",
			icon:"fas fa-blog",
			iconColor:"#000",
			iconBgColor:"#d65c99",
			bgColor:"#d65c99",
			title:"Website",
			subTitle:null
		},
		{
			type:"birthday",
			icon:"fas fa-birthday-cake",
			iconColor:"#000",
			iconBgColor:"#efefef",
			bgColor:"#efefef",
			title:"Birthday",
			subTitle:null
		},
		{
			//special screen type
			type:"endScreen",
			title:"Ending Screen",
			icon:"fas fa-columns",
			iconColor:"#000"
		}

	]
	static defaultTitle = "Say hi! Recall information with @"



	static renderContentList(){
		let contentHTML = ""
		let contentListHTML = ""

		this.contentList.map((item, index)=>{
			if (item.type !== 'endScreen') {
				contentListHTML += `
				<div onclick="ContentsHandler.addContent('${item.type}')" class="row Welcome_screen pt-4 pb-4">
					<div class="col-2">
						<i style="color:${item.iconColor};background-color:${item.iconBgColor};padding:8px;border-radius:7px" class="${item.icon}"></i>
					</div>
					<div class="col-10">
						<h5 class=" text-dark">${item.title}</h5>
						${item.subTitle ? `<p class="invite">${item.subTitle}</p>` : ''}
					</div>
				</div>
				`
			}
		})


		contentHTML += `
		<div class="modal fade scroll_modal" id="contentListModal"
			tabindex="-1" role="dialog"
			aria-labelledby="contentListModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-head p-5">
						<h5 class="modal-title" id="contentListModalLabel">
							Choose a Question type
						</h5>
					</div>
					<div class="modal-body p-0">
						<div class="container">
							${contentListHTML}
						</div>
					</div>
				</div>
			</div>
		</div>
		`

		$("#renderContentList").html(contentHTML)
		$("#renderContentList #contentListModal").modal("show")
	}

	static getSelectedContents(){
		//@return type array
		//localStorage.clear()
		return localStorage.getItem(selectedContentsStorageName) != null ? JSON.parse(localStorage.getItem(selectedContentsStorageName)) : [];
	}

	//save a single type/item
	static saveSelectedContents(saveItem){
		/*
		@item should be an object
		format = {
			id:string|unique,
			type:shoule be content list type,
			isActive:true/false,
			data:{}
		}
		*/

		let selectedContents = this.getSelectedContents()
		/*
		if (saveItem.type === "welcomeScreen") {
			//alwasy push to first index
			if (!selectedContents.length) {
				selectedContents.push(saveItem)
			}else{
				selectedContents.splice(0, 0, saveItem)//add the item to the 0 index
			}
		}else{
			selectedContents.push(saveItem)
		}
		*/

		selectedContents.push(saveItem)
		console.log(`New item saved ${saveItem}`)
		localStorage.setItem(selectedContentsStorageName, JSON.stringify(selectedContents));
		//after save render again
		this.renderSelectedContents()
		Helpers.changesSavedAlert()
	}


	//render selected contents
	static renderSelectedContents(shouldRenderQustionTab=true){
		$("#list_panel").html('')

		let selectedContents = this.getSelectedContents()
		console.log("Current Selected Contents")
		console.log(selectedContents)

		if (!selectedContents.length) {
			console.log("No Selected Contents")
			return
		}
		

		//build html
		let selectedContentsHTML = ""
		let endScreenContentsHTML = ""
		let activeSelectedItem = ""
		let selectedContent = null

		selectedContents.map((item, index)=>{
			//get the target content
			this.contentList.map((content)=>{
				if (content.type === item.type) {
					selectedContent = content
				}
			})
			//console.log('Filtering')
			//console.log(selectedContent)

			if (item.isActive) {
				activeSelectedItem = `style="background-color: #f0f0f0"`
			}else{
				activeSelectedItem = `style="background-color: rgb(255, 255, 255);"`
			}


			if (item.type !== "endScreen") {
				selectedContentsHTML += `
					<div class="row ${item.type}" ${activeSelectedItem} title="${selectedContent.title}">
						<div class="col-8 p-4" onclick="ContentsHandler.renderLayer('${item.id}')">
							<button type="button" class="btn text-dark font-weight-bold" style="background-color:${selectedContent.bgColor}">
								<i style="color:${selectedContent.iconColor}" class="${selectedContent.icon}"></i>
								<label class="serial">&nbsp; &nbsp;${index+1}</label>
							</button>
						</div>
						<div class="col-4 text-right">
							<div class="dropdown dropdown_content pt-4">
								<a class="btn  px-0 dropdown-toggle" href="#" role="button" id="selectedContentActionDropdown_${index}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v float-right pt-2"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="selectedContentActionDropdown_${index}">
									${item.type !== "welcomeScreen"?
										`<label class="dropdown-item" href="#" onclick="ContentsHandler.duplicateSelectedContent('${item.id}')">Duplicate</label>`:``
									}
									<label class="dropdown-item" href="#" onclick="ContentsHandler.deleteSelectedContent('${item.id}')" style="display: block;">Delete</label>
								</div>
							</div>
						</div>
					</div>
				`
			}

		})

		$("#list_panel").html(selectedContentsHTML)
		

		//if any item is active then render the active layer and settings
		if (shouldRenderQustionTab) {
			QuestionHandler.renderQuestionHTML()
		}

		this.renderEndScreenContents()
		
	}

	static renderEndScreenContents(){
		$("#ending_screen_list").html("")
		let endScreenContentsHTML = ""
		let endScreenList = []
		let activeSelectedItem = ""

		this.getSelectedContents().map((item, index)=>{
			//get the target content
			if (item.type === "endScreen") {
				endScreenList.push(item)
			}
		})

		endScreenList.map((item, index)=>{

			if (item.isActive) {
				activeSelectedItem = `style="background-color: #f0f0f0"`
			}else{
				activeSelectedItem = `style="background-color: rgb(255, 255, 255);"`
			}

			endScreenContentsHTML += `
				<div class='d-flex justify-content-between w-100'>
					<div onclick="ContentsHandler.renderLayer('${item.id}')" class="col-12 first_row p-4"  data-title="Say bye! Recall information with @" ${activeSelectedItem}>
		                <button type="button" class="btn load_btn text-dark font-weight-bold">
		                	<i class="fas fa-angle-double-up text-dark"></i>
		                	&nbsp;&nbsp;
		                	<label>${this.endScreenSerials[index]}</label>
		                </button>
		            </div>
		            <div class="dropdown dropdown_content pt-4">
						<a class="btn  px-0 dropdown-toggle" href="#" role="button" id="selectedEndScreenContentActionDropdown_${index}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v float-right pt-2"></i>
						</a>
						<div class="dropdown-menu" aria-labelledby="selectedEndScreenContentActionDropdown_${index}">
							<label class="dropdown-item" href="#" onclick="ContentsHandler.deleteSelectedContent('${item.id}')" style="display: block;">Delete</label>
						</div>
					</div>
				</div>
			`
		})
		$("#ending_screen_list").html(endScreenContentsHTML)

	}


	//select a content type
	//during adding new content/list type 
	//attached a default theme
	static addContent(type){
		let selectItem = null
		let shouldContinueNext = true

		//validate type
		this.contentList.map((item, index)=>{
			if (item.type === type) {
				selectItem = item 
			}
		})

		if (selectItem === null) {
			alert(`The item (${type}) you have selected is invalid!`)
			return
		}

		/*
		//check what type of content is this
		if (selectItem.type === "welcomeScreen") {
			//check is there any welcome screen already exists or not
			this.getSelectedContents().map((selectedContent, index)=>{
				if (selectedContent.type === "welcomeScreen") {
					shouldContinueNext = false
					alert('You have already selected welcomeScreen')
					return
				}
			})
		}
		*/

		//if end screen then check limits
		if (selectItem.type === "endScreen") {
			//check current endScreens
			let endScreensNumber = 0
			this.getSelectedContents().map((selectedContent, index)=>{
				if (selectedContent.type === "endScreen") {
					endScreensNumber++ 
				}
			})
			if (this.endScreenSerials.length === endScreensNumber) {
				alert("You have reached the limit of end screens")
				return
			}
		}

		if (!shouldContinueNext) {
			return
		}

		//else save the item to storage
		const saveItem = {
			id:Helpers.genUniqID(),
			type:type,
			isActive:false,
			data: ContentDataFormats.formats[type]
		}
		this.saveSelectedContents(saveItem)

		//close all modals
		$(".modal").modal("hide")

	}

	//duplicate selected content item
	static duplicateSelectedContent(id){
		if (!confirm("Are you sure?")) {
			return
		}
		const duplicate_not_allowed = ["welcomeScreen", "endScreen"]
		const selectedContents = this.getSelectedContents()
		let shouldContinueNext = true
		let theNewItem = null
		selectedContents.map((item, index)=>{
			if (item.id === id) {
				if (duplicate_not_allowed.includes(item.type)) {
					alert(`The items ${duplicate_not_allowed} are not allowed to duplicte!`)
					shouldContinueNext = false
					return
				}else{
					//console.log("item found in loop")
					//console.log(item)
					theNewItem = item
				}
			}
		})

		if (!shouldContinueNext) {
			return
		}

		if (theNewItem==null) {
			alert('The item not found!')
			return
		}
		console.log("The item to be duplcate")
		console.log(theNewItem)

		theNewItem.id = Helpers.genUniqID()
		theNewItem.isActive = false
		
		//get items
		let currentSelectedContents = this.getSelectedContents()
		currentSelectedContents.push(theNewItem)
		localStorage.setItem(selectedContentsStorageName, JSON.stringify(currentSelectedContents))
		this.renderLayer()
		Helpers.changesSavedAlert()
	}


	//delete the selected content item
	static deleteSelectedContent(id){
		if (id === null) {
			alert("The id is requrired")
			return
		}
		if (!confirm('Are you sure?')) {
			return
		}

		const selectedContents = this.getSelectedContents()
		const newSelectedContents = selectedContents.filter((item)=>{
			if (id !== item.id) {
				return item
			}
		})
		console.log(`item removed ${id}`)
		localStorage.setItem(selectedContentsStorageName, JSON.stringify(newSelectedContents));
		//after remove render again
		this.renderLayer()
		Helpers.changesSavedAlert()
	}


	//type should be the active content layer type
	static renderLayer(id=null, shouldRenderSelectedContents=true){
		//console.log("Selected Contentents")
		//console.log(this.getSelectedContents())
		if (shouldRenderSelectedContents) {
			BaseLayout.leftContentLayout()
		}
		
		
		$("#whatMain").html("")
		let selectedContents = this.getSelectedContents()
		if (!selectedContents.length) {
			console.log('No selected content found')
			return
		}
		//console.log('selectedContents')
		//console.log(selectedContents)
		let selectItem = null

		if (id !== null) {
			let isItemValid = false

			//console.log(`Get curret  selected contents`)
			selectedContents.map((item)=>{
				if (item.id === id) {
					item.isActive = true
					selectItem = item
				}else{
					item.isActive = false
				}

			})

			//validate the content type & active the target conte type
			if (selectItem !== null) {
				this.contentList.map((item, index)=>{
					if (item.type === selectItem.type) {
						isItemValid = true
					}
				})

				if (!isItemValid) {
					alert(`Your selected content (${id}) is invalid!`)
					return
				}

				//console.log(`Updating to active`)
				localStorage.setItem(selectedContentsStorageName, JSON.stringify(selectedContents));
			}
			
		}else{
			//find the current active item if has
			selectedContents.map((item)=>{
				if (item.isActive) {
					selectItem = item
				}
			})
			
		}

		
		if (selectItem !== null) {
			//has active content...
			console.log(`Rendering ${id} layer`)
			const layerContent = ContentListLayer.layers[selectItem.type]
			$("#whatMain").html(layerContent)

			//console.log(`Again rendering selected contents`)
			if (shouldRenderSelectedContents) {
				this.renderSelectedContents()
			}
		}else{
			console.log(`No active content found...`)
			this.renderSelectedContents(false)//render selected contents but not render question tab...
		}
		
	}
}