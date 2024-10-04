function toggleAccordion(id) {
    const content = document.getElementById(id);
    const button = document.querySelector(`button[onclick="toggleAccordion('${id}')"]`);

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "flex";
        button.classList.add('open');
        button.querySelector('.plus').textContent = '−';
    } else {
        content.style.display = "none";
        button.classList.remove('open');
        button.querySelector('.plus').textContent = '+';
    }
}

function selectItem(button) {
    button.classList.toggle('selected');
}

function clearSelections() {
    const selectedItems = document.querySelectorAll('.accordion_item.selected');
    selectedItems.forEach(item => item.classList.remove('selected'));
}

function selectAll(groupId, button) {
    const group = document.getElementById(groupId);
    const buttons = group.getElementsByClassName('accordion_item');
    const allSelected = Array.from(buttons).every(btn => btn.classList.contains('selected'));

    for (let btn of buttons) {
        if (allSelected) {
            btn.classList.remove('selected'); // すべて解除
        } else {
            btn.classList.add('selected'); // すべて選択
        }
    }

    // ボタン自体の選択状態を切り替え
    if (allSelected) {
        button.classList.remove('selected');
    } else {
        button.classList.add('selected');
    }
}
