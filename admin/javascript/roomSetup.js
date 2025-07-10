
createOpenModel = () => {
    document.querySelector('.modal').style.display = 'block';
    document.querySelector('.modal').style.animation = 'popUp 0.3s ease';
    document.querySelector('.modal').style.transform = 'translateY(-50px)';
    document.querySelector('.modal').style.transition = 'transform 0.3s ease, opacity 0.3s ease';
    document.querySelector('.modal').style.background = 'rgba(51, 51, 51, 0.3)';
    document.querySelector('.modal').style.opacity = '1';
    setTimeout(() => {
        document.querySelector('.modal').style.transform = 'translateY(0)';
    }, 10);

}

/**
 * Closes the modal dialog by setting its display style to 'none'.
 */
createCloseModel = () => {
    document.querySelector('.modal').style.animation = 'popDown 0.3s ease forwards';
    document.querySelector('.modal').style.transition = 'transform 0.3s ease, opacity 0.3s ease';
    document.querySelector('.modal').style.transform = 'translateY(-50px)';
    document.querySelector('.modal').style.opacity = '0';
    setTimeout(() => {
        document.querySelector('.modal').style.display = 'none';
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

                            


                        const extraBed = room.extra_bed != 0 ? ` + ${room.extrabed_name}` : '';
                        infoIcon.addEventListener('click', (event) => {
                            spanDiv.style.display = 'block';
                            spanDiv.style.position = 'absolute';
                            spanDiv.style.top = event.clientY + 'px';
                            spanDiv.style.left = event.clientX + 'px';
                        });

                        
                        roomBox.innerHTML = `
                            <div class='text-center no-boder '>
                                <i style="color: ${room.type == 1 ? '#FADEAG' : room.type == 2 ? 'blue' : room.type == 3 ? 'red' : 'green'};" class='${iconClass}' ></i>
                                <${tag} style="background-color: black; border-radius: 10px; color: #fff;">${room.room_number}</${tag}>
                                <h3>${room.roomtype_name}</h3>
                                <div class='mb-1'>${room.bedding} <i>${extraBed} </i></div>
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

