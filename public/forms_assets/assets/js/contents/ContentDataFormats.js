class ContentDataFormats{
	static defaultLayout = "layout1"
	static multipleChoiceOptionsLabel = {
		options_max:26,
		labels:["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"]
	}

	static formats = {
		"welcomeScreen":this.welcomeScreenFormat(),
		"multipleChoice":this.multipleChoiceFormat(),
		"phoneNumber":this.phoneNumberFormat(),
		"shortText":this.shortTextFormat(),
		"longText":this.longTextFormat(),
		"statement":this.statementFormat(),
		"pictureChoice":this.pictureChoiceFormat(),
		"ranking":this.rankingFormat(),
		"yesNo":this.yesNoFormat(),
		"email":this.emailFormat(),
		"opinionScale":this.opinionScaleFormat(),
		"rating":this.ratingFormat(),
		"matrix":this.matrixFormat(),
		"date":this.dateFormat(),
		"number":this.numberFormat(),
		"dropdown":this.dropdownFormat(),
		"legal":this.legalFormat(),
		"fileUpload":this.fileUploadFormat(),
		"website":this.websiteFormat(),
		"birthday":this.birthdayFormat(),
		"endScreen":this.endScreenFormat()
	}

	
	static welcomeScreenFormat(){
		const obj = {
			"settings":{
				title:"Say hi! Recall information with @",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"Start",
				image_or_video_id:null,
				image_path:null,
				image_brightness:50,//by defaultnull0
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}


	static multipleChoiceFormat(){
		const obj = {
			"settings":{
				title:"Your question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				multi_select:false,//if multi select true, then render options as checkbox either radio
				randomize:false,
				other_option:false,
				options:[
					//by default one options will be available....
					{label:this.multipleChoiceOptionsLabel.labels[0], value:"choice"}
				],
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null,
					"rules":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static phoneNumberFormat(){
		const obj = {
			"settings":{
				title:"Yes question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				country:null,
				show_button:true,
				button_text:"OK",
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static shortTextFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"OK",
				required:false,
				max_characters:false,
				max_characters_input:255,//default
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static longTextFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"OK",
				required:false,
				max_characters:false,
				max_characters_input:64000,//default
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static statementFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				quotation_marks:true,
				show_button:true,
				button_text:"Continue",
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static pictureChoiceFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				show_labels:false,
				superize:false,
				multi_select:false,
				randomize:false,
				other_option:false,
				total_pictures:1,//by default picture can be upload
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static rankingFormat(){
		const obj = {
			"settings":{
				title:"Your question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				options:[
					//by default one options will be available....
					{label:this.multipleChoiceOptionsLabel.labels[0], value:"choice"}
				],
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static yesNoFormat(){
		const obj = {
			"settings":{
				title:"Yes question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static emailFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"Ok",
				required:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static opinionScaleFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				from:0,//default min 0 and max 1
				to:5,//default min 5 and max 10
				first_label:null,
				second_label:null,
				third_label:null,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static ratingFormat(){
		const obj = {
			"settings":{
				title:"Yes question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				rating_points:5,//default
				selected_rating_icon:'star',//default,
				rating_icons:[
					{label:"Start", value:"star"},
					{label:"Lightbulbs", value:"lightbulbs"},
					{label:"Users", value:"users"},
					{label:"Pencil", value:"pencil"},
					{label:"Ticks", value:"ticks"},
				],
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_id:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static matrixFormat(){
		const obj = {
			"settings":{
				title:"Yes question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				multi_select:false,
				columns:[
					{label:'Col 1'}
				],
				rows:[
					{label:'Row 1'}
				],
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static dateFormat(){
		const obj = {
			"settings":{
				title:"Yes question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				selected_format:0,//the index of formats
				selected_separator:0,
				formats:[
					{label:"MMDDYYYY", value:"0"},
					{label:"DDMMYYYY", value:"1"},
					{label:"YYYYMMDD", value:"2"}
				],
				separators:[
					{label:"/", value:"0"},
					{label:"-", value:"1"},
					{label:".", value:"2"}
				],
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static numberFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"OK",
				required:false,
				min_number:false,
				min_number_input:'0',//custom input
				max_number:false,
				max_number_input:'0',//custom input
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}

		return obj
	}

	static dropdownFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"OK",
				required:false,
				randomize:false,
				alpha_order:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static legalFormat(){
		const obj = {
			"settings":{
				title:"Yes question here. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static fileUploadFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				required:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static websiteFormat(){
		const obj = {
			"settings":{
				title:"Welcome. Recall information with@",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"OK",
				required:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}

	static birthdayFormat(){
		const obj = {
			"settings":{
				title:"@Select Your Birthday",
				title_link:null,
				description:null,
				show_button:true,
				button_text:"OK",
				required:false,
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":{},
			}
		}
		return obj
	}


	static endScreenFormat(){
		const obj = {
			"settings":{
				title:"Say bye! Recall information with @",
				title_link:null,
				description:null,
				show_button:true,//true or false
				button_text:"Again",
				is_button_link:false,
				button_link:null,
				social_icons:true,
				social_links_facebook:null,//string url value
				social_links_twitter:null,//string url value
				social_links_linkedin:null,//string url value
				social_links_youtube:null,//string url value
				social_links_instagram:null,//string url value
				social_links_tiktok:null,//string url value
				social_icons_facebook_color:"#000000",
				social_icons_twitter_color:"#000000",
				social_icons_linkedin_color:"#000000",
				social_icons_youtube_color:"#000000",
				social_icons_instagram_color:"#000000",
				social_icons_tiktok_color:"#000000",
				image_or_video_id:null,
				image_path:null,
				image_brightness:null,
				video_path:null,
				image_or_video_alt_text:null,
				layer_layout:this.defaultLayout,
				layer_customization:{
					image_or_video_width:null,//value should be numeric
					image_or_video_height:null, //value should be numeric
					image_or_video_aligns:["center", "left", "right", "bottom", "middle"],
					image_or_video_align:"left"
				}
			},
			"theme":{
				"type":ThemeHandler.themeTypes[1],//gallery default
				"theme":ThemeHandler.themesGallery[0]
			},
			"logics":{
				"branching":{
					"jump_to":null
				},
				"outcome":[],
			}
		}
		return obj
	}

}