class SettingsHandler{
	static settingsData = null

	static settingsDataFormat = {
		access_and_scheduling:{
			"close_new_response":false,
			"schedule_close_date":false,
			"scheduled_close_date":null,//a date time field
			"response_limit":false,
			"response_limit_input":null,//a number filed
			"custom_closed_message":false,
			"custom_closed_message_title":null,
			"custom_closed_message_description":null
		},
		notification:{
			"email_notification":false,
			"email_notification_setup":{
				//if email_notification true then
				to:authUserEmail,//by default current auth user email
				subject:`Typeform: New response for [type_form_name]`,
				message:null
			},
			"notify_respondents":false,
			"notify_respondents_setup":{
				//if notify_respondents true then
				to:`email`,//content type email should be
				from:authUserEmail,//by default current auth user email
				subject:`Typeform: Thank you for filling out [type_form_name]`,
				message:null
			}
		},
		messages:{
			//messages
			button_to_confirm_answer:"OK",
			keyboard_instruction:"Press Enter",
			hint_multiple_selection:"Choose as many as you like",
			instruction_dropdown_question:"Type or select an option",
			instruction_dropdown_question_on_touch:"Select an option",
			label_other:"Other",
			hint_adding_text:"Type your answer here",
			button_to_respond_yes:"Yes",
			button_to_respond_no:"No",
			keyboard_shortcut_for_yes:"Y",
			keyboard_shortcut_for_no:"N",
			button_text_accept_statement_legal:"I accept",
			button_text_reject_statement_legal:"I don't accept",
			button_text_revise_errors:"Review",
			button_send_form:"Submit",
			error_msg_answer_required:"Please fill this in",
			error_msg_answer_required_select:"OOPS! Please make a selection",
			error_msg_legal_statement_reject:"Please agree to the terms and conditions",
			error_msg_email_incorrect:"Email is invalid",
			error_msg_url_incorrect:"URL is invalid",
			error_msg_number_exceeds_min_max:"Submit",
			error_msg_number_too_low:"Submit",
			error_msg_number_too_high:"Submit",
			error_msg_respondents_suggestion_not_found:"No suggestions found",
			error_msg_phone_invalid:"Phone number is invalid",
			//loading_and_completion
			text_confirm_form_sent:"Done, your informations was sent",
			error_msg_no_server_connection:"Server connecting issue",
			error_msg_server_error:"Server error",
			error_msg_to_show_form:"We are facing  issue to loading form...",
			//others
			alert_msg_browser_not_support_form:"It looks your browser doesn't support our form",
			hint_long_text_break:"Press shift + enter key to make like break",
			//file_uploads
			upload_file_button_text:"Choose file",
			drag_file_hints:"Drag here",
			error_msg_exceed_file_size:"Your file is too big",
			msg_file_in_progress:"File is uploading please wait...",
		},
		form_branding:false,
		progress_bar:false,
		navigation_arrows:false,
		redirect_on_completion:false,
		redirect_on_completion_to_url:null,//url field
	}


