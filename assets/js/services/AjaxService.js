App.service("AjaxService", ['$http','$httpParamSerializerJQLike',function ($http,$httpParamSerializerJQLike) {

    var ajax = this
    ajax.post = post            // donne l'acces à post()
    ajax.get = get              // donne l'acces à get()
    ajax._request = _request    // donne l'acces à _request()

    function get(url){
        return ajax._request('GET',url,{})
    }

    function post(url,data){

      console.log('post : ', data)
      if (data === 'undefined') {
        data = {}
      }
      return ajax._request('POST',url,data)

    }

    function _request(method,url,data) {

        var headers = {} ;
        headers['X-Requested-With'] = 'XMLHttpRequest';
        headers['Content-Type'] = 'application/x-www-form-urlencoded';

        let promise = $http({
                method    :     method,
                url       :     url,
                data      :     $.param({json: JSON.stringify(data)}),
                headers   :     headers,
                cache     :     false
        })
        return promise.then(
          function (response) {
            //Succes
            if (method == "GET"){
              switch (url) {

                case "assets/json/categories.json":

                  localStorage.setItem('categories',JSON.stringify(response.data))

                  break

                case "assets/json/models.json":

                  localStorage.setItem('models',JSON.stringify(response.data))

                  break

                case "assets/json/fonctions.json":

                  localStorage.setItem('fonctions',JSON.stringify(response.data))

                  break

                case "assets/json/champs.json":

                  localStorage.setItem('champs',JSON.stringify(response.data))

                  break

                default:
                break
              }
            }else {
              // POST
              console.log('response : ', response.data)
            }
            return response
        },
          function (reason) {
            //error
            console.log(reason)
        })

    }


}])
