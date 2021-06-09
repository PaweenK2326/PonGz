function confirmation(){
    if(confirm('Are you sure?')){
        document.getElementById('delete-form').submit();
    }else{
        return false;
    }   
}

const slider = document.querySelector('.dragTable');
let isDown = false;
let startX;
let scrollLeft;
if (slider) {
  slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });
  slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
  });
  slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
  });
  slider.addEventListener('mousemove', (e) => {
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    slider.scrollLeft = scrollLeft - walk;
    console.log(walk);
  });
}


$(document).ready(function() {
  $('.dateThai').each(function() {
    var date = $(this).text();
    if (date) {
      var onlydate = date.split(' ');
      var eachdate = onlydate[0].split('-');
      var year = parseInt(eachdate[0])+543;
      var month = parseInt(eachdate[1]);
      var AllThaiMonth = ["", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
      var monthThai = AllThaiMonth[month];
      var day = eachdate[2];

      $(this).text( day + ' ' + monthThai + ' ' + year );
    } else {
      $(this).text('-');
    }

  })    
  $('.dateThaiChange').each(function() {
    var date = $(this).text();
    if (date) {
      var onlydate = date.split(' ');
      var eachdate = onlydate[0].split('-');
      var year = parseInt(eachdate[0]);
      var month = parseInt(eachdate[1]);
      var AllThaiMonth = ["", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
      var monthThai = AllThaiMonth[month];
      var day = eachdate[2];

      $(this).text( day + ' ' + monthThai + ' ' + year );
    } else {
      $(this).text('-');
    }

  })  
  $('.dateEng').each(function() {
    var date = $(this).text();
    if (date) {
      var onlydate = date.split(' ');
      var eachdate = onlydate[0].split('-');
      var year = parseInt(eachdate[0]);
      var month = parseInt(eachdate[1]);
      var AllEngMonth = ["", "Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov","Dec"];
      var monthEng = AllEngMonth[month];
      var day = eachdate[2];

      $(this).text( day + ' ' + monthEng + ' ' + year );
    } else {
      $(this).text('-');
    }

  })  
  $('.dateEngChange').each(function() {
    var date = $(this).text();
    if (date) {
      var onlydate = date.split(' ');
      var eachdate = onlydate[0].split('-');
      var year = parseInt(eachdate[0])-543;
      var month = parseInt(eachdate[1]);
      var AllEngMonth = ["", "Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov","Dec"];
      var monthEng = AllEngMonth[month];
      var day = eachdate[2];

      $(this).text( day + ' ' + monthEng + ' ' + year );
    } else {
      $(this).text('-');
    }

  })
})

function formatNumber(num) {
  if (num == null) {
    return '0';
  }
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

$(document).ready(function() {
  $('div.text_editor').find('a').css('color','cornflowerblue');
})

$(document).on('change','.image_add', function() {
  $(this).closest('.uploader').find('.filename').text($(this).val().replace(/C:\\fakepath\\/i, ''));
})

$(document).on('change','.pdf_input', function() {
  $(this).closest('.controls').find('.pdf_name').text($(this).val().replace(/C:\\fakepath\\/i, ''));
})

// condition->suneditor
$(document).ready(function() {
  if($('#condition_th').length > 0){
    const editor_condition_th = SUNEDITOR.create('condition_th',{
        height:'500px',
        width:'100%',
        videoWidth:'480px',
        placeholder:'รายละเอียด..',
        buttonList : [
            ['undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor'],
            ['removeFormat'],
            '/', // Line break
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video'],
            ['fullScreen', 'showBlocks', 'codeView']
        ],
    });

    const editor_condition_en = SUNEDITOR.create('condition_en',{
        height:'500px',
        width:'100%',
        videoWidth:'480px',
        placeholder:'Detail..',
        buttonList : [
            ['undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor'],
            ['removeFormat'],
            '/', // Line break
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video'],
            ['fullScreen', 'showBlocks', 'codeView']
        ],
    });

    $('#submit').click(function() {
        $('#condition_th').val(editor_condition_th.getContents());
        $('#condition_en').val(editor_condition_en.getContents());
    })
  }
})
// detail->suneditor
$(document).ready(function() {
  if($('#detail_th').length > 0){
    const editor_detail_th = SUNEDITOR.create('detail_th',{
        height:'500px',
        width:'100%',
        videoWidth:'480px',
        placeholder:'รายละเอียด..',
        buttonList : [
            ['undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor'],
            ['removeFormat'],
            '/', // Line break
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video'],
            ['fullScreen', 'showBlocks', 'codeView']
        ],
    });

    const editor_detail_en = SUNEDITOR.create('detail_en',{
        height:'500px',
        width:'100%',
        videoWidth:'480px',
        placeholder:'Detail..',
        buttonList : [
            ['undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor'],
            ['removeFormat'],
            '/', // Line break
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video'],
            ['fullScreen', 'showBlocks', 'codeView']
        ],
    });

    $('#submit2').click(function() {
        $('#detail_th').val(editor_detail_th.getContents());
        $('#detail_en').val(editor_detail_en.getContents());
    })
  }
})

// customize suneditor
$(document).ready(function() {
  setTimeout(function(){
    $('.sun-editor').find('.se-btn-group').find('.se-tooltip').each(function() {
      $(this).css('display','none');
      if ($(this).data('command') == 'update') {
        $(this).css('display','inline-block');
      }      
      if ($(this).data('command') == 'delete') {
        $(this).css('display','inline-block');
      }
    });
    $('.sun-editor').find('form.editor_video').find('label.size-h').each(function() {
      if ($(this).text() == '(Ratio)') {
        $(this).css('display','none');
      }
    })
    $('.sun-editor').find('form.editor_video').find('select.se-video-ratio').css('display','none');
    $('.sun-editor').find('form.editor_video').find('input.se-dialog-btn-radio').each(function() {
      var val = $(this).val();
      if (val == 'left') {
        $(this).closest('label').css('display','none');
      }      
      if (val == 'right') {
        $(this).closest('label').css('display','none');
      }
    })    
    $('.sun-editor').find('form.editor_image').find('input.se-dialog-btn-radio').each(function() {
      var val = $(this).val();
      if (val == 'left') {
        $(this).closest('label').css('display','none');
      }      
      if (val == 'right') {
        $(this).closest('label').css('display','none');
      }
    })
    var num = $('.peditor').length;
    if (num < 1) {
      
      $('.sun-editor').find('form.editor_video').find('.se-dialog-form-footer').prepend("<p class='peditor'>เพื่อการแสดงผลที่ถูกต้อง สำหรับ VDO จาก Youtube สัดส่วน 16:9<br>ขนาดที่แนะนำคือ Width: 480px, Height: 270px<br><strong>โดยใส่ตัวเลขในช่องแล้วตามด้วย px</strong></p><br>");
    }
  }, 1000);
  setInterval(function() {
    $('.sun-editor').find('form.editor_video').find('._se_video_size_y').attr('placeholder','270px');
    $('.sun-editor').find('form.editor_video').find('input.se-dialog-btn-radio').each(function() {
      var val = $(this).val();
      if (val == 'center') {
        $(this).prop('checked',true);
      }
    })    
    $('.sun-editor').find('form.editor_image').find('input.se-dialog-btn-radio').each(function() {
      var val = $(this).val();
      if (val == 'center') {
        $(this).prop('checked',true);
      }
    })
  },1000)
  setInterval(function() {
    $('.sun-editor').find('.se-btn-group').find('._se_rotation').each(function() {
      $(this).css('display','none');
    });
  },1000)
})
// user permissions
  // all checkbox
    $('#all').change(function() {
        if ($(this).closest('div.checker').find('span').hasClass('checked')) {
            $('input.checkbox_right').each(function() {
                $(this).closest('div.checker').find('span').addClass('checked');
                $(this).prop('checked',true);
            })
        } else {
            $('input.checkbox_right').each(function() {
                $(this).closest('div.checker').find('span').removeClass('checked');
                $(this).prop('checked',false);
            })
        }
    })
    $('.checkbox_right').change(function() {
        if ($('.checkbox_right').closest('span.checked').length == 28) {
            $('#all').closest('div.checker').find('span').addClass('checked');
            $('#all').prop('checked',true);
        } else {
            $('#all').closest('div.checker').find('span').removeClass('checked');
            $('#all').prop('checked',false);
        }
    })
    // user
    $('#userall').change(function() {
        if ($(this).closest('div.checker').find('span').hasClass('checked')) {
            $('input.user').each(function() {
                $(this).closest('div.checker').find('span').addClass('checked');
                $(this).prop('checked',true);
            })
        } else {
            $('input.user').each(function() {
                $(this).closest('div.checker').find('span').removeClass('checked');
                $(this).prop('checked',false);
            })
        }
    })  
    $('.user').change(function() {
        if ($('.user').closest('span.checked').length == 2) {
            $('#userall').closest('div.checker').find('span').addClass('checked');
            $('#userall').prop('checked',true);
        } else {
            $('#userall').closest('div.checker').find('span').removeClass('checked');
            $('#userall').prop('checked',false);
        }
    })
    // product
    $('#productall').change(function() {
        if ($(this).closest('div.checker').find('span').hasClass('checked')) {
            $('input.product').each(function() {
                $(this).closest('div.checker').find('span').addClass('checked');
                $(this).prop('checked',true);
            })
        } else {
            $('input.product').each(function() {
                $(this).closest('div.checker').find('span').removeClass('checked');
                $(this).prop('checked',false);
            })
        }
    })  
    $('.product').change(function() {
        if ($('.product').closest('span.checked').length == 7) {
            $('#productall').closest('div.checker').find('span').addClass('checked');
            $('#productall').prop('checked',true);
        } else {
            $('#productall').closest('div.checker').find('span').removeClass('checked');
            $('#productall').prop('checked',false);
        }
    })  
    // form
    $('#formall').change(function() {
        if ($(this).closest('div.checker').find('span').hasClass('checked')) {
            $('input.form').each(function() {
                $(this).closest('div.checker').find('span').addClass('checked');
                $(this).prop('checked',true);
            })
        } else {
            $('input.form').each(function() {
                $(this).closest('div.checker').find('span').removeClass('checked');
                $(this).prop('checked',false);
            })
        }
    })  
    $('.form').change(function() {
        if ($('.form').closest('span.checked').length == 3) {
            $('#formall').closest('div.checker').find('span').addClass('checked');
            $('#formall').prop('checked',true);
        } else {
            $('#formall').closest('div.checker').find('span').removeClass('checked');
            $('#formall').prop('checked',false);
        }
    })  
    // content
    $('#contentall').change(function() {
        if ($(this).closest('div.checker').find('span').hasClass('checked')) {
            $('input.content').each(function() {
                $(this).closest('div.checker').find('span').addClass('checked');
                $(this).prop('checked',true);
            })
        } else {
            $('input.content').each(function() {
                $(this).closest('div.checker').find('span').removeClass('checked');
                $(this).prop('checked',false);
            })
        }
    })  
    $('.content').change(function() {
        if ($('.content').closest('span.checked').length == 9) {
            $('#contentall').closest('div.checker').find('span').addClass('checked');
            $('#contentall').prop('checked',true);
        } else {
            $('#contentall').closest('div.checker').find('span').removeClass('checked');
            $('#contentall').prop('checked',false);
        }
    })

// product cart
  $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

// validate number input
function validateNumber(evt) {
    var e = evt || window.event;
    var key = e.keyCode || e.which;

    if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
    // numbers   
    key >= 48 && key <= 57 ||
    // Numeric keypad
    key >= 96 && key <= 105 ||
    // Backspace and Tab and Enter
    key == 8 || key == 9 || key == 13 ||
    // Home and End
    key == 35 || key == 36 ||
    // left and right arrows
    key == 37 || key == 39 ||
    // Del and Ins
    key == 46 || key == 45 || 
    // comma, period and minus, . on keypad, - onkeybord and space
    key == 190 || key == 188 || key == 109 || key == 110 || key == 189 || key == 32) {
        // input is VALID
    } else {
        // input is INVALID
        e.returnValue = false;
        if (e.preventDefault) e.preventDefault();
    }
}

$(document).ready(function() {
  $('#refresh_button').trigger('click');
})

$('.popup').click(function() {
  if ($(this).find('.popuptext').hasClass('show')) {
    $(this).find('.popuptext').removeClass('show');
  } else {
    $(this).find('.popuptext').addClass('show');
  }
})

$(document).click(function() {
  $('.popup').click(function() {
    return false;
  })
  $('.popuptext').removeClass('show');
})

$('.refresh').on('click', function() {
  if(confirm('Refresh table?')){
    $('#myTable').DataTable().state.clear();
    window.location.reload();
  } else {
    return false;
  }
})