	static renderSettingsHTML(){
		//set data
		this.settingsData = this.getSettingsData()
		console.log("settingsData")
		console.log(this.settingsData)

		let htmlContent = ""


		htmlContent += `
			<div class="container" style="padding: 5px 12px 40px 12px">
				<div class="row">
					<button onclick="SettingsHandler.accessScheduling()" type="button" class="btn  text-dark text-left">
						<div class="row">
							<div class="col-10">
								<p>Access and scheduling</p>
							</div>
							<div class="col-2 text-right">
								<i class="fas fa-chevron-right"></i>
							</div>
						</div>
					</button>
				</div>

				<div class="row">
					<button onclick="SettingsHandler.notifications()" type="button" class="btn text-dark text-left" >
						<div class="row">
							<div class="col-8">
								<p>Notification</p>
							</div>
							<div class="col-4 text-right">
								<i class="fas fa-chevron-right float-right"></i>
							</div>
						</div>
					</button>
				</div>	

				<div class="row">
					<button onclick="SettingsHandler.messages()" type="button" class="btn text-dark text-left">
						<div class="row">
							<div class="col-8">
								<p>Messages</p>
							</div>
							<div class="col-lg-4 text-right">
								<i class="fas fa-chevron-right"></i>
							</div>
						</div>
					</button>
				</div>

				<div class="row pt-5">
					<div class="col-8">
						<p class="pt-2">Typeform branding</p>
					</div>
					<div class="col-4">
						<label class="switch justify-content-end">
							<input type="checkbox" ${this.settingsData.form_branding?`checked`:``}
							onchange="SettingsHandler.saveSettingsMenuItem('form_branding', this)">
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="row pt-5">
					<div class="col-8">
						<p class="pt-2">Progress bar</p>
					</div>
					<div class="col-4">
						<label class="switch justify-content-end">
							<input type="checkbox" ${this.settingsData.progress_bar?`checked`:``} 
							onchange="SettingsHandler.saveSettingsMenuItem('progress_bar', this)">
							<span class="slider round"></span>
						</label>
					</div>
				</div>
				<div class="row pt-5">
					<div class="col-8">
						<p class="pt-2">Navigation arrows</p>
					</div>
					<div class="col-4">
						<label class="switch justify-content-end">
							<input type="checkbox" ${this.settingsData.navigation_arrows?`checked`:``} 
							onchange="SettingsHandler.saveSettingsMenuItem('navigation_arrows', this)">
							<span class="slider round"></span>
						</label>
					</div>
				</div>

				<div class="row pt-5">
					<div class="col-8">
						<p class="pt-2">Redirect on completion</p>
					</div>
					<div class="col-4">
						<label class="switch justify-content-end">
							<input type="checkbox" ${this.settingsData.redirect_on_completion?`checked`:``} 
							onchange="SettingsHandler.saveSettingsMenuItem('redirect_on_completion', this)">
							<span class="slider round"></span>
						</label>
					</div>
					${this.settingsData.redirect_on_completion?
						`<div class="col-12">
							<label>
								Redirect URL
							</label>
							<div>
								<input type="url" class="form-control" value="${this.settingsData.redirect_on_completion_to_url?this.settingsData.redirect_on_completion_to_url:``}" 
								onchange="SettingsHandler.saveSettingsMenuItem('redirect_on_completion_to_url', this)" placeholder="Enter URL">
							</div>
						</div>`:``
					}
				</div>

			</div>
		`

		renderRightSidebarContent('setting', htmlContent)
	}

