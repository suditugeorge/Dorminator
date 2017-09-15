$ ->
  $('#start-sort').click (e) ->
    e.preventDefault()
    token = $('[name="_token"]').val()
    $.post '/start-sort', {_token: token}, (json) ->
      if !json.success
        toastr.error(json.message)
        return
      else
        toastr.success(json.message)
      return
    return

  $('#stop-dorminator').click (e) ->
    e.preventDefault()
    token = $('[name="_token"]').val()
    $.post '/stop-dorminator', {_token: token}, (json) ->
      if !json.success
        toastr.error(json.message)
        return
      else
        toastr.success(json.message)
      return
    return

  $('#start-dorminator').click (e) ->
    e.preventDefault()
    token = $('[name="_token"]').val()
    $.post '/start-dorminator', {_token: token}, (json) ->
      if !json.success
        toastr.error(json.message)
        return
      else
        toastr.success(json.message)
      return
    return

  $('#algorithm-preference').click (e) ->
    e.preventDefault()
    token = $('[name="_token"]').val()
    $.post '/algorithm/preference', {_token: token}, (json) ->
      if !json.success
        toastr.error(json.message)
        return
      else
        toastr.success(json.message)
      return
    return

  $('#algorithm-cascade').click (e) ->
    e.preventDefault()
    token = $('[name="_token"]').val()
    $.post '/algorithm/cascade', {_token: token}, (json) ->
      if !json.success
        toastr.error(json.message)
        return
      else
        toastr.success(json.message)
      return
    return
