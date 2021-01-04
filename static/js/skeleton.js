const themeCookieName = 'theme';
const themeDark = 'dark';
const themeLight = 'light';

const body = document.getElementsByTagName('body')[0];

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/'
}  

function getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++)
    {
        var c = ca[i];
        while(c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if(c.indexOf(name)==0){
            return c.substring(name.length, c.length)
        }
    }
    return "";
}

loadTheme();

function loadTheme() {
    var theme = getCookie(themeCookieName);
    body.classList.add(theme === "" ? themeLight : theme)
}

function switchTheme() {
    if(body.classList.contains(themeLight))
    {
        body.classList.remove(themeLight);
        body.classList.add(themeDark)
        setCookie(themeCookieName, themeDark);
    }
    else
    {
        body.classList.remove(themeDark);
        body.classList.add(themeLight)
        setCookie(themeCookieName, themeLight);
    }
}

function collapseSidebar() {
    body.classList.toggle('sidebar-expand');
}

window.onclick = function(event) {
    openCloseDropdown(event);
}

function closeAllDropdown() {
    var dropdowns = document.getElementsByClassName('dropdown-expand');
    for(var i = 0; i< dropdowns.length; i++){
        dropdowns[i].classList.remove('dropdown-expand');
    }
}

function openCloseDropdown(event){
    if (!event.target.matches('.dropdown-toggle')) {
        closeAllDropdown()
    }
    else
    {
        var toggle = event.target.dataset.toggle;
        var content = document.getElementById(toggle);
        if (content.classList.contains('dropdown-expand')) {
            closeAllDropdown();
        } else {
            closeAllDropdown();
            content.classList.add('dropdown-expand');
        }
    }
}



function open1() {
    let val = document.getElementById('Expense');
    let sib1 = val.nextElementSibling;
    let sib2 = sib1.nextElementSibling;
    if(val.classList.length === 1)
    {
        val.classList.add("open");
        console.log(val.classList);
        sib1.outerHTML = `<li class="sidebar-nav-item">
                            <a href="5-Add-Expenses.php" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Add Expenses
                                </span>
                            </a>
                        </li>`
        sib2.outerHTML = `<li class="sidebar-nav-item">
                                <a href="6-Manage-Expenses.php" class="sidebar-nav-link">
                                    <div>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Manage Expenses
                                    </span>
                                </a>
                            </li>`
    }
    else
    {
        val.classList.remove("open");
        sib1.outerHTML = `<li class="sidebar-nav-item" style="display: none">
                                <a href="5-Add-Expenses.php" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Add Expenses
                                </span>
                                </a>
                            </li>`
        sib2.outerHTML = `<li class="sidebar-nav-item">
                                <a href="6-Manage-Expenses.php" class="sidebar-nav-link" style="display: none">
                                <div>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <span>
                                    Manage Expenses
                                </span>
                                </a>
                            </li>`
    }

}

function open2() {
    let val = document.getElementById('ER');
    let sib1 = val.nextElementSibling;
    let sib2 = sib1.nextElementSibling;
    let sib3 = sib2.nextElementSibling;
    if(val.classList.length === 1)
    {
        val.classList.add("open");
        console.log(val.classList);

        sib1.outerHTML = `<li class="sidebar-nav-item">
                                <a href="7-Datewise.php" class="sidebar-nav-link">
                                    <div>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Datewise Report
                                    </span>
                                </a>
                            </li>`
        sib2.outerHTML = `<li class="sidebar-nav-item">
                                <a href="8-Monthly.php" class="sidebar-nav-link">
                                    <div>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Monthly Report
                                    </span>
                                </a>
                            </li>`
        
        sib3.outerHTML = `<li class="sidebar-nav-item">
                                <a href="9-Yearly.php" class="sidebar-nav-link">
                                    <div>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Yearly Report
                                    </span>
                                </a>
                            </li>`
    }
    else
    {
        val.classList.remove("open");
        sib1.outerHTML = `<li class="sidebar-nav-item" style="display:none;">
                                <a href="7-Datewise.php" class="sidebar-nav-link">
                                    <div>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Datewise Report
                                    </span>
                                </a>
                            </li>`
        sib2.outerHTML = `<li class="sidebar-nav-item" style="display: none;">
                                <a href="8-Monthly.php" class="sidebar-nav-link">
                                    <div>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Monthly Report
                                    </span>
                                </a>
                            </li>`

        sib3.outerHTML = `<li class="sidebar-nav-item" style="display:none;">
                                <a href="9-Yearly.php" class="sidebar-nav-link">
                                    <div>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <span>
                                        Yearly Report
                                    </span>
                                </a>
                            </li>`
    }

}