	//modal of accessing and scheduling
	static accessScheduling(isModalOpen=false){
		if (!isModalOpen) {
			$("body #settings_accessAndSchedulingModal").remove()
		}
		

		let htmlContent = ""
		let formHTML = ""
		formHTML += `
			<div class="container">
				<div class="row pt-5">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="row blue_row pt-4 mb-4">
							<div class="col-1">
								<i class="fas fa-lock-open"></i>
							</div>
							<div class="col-11">
								<p>Your typeform will be open to new responses.</p>
							</div>

						</div>

						<div
							class="row pt-5 row_shaddo">
							<div class="col-8">
								<p class="pt-2 font-weight-bold">Close typeform to new responses</p>
							</div>
							<div class="col-4">
								<label class="switch justify-content-end">
									<input type="checkbox" ${this.settingsData.access_and_scheduling.close_new_response?`checked`:``} 
									onchange="SettingsHandler.saveSettingChangesAccess('close_new_response', this)">
									<span class="slider round"></span>
								</label>
							</div>
						</div>
						<div
							class="row pt-5 row_shaddo">
							<div class="col-8">
								<p class="pt-2 font-weight-bold">Schedule a close date</p>
							</div>
							<div class="col-4 d-flex justify-content-end">
								<label class="switch justify-content-end">
									<input type="checkbox" ${this.settingsData.access_and_scheduling.schedule_close_date?`checked`:``}
									onchange="SettingsHandler.saveSettingChangesAccess('schedule_close_date', this)">
									<span
										class="slider round"></span>
								</label>
								<div class="form-group">
									${this.settingsData.access_and_scheduling.schedule_close_date?
										`<input type="datetime-local" value="${this.settingsData.access_and_scheduling.scheduled_close_date?this.settingsData.access_and_scheduling.scheduled_close_date:``}" class='form-control'
										onchange="SettingsHandler.saveSettingChangesAccess('scheduled_close_date', this)">`:``
									}
								</div>
							</div>
						</div>
						<div
							class="row pt-5 row_shaddo">
							<div class="col-8">
								<p class="pt-2 font-weight-bold">Set a response limit</p>
							</div>
							<div class="col-4 d-flex justify-content-end">
								<label
									class="switch justify-content-end">
									<input type="checkbox" ${this.settingsData.access_and_scheduling.response_limit?`checked`:``}
									onchange="SettingsHandler.saveSettingChangesAccess('response_limit', this)">
									<span class="slider round"></span>
								</label>
								<div>
									${this.settingsData.access_and_scheduling.response_limit?
										`<input type="number" value="${this.settingsData.access_and_scheduling.response_limit_input?this.settingsData.access_and_scheduling.response_limit_input:``}" class="form-control" style="min-width:150px"
										onchange="SettingsHandler.saveSettingChangesAccess('response_limit_input', this)">`:``
									}
								</div>
							</div>
						</div>

						<div class="row pt-5 row_shaddo">
							<div class="col-8">
								<p class="pt-2 font-weight-bold">Show custom closed message</p>
							</div>
							<div class="col-4">
								<label class="switch justify-content-end">
									<input type="checkbox" ${this.settingsData.access_and_scheduling.custom_closed_message?`checked`:``}
									onchange="SettingsHandler.saveSettingChangesAccess('custom_closed_message', this)">
									<span class="slider round"></span>
								</label>
							</div>
							${this.settingsData.access_and_scheduling.custom_closed_message?`
								<div class="col-12">
									<div class="mb-3">
										<label>Custom closed message title</label>
										<input type="text" class="form-control"
										value="${this.settingsData.access_and_scheduling.custom_closed_message_title?this.settingsData.access_and_scheduling.custom_closed_message_title:``}"
										onchange="SettingsHandler.saveSettingChangesAccess('custom_closed_message_title', this)">
									</div>
									<div class='pb-3'>
										<label>Custom closed message description</label>
										<input type="text" class="form-control"
										value="${this.settingsData.access_and_scheduling.custom_closed_message_description?this.settingsData.access_and_scheduling.custom_closed_message_description:``}"
										onchange="SettingsHandler.saveSettingChangesAccess('custom_closed_message_description', this)">
									</div>
								</div>
								`:``
							}
						</div>

					</div>
				</div>
			</div>
		`
		if (isModalOpen) {
			$("#settings_accessAndSchedulingModal .modal-body").html(formHTML)
			return
		}

		//build modal
		htmlContent +=`
			<div class="modal fade" tabindex="-1"
				id="settings_accessAndSchedulingModal"
				role="dialog" aria-labelledby="accessAndSchedulingModalLabel"
				aria-hidden="true">

				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">

							<div class="col-9">
								<h5 class="modal-title text-left" id="accessAndSchedulingModalLabel">Access And Scheduling</h5>
							</div>

							<div class="col-3">
								<p class="text-right">Help?</p>
							</div>

							<button type="button" class="close" onclick="SettingsHandler.hideModal()">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							${formHTML}
						</div>

						<div class="modal-footer">
							<div class="container text-right">
								<button type="button" class="btn btn-secondary" onclick="SettingsHandler.hideModal()" >Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		`
		

		$("body").append(htmlContent)
		$("body #settings_accessAndSchedulingModal").modal('show')

	}

