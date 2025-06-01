<div class="footer">
                <button class="btn btn-success" name="setbookingbtn" onclick="setBookingBtn('$Name', '$National', '$Phone', '$RoomType', '$RoomNos', '$Bed', '$NoofRoom', '$Meal', '$cin', '$cout' )">Submit</button>
            </div>
            <style>
            .setbookingform .footer {
                height: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 10px 0 0 0;
            }
            .setbookingform .footer .btn {
                min-width: 120px;
                font-size: 18px;
                padding: 10px 24px;
                border-radius: 6px;
                border: none;
                background: #28a745;
                color: #fff;
                transition: background 0.2s;
                cursor: pointer;
            }
            .setbookingform .footer .btn:hover,
            .setbookingform .footer .btn:focus {
                background: #218838;
            }
            @media (max-width: 900px) {
                .setbookingform .footer .btn {
                    min-width: 100px;
                    font-size: 16px;
                    padding: 8px 18px;
                }
            }
            @media (max-width: 600px) {
                .setbookingform .footer {
                    height: auto;
                    margin: 8px 0 0 0;
                }
                .setbookingform .footer .btn {
                    width: 100%;
                    min-width: 0;
                    font-size: 15px;
                    padding: 10px 0;
                    border-radius: 5px;
                }
            }
            </style>