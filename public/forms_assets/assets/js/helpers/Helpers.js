class Helpers{
    static genUniqID(){
        let time = new Date();
        let stringID = "id_" + Math.random().toString(16).slice(2);
        return `${stringID+time.getDate()+time.getDay()+time.getFullYear()+time.getHours()+time.getMinutes()+time.getSeconds()+time.getMilliseconds()}`;
    }

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


    static changesSavedAlert(msg="Changes has been draft"){
        const toaster = document.getElementById("header--toast-toaster")
        const toasterBody = $("#header--toast-toaster .toast-body").html(msg)
        
        toaster.style.display = "block"
        setTimeout(function(){
            toaster.style.display = "none"
        }, 2000)
    }

    //common image brightness controller
    static changeImageBrightness(value){
    	//update live value to input and image
    	console.log(`image brightness arg val ${value}`)
    	const brightness_value = (value/100).toFixed(2);

		$('#whatMain .upload-image-preview img').css('filter','brightness('+brightness_value+')');	
    	
		//save value to localstorage
    	let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				item.data.settings.image_brightness = brightness_value;//set default bright 50
			}
		})
		ContentSettingsHandler.saveSettingChanges(selectedContents)
		//console.log($('#image_brightness_controller_block span.brightness_value_show'))
		$('#image_brightness_controller_block span.brightness_value_show').html(value);	
        Helpers.changesSavedAlert()
    }


    //common image/video alt text controller
    static saveAltText(value){
    	console.log('Saving alt text...')
    	if (value == '') {
    		value = null
    	}
    	
    	let selectedContents = ContentsHandler.getSelectedContents()
		selectedContents.map((item, index)=>{
			if (item.isActive) {
				item.data.settings.image_or_video_alt_text = value;
			}
		})
		ContentSettingsHandler.saveSettingChanges(selectedContents)
        Helpers.changesSavedAlert()
    }
}