	//modal of notifications
	static notifications(isModalOpen=false){
		if (!isModalOpen) {
			$("body #settings_notificationModal").remove()
		}
		

		let htmlContent = ""
		let notifyMicrosoftConfigHTML = ""
		let notifyEmailNotifyHTML = ""
		let notifyRespondentsHTML = ""

		notifyMicrosoftConfigHTML += `
			<div class="row pt-5">
				<div class="col-1 pt-3">
					<i class="fab fa-microsoft"></i>
				</div>
				<div class="col-9">
					<h4>Microsoft Teams </h4>
					<p>Send a message in Microsoft Teams channels when your typeform is answered.</p>
				</div>
				<div class="col-2 pt-3">
					<button type="button" class="btn btn-secondary"> Configure</button>
				</div>
			</div>
			<div class="row pt-5 mb-5">
				<a href="#"><i class="fas fa-redo-alt"></i> &nbsp; &nbsp; &nbsp; More Apps & Integrations</a>
			</div>
		`


		notifyEmailNotifyHTML += `
			<div class="row pt-5 row_shaddo">
				<div class="col-8">
					<h5>Email Notification</h5>
					<p class="pt-2">Get a custom email when someone completes your teleform</p>
				</div>
				<div class="col-4">
					<label class="switch justify-content-end">
						<input onchange="SettingsHandler.saveNotification('email_notification', this)" type="checkbox" ${this.settingsData.notification.email_notification?`checked`:``}>
						<span class="slider round"></span>
					</label>
				</div>
			</div>

			${
				this.settingsData.notification.email_notification?
				`
					<div class="row pt-5">
						<div class="col-12">
							<div class="form-group">
								<label>Send notifications to</label>
								<input type="text" placeholder="List of emails (comma separated)" class="form-control" 
									value="${this.settingsData.notification.email_notification_setup.to?this.settingsData.notification.email_notification_setup.to:``}"
									onchange="SettingsHandler.saveNotification('to', this)"
									data_parent_property="email_notification_setup">
								<small>Notice: List of emails (comma separated)</small>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Subject</label>
								<input type="text" placeholder="Subject" class="form-control"
								value="${this.settingsData.notification.email_notification_setup.subject?this.settingsData.notification.email_notification_setup.subject:``}"
								onchange="SettingsHandler.saveNotification('subject', this)"
								data_parent_property="email_notification_setup">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Message</label>
								<textarea class="form-control" cols="12" rows="5" placeholder="Message"
								onchange="SettingsHandler.saveNotification('message', this)"
								data_parent_property="email_notification_setup">${this.settingsData.notification.email_notification_setup.message?this.settingsData.notification.email_notification_setup.message:``}</textarea>
							</div>
						</div>
					</div>
				`:``
			}
		`

		//check selected contents has email type
		const selectedContents = ContentsHandler.getSelectedContents()
		let hasEmailTypeContent = false
		selectedContents.map((item)=>{
			if (item.type === "email") {
				hasEmailTypeContent = true
			}
		})

		notifyRespondentsHTML += `
			${!hasEmailTypeContent?
				`<p class="mt-5">To send someone an email the moment they complete your typeform, you need to add an Email question</p>`:
				`<div class="col-12 mt-5 d-flex justify-content-between">
					<span><b>Send a custom email to respondents</b></span>
					<label class="switch justify-content-end">
						<input type="checkbox" ${this.settingsData.notification.notify_respondents?`checked`:``}
						onchange="SettingsHandler.saveNotification('notify_respondents', this)">
						<span class="slider round"></span>
					</label>
				</div>
				${
				this.settingsData.notification.notify_respondents?
						`<div class="row pt-5">
								<div class="col-12">
									<div class="form-group">
										<label>Send notifications to</label>
										<div class='form-control d-flex justify-content-start align-items-center'
										style="background-color:#d65c99"><i class='far fa-envelope text-dark'></i> <span class='ml-2 text-white'>${this.settingsData.notification.notify_respondents_setup.to?this.settingsData.notification.notify_respondents_setup.to:``}</span></div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>From</label>
										<input type="text" placeholder="Subject" class="form-control"
										value="${this.settingsData.notification.notify_respondents_setup.from?this.settingsData.notification.notify_respondents_setup.from:``}"
										onchange="SettingsHandler.saveNotification('from', this)"
										data_parent_property="notify_respondents_setup">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Subject</label>
										<input type="text" placeholder="Subject" class="form-control"
										value="${this.settingsData.notification.notify_respondents_setup.subject?this.settingsData.notification.notify_respondents_setup.subject:``}"
										onchange="SettingsHandler.saveNotification('subject', this)"
										data_parent_property="notify_respondents_setup">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Message</label>
										<textarea class="form-control" cols="12" rows="5" placeholder="Message"
										onchange="SettingsHandler.saveNotification('message', this)"
										data_parent_property="notify_respondents_setup">${this.settingsData.notification.notify_respondents_setup.message?this.settingsData.notification.notify_respondents_setup.message:``}</textarea>
									</div>
								</div>
						 </div>
						`:``
					}
				`
			}
		`


		if (isModalOpen) {
			$("#settings_notificationModal #myTabContent #homecc div").html(notifyEmailNotifyHTML)
			$("#settings_notificationModal #myTabContent #profilecc").html(notifyRespondentsHTML)
			return
		}

		htmlContent +=`
			<div class="modal fade" tabindex="-1"
				id="settings_notificationModal"
				role="dialog" aria-labelledby="settings_notificationModalLabel"
				aria-hidden="true">

				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title text-center" id="settings_notificationModalLabel">Notification</h5>
							<button type="button" class="close"
								onclick="SettingsHandler.hideModal()">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container">
								<ul class="nav nav-tabs" id="myTabcc" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" id="home-tabcc" data-toggle="tab" href="#homecc" role="tab" aria-controls="homecc" aria-selected="true">NOTIFY ME</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="profile-tabcc" data-toggle="tab" href="#profilecc" role="tab" aria-controls="profilecc" aria-selected="false">NOTIFY RESPONDENTS</a>
									</li>
								</ul>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="homecc" role="tabpanel" aria-labelledby="home-tabcc">
										<div class="container mt-5">
											${notifyEmailNotifyHTML}
										</div>
									</div>
									<div class="tab-pane fade" id="profilecc" role="tabpanel" aria-labelledby="profile-tabcc">
										${notifyRespondentsHTML}
									</div>
									
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<div class="container text-right">
								<button type="button" class="btn btn-secondary" onclick="SettingsHandler.hideModal()" >Cancel</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		`

		$("body").append(htmlContent)
		$("body #settings_notificationModal").modal('show')

	}

