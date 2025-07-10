
createOpenModel = (modelname) => {
    const model =document.getElementById(modelname);
    model.style.display = 'block';
    model.style.animation = 'popUp 0.3s ease';
    model.style.transform = 'translateY(-50px)';
    model.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
    model.style.background = 'rgba(51, 51, 51, 0.3)';
    model.style.opacity = '1';
    setTimeout(() => {
        model.style.transform = 'translateY(0)';
    }, 10);

}

/**
 * Closes the modal dialog by setting its display style to 'none'.
 */
createCloseModel = (modelname) => {
    const model =document.getElementById(modelname);
    model.style.animation = 'popDown 0.3s ease forwards';
    model.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
    model.style.transform = 'translateY(-50px)';
    model.style.opacity = '0';
    setTimeout(() => {
        model.style.display = 'none';
    }, 300);
    
}

function getRoomData() {
    fetch('actions/php/get_room.php')
        .then(response => response.json())
        .then(data => {
            const roomContainer = document.getElementById('roomContainer');
            roomContainer.innerHTML = ''; // Clear previous content
            data.forEach(async room => {
                const type = room.type;
                  let boxClass = 'roombox';
                  let iconClass = '';
                  let tag = 'p';
                  
                  switch (type) {
                      case '1':
                          boxClass += ' roomboxsuperior';
                          iconClass = 'fa fa-bed-front fa-4x mb-2 ';
                          break;
                      case '2':
                          boxClass += ' roomboxdelux';
                          iconClass = 'fa fa-bed-front fa-4x mb-2';
                          break;
                      case '3':
                          boxClass += ' roomboguest';
                          iconClass = 'fa fa-bed-front fa-4x mb-2';
                          break;
                      case '4':
                          boxClass += ' roomboxsingle';
                          iconClass = 'fa fa-bed fa-4x mb-2';
                          break;
                      default:
                          return; // Skip unknown types
                  }
                
                  
                
                const roomBox = document.createElement('div');
                roomBox.className = boxClass;
                roomBox.style.position = 'relative';
                roomBox.style.backgroundColor = room.status == 1 ? '#FFFFFF' : '#DDDDDD';
                roomBox.style.border = room.status == 1 ? '1px solid #34C759' : '1px solid #ccc';
                roomBox.addEventListener('mouseover', function() {
                    roomBox.style.transform = 'scale(1.05)';
                    roomBox.style.cursor = 'pointer';
                });
                roomBox.addEventListener('mouseleave', function(){
                    roomBox.style.transform = 'scale(1)';
                    roomBox.style.pointer = 'none';
                })

                roomBox.addEventListener('click', function() {
                    createOpenModel('editRoomModal');
                });
                // Create the info icon
                const infoIcon = document.createElement('i');
                    infoIcon.className = 'fa-solid fa-info-circle info-icon';
                    infoIcon.style.position = 'absolute';
                    infoIcon.style.top = '10px';
                    infoIcon.style.right = '10px';
                    infoIcon.style.cursor = 'pointer';
                    infoIcon.style.backgroundColor = 'transparent';
                // Create the info span
                const spanInfo = document.createElement('span');
                    spanInfo.className = 'info-text';
                    spanInfo.textContent = 'Room Information';
                // Create the info div
                const spanDiv = document.createElement('div');
                    spanDiv.className = 'info-container';
                    spanDiv.style.display = 'none';
                    spanDiv.style.backgroundColor = 'white';
                    spanDiv.style.border = '1px solid #ccc';
                    spanDiv.style.borderRadius = '5px';
                    spanDiv.style.padding = '10px';
                    spanDiv.style.zIndex = '1';
                    spanDiv.style.position = 'absolute';
                    spanDiv.appendChild(spanInfo);

                        // Create the staying info div
                        const stayingDiv = document.createElement('div');
                            stayingDiv.className = 'staying-info';
                            stayingDiv.textContent = room.status == 1 ? 'Staying' : 'Not Staying';
                            stayingDiv.border = '1px solid #ccc';
                            stayingDiv.style.position = 'absolute';
                            stayingDiv.style.top = '0px';
                            stayingDiv.style.left = '0px';
                            stayingDiv.style.padding = '5px 10px';
                            stayingDiv.style.borderTopLeftRadius = '12px';
                            stayingDiv.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.2)';
                            stayingDiv.style.backgroundColor = room.status == 1 ? '#34C759' : 'gray';
                            stayingDiv.style.color = '#FFF';
                            stayingDiv.style.textShadow = '1px 1px 2px rgba(0, 0, 0, 0.3)';
                            stayingDiv.style.fontSize = '12px';

                            


                        const extraBed = room.extra_bed != 0 ? ` + ${room.extra_bed_name}` : '';
                        infoIcon.addEventListener('click', (event) => {
                            spanDiv.style.display = 'block';
                            spanDiv.style.position = 'absolute';
                            spanDiv.style.top = event.clientY + 'px';
                            spanDiv.style.left = event.clientX + 'px';
                        });

                        //Check Out Button
                        const editButton = document.createElement('button');
                            editButton.className = 'btn btn-primary checkout-btn';
                            editButton.setAttribute('type', 'button');
                            editButton.textContent = 'Edit Room';
                            editButton.style.position = 'absolute';
                            editButton.style.bottom = '5px';
                            editButton.style.right = '10px';
                            editButton.style.left = '8%';
                            editButton.style.transform = 'translateX(-50%)';
                            editButton.style.border = "none";
                            // Optional: Also remove focus ring
                            editButton.style.outline = "none";
                            editButton.style.boxShadow = "none";
                            editButton.addEventListener('mousedown', function(e) {
                                const x = e.clientX - e.target.offsetLeft;
                                const y = e.clientY - e.target.offsetTop;
                                const ripple = document.createElement('span');
                                ripple.className = 'ripple';
                                ripple.style.width = e.target.offsetWidth + 'px';
                                ripple.style.left = x + 'px';
                                ripple.style.top = y + 'px';
                                e.target.appendChild(ripple);
                                setTimeout(() => ripple.remove(), 500);
                            });

                            roomBox.addEventListener('mouseenter', () => {    
                                roomBox.style.transform = 'scale(1.05)';
                                roomBox.style.animation = 'shake 0.5s ease-in-out';
                                  editButton.style.transition = 'all 0.1s ease-in-out';
                                editButton.style.opacity = '0';
                                editButton.style.transform = 'translateY(10px)';
                                setTimeout(() => {
                                    editButton.style.opacity = '1';
                                    editButton.style.transform = 'translateY(0px)';
                                }, 50);
                                
                                editButton.onclick = () => {
                                    // Add your checkout logic here
                                    console.log(`Checking out room: ${room.room_number}`);
                                };

                                roomBox.appendChild(editButton);
                            });

                            roomBox.addEventListener('mouseleave', () => {
                                roomBox.style.transform = 'scale(1)';
                                roomBox.style.animation = 'none';
                                const editButton = roomBox.querySelector('.checkout-btn');
                                if (editButton) {
                                    roomBox.removeChild(editButton);
                                }
                            });

                        
                        roomBox.innerHTML = `
                            <div class='text-center no-boder '>
                                <i style="color: ${room.type == 1 ? '#FADEAG' : room.type == 2 ? 'blue' : room.type == 3 ? 'red' : 'green'};" class='${iconClass}' ></i>
                                <${tag} style="background-color: black; border-radius: 10px; color: #fff;">${room.room_number}</${tag}>
                                <h3>${room.roomtype_name}</h3>
                                <div class='mb-1'>${room.bed_name} <i>${extraBed} </i></div>
                                ${infoIcon.outerHTML}
                            </div>
                        `; 

                        roomBox.appendChild(stayingDiv);
                        roomContainer.appendChild(spanDiv);
                        roomContainer.appendChild(roomBox);
                
                
            });
            
            
        })
        .catch(error => console.error('Error fetching room data:', error));
}

