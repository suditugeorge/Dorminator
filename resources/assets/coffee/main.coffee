$ ->
  $('#start-sort').click (e) ->
    e.preventDefault()
    console.log 'cacat'
    token = $('[name="_token"]').val()
    $.post '/start-sort', {_token: token}, (json) ->
      if !json.success
        toastr.error(json.message)
        return
      else
        toastr.success(json.message)
      return
    return