	//modal of messages
	static messages(){
		$("body #settings_messagesModal").remove()

		let htmlContent = ""
		htmlContent += `
			<div class="modal fade" tabindex="-1"
				id="settings_messagesModal"
				role="dialog" aria-labelledby="settings_messagesModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title text-center" id="settings_messagesModalLabel">Messages</h5>
							<button type="button" class="close" onclick="SettingsHandler.hideModal()">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body modald_body">
							<div class="container">
								<div class="row pt-5 ">
									<div class="col-9">
										<h4> Buttons, hints, and shortcuts</h4>
									</div>
									<div class="col-3 text-right">
										<div style='text-decoration:underline;cursor:pointer;display:none;display:none'>Reset All</div>
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to confirm answer</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="OK"
										value="${this.settingsData.messages.button_to_confirm_answer}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_to_confirm_answer', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Keyboard instruction to go to next question</p>

									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="press Enter ↵"
										value="${this.settingsData.messages.keyboard_instruction}"
										onchange="SettingsHandler.saveSettingChangesMessages('keyboard_instruction', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Hint for multiple selection</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Choose as many as you like"
										value="${this.settingsData.messages.hint_multiple_selection}"
										onchange="SettingsHandler.saveSettingChangesMessages('hint_multiple_selection', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Instruction for Dropdown question</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Type or select an option"
										value="${this.settingsData.messages.instruction_dropdown_question}"
										onchange="SettingsHandler.saveSettingChangesMessages('instruction_dropdown_question', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Instruction for Dropdown question on touch screens</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Select an option"
										value="${this.settingsData.messages.instruction_dropdown_question_on_touch}"
										onchange="SettingsHandler.saveSettingChangesMessages('instruction_dropdown_question_on_touch', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Label for “Other” answer option</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Other"
										value="${this.settingsData.messages.label_other}"
										onchange="SettingsHandler.saveSettingChangesMessages('label_other', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Hint for adding text</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Type your answer here..."
										value="${this.settingsData.messages.hint_adding_text}"
										onchange="SettingsHandler.saveSettingChangesMessages('hint_adding_text', this.value)">
									</div>
								</div>

								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to respond “Yes”</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Yes"
										value="${this.settingsData.messages.button_to_respond_yes}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_to_respond_yes', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to respond “No”</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="No"
										value="${this.settingsData.messages.button_to_respond_no}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_to_respond_no', this.value)">

									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Keyboard shortcut for "Yes" option</p>

									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Y"
										value="${this.settingsData.messages.keyboard_shortcut_for_yes}"
										onchange="SettingsHandler.saveSettingChangesMessages('keyboard_shortcut_for_yes', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Keyboard shortcut for "No" option</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="N"
										value="${this.settingsData.messages.keyboard_shortcut_for_no}"
										onchange="SettingsHandler.saveSettingChangesMessages('keyboard_shortcut_for_no', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to accept statement in a Legal question</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="I accept"
										value="${this.settingsData.messages.button_text_accept_statement_legal}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_text_accept_statement_legal', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to reject statement in a Legal question</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="I don’t accept"
										value="${this.settingsData.messages.button_text_reject_statement_legal}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_text_reject_statement_legal', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to revise errors when respondent submits</p>

									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Review"
										value="${this.settingsData.messages.button_text_revise_errors}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_text_revise_errors', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button to send typeform</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Submit"
										value="${this.settingsData.messages.button_send_form}"
										onchange="SettingsHandler.saveSettingChangesMessages('button_send_form', this.value)">
									</div>
								</div>
								<div class="row pt-5">
									<div class="col-10">
										<h5>Error Message</h5>
									</div>
									<div class="col-2 text-right">
										<div style='text-decoration:underline;cursor:pointer;display:none'>Reset All</div>
									</div>
								</div>

								<div class="row pt-5 ">
									<div class="col-4">
										<p>If an answer is required</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Please fill this in"
										value="${this.settingsData.messages.error_msg_answer_required}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_answer_required', this.value)">

									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If an answer requires a selection</p>

									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Oops! Please make a selection"
										value="${this.settingsData.messages.error_msg_answer_required_select}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_answer_required_select', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If a legal statement is rejected</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Please agree to the terms & conditions"
										value="${this.settingsData.messages.error_msg_legal_statement_reject}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_legal_statement_reject', this.value)">

									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If an email address is incorrect</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Hmm… that email doesn't look valid"
										value="${this.settingsData.messages.error_msg_email_incorrect}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_email_incorrect', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If a URL is incorrect</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Hmm… that web address doesn’t look right. Check for any typos or errors."
										value="${this.settingsData.messages.error_msg_url_incorrect}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_url_incorrect', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If number exceed set min and max limits</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Submit"
										value="${this.settingsData.messages.error_msg_number_exceeds_min_max}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_number_exceeds_min_max', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If the number entered is too low</p>

									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Submit"
										value="${this.settingsData.messages.error_msg_number_too_low}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_number_too_low', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If the number entered is too high</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Submit"
										value="${this.settingsData.messages.error_msg_number_too_high}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_number_too_high', this.value)">
									</div>
								</div>
			
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If respondent’s suggestion isn’t found in Dropdown</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="No suggestions found"
										value="${this.settingsData.messages.error_msg_respondents_suggestion_not_found}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_respondents_suggestion_not_found', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>If a phone number is not valid</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Hmm... that phone number isn't valid"
										value="${this.settingsData.messages.error_msg_phone_invalid}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_phone_invalid', this.value)">
									</div>
								</div>


								<div class="row pt-5">
									<div class="col-10">
										<h5>Loading & completing a typeform</h5>
									</div>
									<div class="col-2 text-right">
										<div style='text-decoration:underline;cursor:pointer;display:none'>Reset All</div>
									</div>
								</div>

								<div class="row pt-5 ">
									<div class="col-4">
										<p>Confirmation that typeform was sent</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Done! Your information was sent perfectly."
										value="${this.settingsData.messages.text_confirm_form_sent}"
										onchange="SettingsHandler.saveSettingChangesMessages('text_confirm_form_sent', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Error if there’s no connection with the server</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Oh no, you can’t connect to the server right now"
										value="${this.settingsData.messages.error_msg_no_server_connection}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_no_server_connection', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Error if there’s a problem with the server</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Server error! Your request wasn't completed"
										value="${this.settingsData.messages.error_msg_server_error}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_server_error', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Error if there’s a problem showing a typeform</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="The typeform , is currently unavailable. Please try again in a few moments."
										value="${this.settingsData.messages.error_msg_to_show_form}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_to_show_form', this.value)">
									</div>
								</div>
								<div class="row pt-5">
									<div class="col-10">
										<h5>Other</h5>
									</div>
									<div class="col-2 text-right">
										<div style='text-decoration:underline;cursor:pointer;display:none'>Reset All</div>
									</div>
								</div>



								<div class="row pt-5">
									<div class="col-4">
										<p>Alert if device/browser isn’t supported by Typeform</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="You're viewing this typeform in simple mode. This is because your device is not yet supported by Typeform."
										value="${this.settingsData.messages.alert_msg_browser_not_support_form}"
										onchange="SettingsHandler.saveSettingChangesMessages('alert_msg_browser_not_support_form', this.value)">
									</div>
								</div>
								<div class="row pt-5">
									<div class="col-4">
										<p>Hint for making a line break in Long text questions</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Shift ⇧ + Enter ↵ to make a line break"
										value="${this.settingsData.messages.hint_long_text_break}"
										onchange="SettingsHandler.saveSettingChangesMessages('hint_long_text_break', this.value)">
									</div>
								</div>



								<div class="row pt-5">
									<div class="col-10">
										<h5>File upload</h5>
									</div>
									<div class="col-2 text-right">
										<div style='text-decoration:underline;cursor:pointer;display:none'>Reset All</div>
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Button that asks respondent to upload a file</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Choose file"
										value="${this.settingsData.messages.upload_file_button_text}"
										onchange="SettingsHandler.saveSettingChangesMessages('upload_file_button_text', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Hint telling respondent where to drop file</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="or drag here"
										value="${this.settingsData.messages.drag_file_hints}"
										onchange="SettingsHandler.saveSettingChangesMessages('drag_file_hints', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Error when respondent uploads a file that exceeds the size limit</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Your file is too big"
										value="${this.settingsData.messages.error_msg_exceed_file_size}"
										onchange="SettingsHandler.saveSettingChangesMessages('error_msg_exceed_file_size', this.value)">
									</div>
								</div>
								<div class="row pt-5 ">
									<div class="col-4">
										<p>Message telling respondent that file is still uploading</p>
									</div>
									<div class="col-8 text-right">
										<input class="form-control" type="text" placeholder="Your file is still uploading, please wait..."
										value="${this.settingsData.messages.msg_file_in_progress}"
										onchange="SettingsHandler.saveSettingChangesMessages('msg_file_in_progress', this.value)">
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<div class="container text-right">
								<button type="button" class="btn btn-secondary" onclick="SettingsHandler.hideModal()">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		`
		$("body").append(htmlContent)
		$("body #settings_messagesModal").modal('show')
	}


