document.addEventListener("DOMContentLoaded", function () {
    const 
    canvas = document.querySelector('canvas'),
    toolBtns = document.querySelectorAll('.tool'),
    fillColor = document.querySelector('#fill-color'),
    sizeBrush = document.querySelector('#size-slider'),
    colorBtns = document.querySelectorAll('.colors .option'),
    colorPicker = document.querySelector('#color-picker'),
    clearAll = document.querySelector('.clear-canvas'),
    saveImg = document.querySelector('.save-img');

    const ctx = canvas.getContext('2d', { willReadFrequently: true });
    // để chống lỗi: Canvas2D: Multiple readback operations using getImageData are faster with the willReadFrequently attribute set to true


    let preMouseX, preMouseY, snapShot,
        isDrawing = false, // ngăn việc vẽ khi di chuột lên
        brushWidth = 5; // độ dày của brush là 5
        selectedTool = "brush",// mặc định lúc đầu là brush
        selectedColor = '#000'; // màu mặc định là đen

    window.addEventListener('load', () => {
        canvas.width = canvas.offsetWidth; // chỉnh kích thước trang canvas bằng độ dài ngang của cửa sổ windows
        canvas.height = canvas.offsetHeight;
    });

    // vẽ hình chữ nhật
    const drawRect = (e) => {
        // nếu không chọn fill thì sẽ chỉ tô màu stroke thôi
        if (!fillColor.checked) {
            return ctx.strokeRect(e.offsetX, e.offsetY, preMouseX - e.offsetX, preMouseY - e.offsetY);
            // strokeRect(x-coordinate, y-coordinate, width, height);
        }
        ctx.fillRect(e.offsetX, e.offsetY, preMouseX - e.offsetX, preMouseY - e.offsetY);
        // nếu chọn fill thì sẽ tô màu
    }

    // vẽ hình tròn
    const drawCircle = (e)=> {
        ctx.beginPath(); // bắt đầu nét vẽ
        let r = Math.sqrt(Math.pow((preMouseX - e.offsetX), 2) + Math.pow((preMouseY - e.offsetY), 2)); 
        // đầu tiên ta xác định tâm O là chỗ đặt mouse xuống, từ đó ta có xác định tọa độ để vẽ bán kính bằng đường lên trên qua tâm là Oy, đường ngang qua tâm là Ox, 
        // từ đó có công thức: r = cạnh huyền trong tam giác vuông có 2 cạnh là tọa độ x và y => ct: r = căn (x^2 + y^2)
        ctx.arc(preMouseX, preMouseY, r, 0, 2*Math.PI); 
        // hàm arc này dùng để vẽ hình tròn
        // arc(x-coordinate, y-coordinate, r, start angle, end angle);

        if (!fillColor.checked) {
            ctx.stroke();
        } else {
            ctx.fill();
        }
        // fillColor.checked ? ctx.fill() : ctx.stroke();
    }

    // vẽ hình tam giác
    const drawTriangle = (e)=> {
        ctx.beginPath();

        ctx.moveTo(preMouseX, preMouseY); // start point(preMouseX, preMouseY)
        ctx.lineTo(e.offsetX, e.offsetY); // end point(currentX, currentY)

        ctx.lineTo(preMouseX * 2 - e.offsetX, e.offsetY) // create bottom line of triangle
        ctx.closePath(); // đóng phần còn lại của path thì sẽ tự động tạo nét thứ 3
        ctx.stroke();

        fillColor.checked ? ctx.fill() : ctx.stroke();
    }

    const drawStraight = (e)=> {
        ctx.beginPath();

        ctx.moveTo(preMouseX, preMouseY); // start point(preMouseX, preMouseY)
        ctx.lineTo(e.offsetX, e.offsetY); // end point(currentX, currentY)
        ctx.stroke();
    }

    function startDraw(e) {
        isDrawing = true;
        preMouseX = e.offsetX; // gán current mouseX position cho preMouseX value
        preMouseY = e.offsetY; // 
        ctx.beginPath(); // tạo nét vẽ
        ctx.lineWidth = brushWidth; // thay đổi độ dày của nét vẽ
        ctx.strokeStyle = selectedColor; // đổi màu
        ctx.fillStyle = selectedColor; // đổi màu

        snapShot = ctx.getImageData(0, 0, canvas.width, canvas.height);
        // copy canvas data & gán cho snapShot value -> tránh việc dragging hình ảnh
        // phương thức này trả về 1 ImageData object, nó sẽ copy the pixel data
    }

    const drawing = (e) => {
        if (!isDrawing) return;
        ctx.putImageData(snapShot, 0, 0); 
        // thêm cái canvas data đã copy vào trong  canvas 
        // hàm này đặt data image trở lại canvas

        if (selectedTool === "brush" || selectedTool === "eraser") {
            // nếu selected tool là eraser, thì set strokeStyle là trắng
            // to paint white color on to the existing canvas content, set the stroke color to selected color
            ctx.strokeStyle = (selectedTool === 'eraser') ? '#fff' : selectedColor;
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        } else if (selectedTool === 'rectangle') {
            drawRect(e);
        } else if (selectedTool === 'circle') {
            drawCircle(e);
        } else if (selectedTool === 'triangle') {
            drawTriangle(e);
        } else {
            drawStraight(e);
        }
    }

    toolBtns.forEach(btn => {
        btn.addEventListener('click', () => { // thêm các sự kiện click cho các tool options
            // xóa class active từ những option trước và thêm sự kiện click vào options hiện tại
            document.querySelector('.options .active').classList.remove('active');
            btn.classList.add('active');
            selectedTool = btn.id;
            console.log(selectedTool);
        })
    });

    sizeBrush.addEventListener('change', ()=> {
        brushWidth = sizeBrush.value; // thay đổi size của brush
    });

    colorBtns.forEach(btn => {
        btn.addEventListener('click', ()=> { // thêm các sự kiện click cho các tool options
            // xóa class active từ những option trước và thêm sự kiện click vào options hiện tại
            document.querySelector('.options .selected').classList.remove('selected');
            btn.classList.add('selected');
            
            selectedColor = window.getComputedStyle(btn).getPropertyValue('background-color');
            // đổi màu option
        })
    });

    colorPicker.addEventListener('change', ()=> {
        // passing picked color value from color picker to last color btn bacground
        // gán giá trị colorpicker từ color picker vào btn bacground
        colorPicker.parentElement.style.background = colorPicker.value;
        colorPicker.parentElement.click();
    });

    clearAll.addEventListener('click', ()=> {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // xóa các phần từ trên canvas
    });

    saveImg.addEventListener('click', ()=> {
        const link = document.createElement('a'); // tạo thẻ a
        link.download = `${Date.now()}.jpg`; // gán ngày hiện tại vào link download
        link.href = canvas.toDataURL(); // gán canvasData vào giá trị link href 
        link.click(); // click để download img
    });

    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', drawing);
    canvas.addEventListener('mouseup', () => {  // khi chuột không đặt xuống -> ngừng vẽ
        isDrawing = false;
    });
});
