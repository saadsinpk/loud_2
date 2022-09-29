class ContentListLayer{
	static layers = {
		"welcomeScreen":this.welcomeScreenLayer,
		"multipleChoice":this.multipleChoiceLayer,
		"phoneNumber":this.phoneNumberLayer,
		"shortText":this.shortOrLongTextLayer,
		"longText":this.shortOrLongTextLayer,
		"statement":this.statementLayer,
		"pictureChoice":this.pictureChoiceLayer,
		"ranking":this.rankingLayer,
		"yesNo":this.yesNoLayer,
		"email":this.emailLayer,
		"opinionScale":this.opinionScaleLayer,
		"rating":this.ratingLayer,
		"matrix":this.matrixLayer,
		"date":this.dateLayer,
		"number":this.numberLayer,
		"dropdown":this.dropdownLayer,
		"legal":this.legalLayer,
		"fileUpload":this.fileUploadLayer,
		"website":this.websiteLayer,
		"birthday":this.birthdayLayer,
		"endScreen":this.endScreenLayer,
	}

	static welcomeScreenLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)

	}

	static multipleChoiceLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withMultiChoice(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)

	}



	static phoneNumberLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, 'addPhoneElement', 'before')
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static shortOrLongTextLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, 'addAnswerElement', 'before')
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static statementLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}



	static pictureChoiceLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withPictureChoice(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
		
	}


	static rankingLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withMultiChoice(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static yesNoLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withYesNo(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static emailLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, "addEmailElement", "before")
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static opinionScaleLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withOpinionScale(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static ratingLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withRating(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static matrixLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withMatrix(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static dateLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withDate(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static numberLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, "addNumberElement", "before")
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static dropdownLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, "addDropdownElement", "before")
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static legalLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withLegal(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static fileUploadLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withFileUpload(data)
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static websiteLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, "addWebsiteElement", "before")
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

	static birthdayLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, "addDateSelectElement", "before")
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}


	static endScreenLayer(){
		let data = null
		
		//find the element
		ContentsHandler.getSelectedContents().map((item)=>{
			if (item.isActive) {
				data = item
			}
		})
		console.log('The layer data')
		console.log(data)
	

		//set data's
		const box1HTML = LayerComponents.box1(data)
		const box2HTML = LayerComponents.box2(data)
		const box3HTML = LayerComponents.box3_withButton(data, "addSocialIconsElement", "before")
		

		//build layer layout
		return LayerLayoutHandler.layoutBuilder(box1HTML, box2HTML, box3HTML, data)
	}

}