	static getSettingsData(){
		//check if settings is not saved then save the format and return
		const data = localStorage.getItem(settingsDataStorageName);
		if (data == null || data == '') {
			//set sample format data
			console.log(`getSettingsData Method Called: Settings Data null, so setting the init format: `, data)
			localStorage.setItem(settingsDataStorageName, JSON.stringify(this.settingsDataFormat));
		}

		const settingsData = localStorage.getItem(settingsDataStorageName) != null ? JSON.parse(localStorage.getItem(settingsDataStorageName)) : null;
		console.log(`getSettingsData Method Called: Settings Data `, settingsData)
		return settingsData
	}

	//save access and scheduling
	static saveSettingChangesAccess(propertyName, a){
		const stringFields = [
			"scheduled_close_date",
			"response_limit_input",
			"custom_closed_message_title", 
			"custom_closed_message_description"
		]

		if (propertyName == '') {
			alert('The field name is required')
			return
		}

		let settingData = this.getSettingsData()
		if (!settingData.access_and_scheduling.hasOwnProperty(propertyName)) {
			alert(`The field ${propertyName} is invalid`)
			return
		}

		if (stringFields.includes(propertyName)) {
			if ($(a).val() == '') {
				alert(`The ${propertyName} field value is required`)
				return
			}
			//save data
			settingData.access_and_scheduling[propertyName] = $(a).val()
			this.save(settingData)
			this.accessScheduling(true)//render html again
			return
		}

		//checkboxes
		if ($(a).prop('checked') === true) {
			settingData.access_and_scheduling[propertyName] = true
		}else{
			settingData.access_and_scheduling[propertyName] = false
		}

		this.save(settingData)
		this.accessScheduling(true)//render html again
	}

