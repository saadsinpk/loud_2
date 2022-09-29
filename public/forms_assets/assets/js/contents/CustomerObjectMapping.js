class CustomerObjectMapping{
  static questions = []

  static customerObjectFormat = {
    first_name:null,
    last_name:null,
    email:null,
    phone:null,
    password:null,
    address1:null,
    address2:null,
    city:null,
    state:null,
    zip:null,
    country:null
  }

  static showModal(e){
    e.preventDefault()
    if ($("#customerObjectMappingModal").length) {
      $("#customerObjectMappingModal").remove()
    }


    //get current questions
    this.questions = ContentsHandler.getSelectedContents()
    if (!this.questions.length) {
      return alert("Sorry you don't have any questions yet!")
    }

    const modal = `
      <div class="modal fade" id="customerObjectMappingModal" tabindex="-1" aria-labelledby="customerObjectMappingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
          <form class="modal-content" action="" method="POST" onsubmit="CustomerObjectMapping.save(event, this)">
            <div class="modal-header">
              <h5 class="modal-title" id="customerObjectMappingModalLabel">
                Customer Object Mapping
              </h5>
            </div>
            <div class="modal-body">
              
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div id="customerObjectMappingObjectBox"></div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    `
    $("body").append(modal)


    $("#customerObjectMappingModal").modal("show")
    this.initMapping()
  }

  static initMapping(){
    console.log("Object Mapping is Ready!")
    let objectHTML = `
      <table class='table'>
        <thead>
          <tr>
            <th>Object Key</th>
            <th>Select Question</th>
          </tr>
        </thead>
    `

    //make questions as options
    console.log(`Customer Object- Questions: `, this.questions)
    // const options = this.questions.map((item)=>{
    //   if (item.type !== 'welcomeScreen' && item.type !== 'endScreen') {
    //     return `<option value="${item.id}">${item.data.settings.title}</option>`
    //   }
    // })

    const currentObject = this.getSavedObject()

    for(let key in this.customerObjectFormat){
      if (this.customerObjectFormat.hasOwnProperty(key)) {
        const keyFormatted = this.formatKey(key)
        objectHTML += `<tr>
          <td>Customer ${keyFormatted}</td>
        `
        objectHTML += `
          <td>
            <select class="form-control" name="${key}">
              <option value="">Select</option>
              ${this.questions.map((item)=>{
                if (item.type !== 'welcomeScreen' && item.type !== 'endScreen') {
                  let selected_ = null
                  if (currentObject) {
                    for (let i=0; i<currentObject.length;i++) {
                      if (currentObject[i].name === key && currentObject[i].value === item.id) {
                          selected_ = "selected"
                      }
                    }
                  }
                  return `<option ${selected_?selected_:''} value="${item.id}">${item.data.settings.title}</option>`
                }
              })}
            </select>
          </td>
        </tr>`
      }
    }
    objectHTML += `</table>`

    const objectBox = document.getElementById("customerObjectMappingObjectBox")
    objectBox.innerHTML = objectHTML

  }

  static formatKey(str){
    const string = str.replace("_", " ")
    return string.charAt(0).toUpperCase() + string.slice(1)
  }

  static save(e, form){
    e.preventDefault()
    const data = $(form).serializeArray()
    // console.log(data)
    // console.log(typeof data)

    localStorage.setItem(customerObjectMappingStorageName, JSON.stringify(data))
    alert("Changes has been draft successfully")
    $(".modal").modal("hide")
    return
  }

  static getSavedObject(){
    return localStorage.getItem(customerObjectMappingStorageName) ? JSON.parse(localStorage.getItem(customerObjectMappingStorageName)) : null
  }
}