	//save notification
	static saveNotification(propertyName, a){
		const root_properties = ["email_notification", "notify_respondents"]
		if (propertyName == '') {
			alert('The field name is required')
			return
		}

		const parentProperty = $(a).attr("data_parent_property")

		let settingData = this.getSettingsData()
		if (root_properties.includes(propertyName)) {
			if (!settingData.notification.hasOwnProperty(propertyName)) {
				alert(`The field ${propertyName} is invalid`)
				return
			}

			//save parent data
			settingData.notification[propertyName] = ($(a).prop("checked") === true ? true:false)
			this.save(settingData)
			this.notifications(true)
			return

		}

		//else sub property
		if (parentProperty == '') {
			alert('The parent data is missing, please refresh the page and try agian')
			return
		}
		if (!settingData.notification.hasOwnProperty(parentProperty)) {
			alert(`The target parent field ${propertyName} is invalid`)
			return
		}
		if (!settingData.notification[parentProperty].hasOwnProperty(propertyName)) {
			alert(`The field ${propertyName} is invalid`)
			return
		}
		
		if ($(a).val() == '') {
			alert(`The field ${propertyName} is required`)
			return
		}
		settingData.notification[parentProperty][propertyName] = $(a).val()
		this.save(settingData)
		this.notifications(true)

	}


	//save menu item changes
	static saveSettingsMenuItem(propertyName, a){
		const stringFields = ["redirect_on_completion_to_url"]

		if (propertyName == '') {
			alert('The field name is required')
			return
		}

		let settingData = this.getSettingsData()
		if (!settingData.hasOwnProperty(propertyName)) {
			alert(`The field ${propertyName} is invalid`)
			return
		}

		if (stringFields.includes(propertyName)) {
			if ($(a).val() == '') {
				alert(`The ${propertyName} field value is required`)
				return
			}
			if (!Helpers.isValidURL($(a).val())) {
				alert(`The redirect url should be valid URL`)
				return
			}

			//save data
			settingData[propertyName] = $(a).val()
			this.save(settingData)
			this.renderSettingsHTML()
			return
		}

		//checkboxes
		if ($(a).prop('checked') === true) {
			settingData[propertyName] = true
		}else{
			settingData[propertyName] = false
		}

		this.save(settingData)
		this.renderSettingsHTML()
	}


	//save setting messages
	static saveSettingChangesMessages(propertyName, value){
		//save on changes data to local storage
		if (propertyName == '') {
			alert("The field name is requried")
			return
		}

		if (value == '') {
			alert("The field value is requried")
			return
		}

		let settingData = this.getSettingsData()
		if (!settingData.messages.hasOwnProperty(propertyName)) {
			alert(`The field ${propertyName} is invalid`)
			return
		}
		settingData.messages[propertyName] = value
		this.save(settingData)
	}

	
	static save(data){
		localStorage.setItem(settingsDataStorageName, JSON.stringify(data));
		//set new data
		this.settingsData = this.getSettingsData()
		//toast alert
		Helpers.changesSavedAlert()
	}


	static hideModal(){
		$(".modal").modal("hide")
	}
}