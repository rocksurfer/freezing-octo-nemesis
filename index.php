       <script type="text/javascript">
            
            if (typeof String.prototype.startsWith != 'function') {
                String.prototype.startsWith = function (str){
                    return this.slice(0, str.length) == str;
                };
            }
            
            var iabRef = null;
                        
            function launchUrl() {
                try {
                    var url = document.getElementById("windowUrl").value;
                    var target = getWindowName();
                    var showLocationbar = document.getElementById("windowOptions").checked;
                    
                    if (!url.startsWith('http://') && !url.startsWith('https://')) {
                        url = 'http://' + url;
                    }
                    
                    iabRef = window.open(url, target, "location=" + (showLocationbar? "yes":"no"));
                    iabRef.addEventListener('loadstart', onLoadStart);
                    iabRef.addEventListener('loadstart', onLoadStop);
                    iabRef.addEventListener('exit', onExit);
                
                } catch (e) {
                    alert(e);
                }
            }
            
            function getWindowName()
            {
                var radioButtons = document.getElementsByName("windowName");
                for (var i = 0; i < radioButtons.length; ++i) {
                    if (radioButtons[i].checked) {
                        return radioButtons[i].value;
                    }
                }
            }
            
            function checkUrlLength() {
                var txt = document.getElementById("windowUrl");
                var btn = document.getElementById("launchButton");
                
                btn.disabled = (txt.value.length == 0);
            }
                        
            function onLoadStart(event) {
                alert(event.type + ' - ' + event.url);
            }

            function onLoadStop(event) {
                alert(event.type + ' - ' + event.url);
            }

            function onExit(event) {
                alert(event.type);
                if (iabRef) {
                    iabRef.removeEventListener('loadstart', onLoadStart);
                    iabRef.removeEventListener('loadstart', onLoadStop);
                    iabRef.removeEventListener('exit', onExit);
                    iabRef = null;
                }
            }
            
        </script>
        <div style="margin-left:10px">
            <div style="margin-top:20px">
                <input type="radio" name="windowName" value="_self" />_self
                <input type="radio" name="windowName" value="_blank" checked="checked" />_blank
                <input type="radio" name="windowName" value="_system">_system
            </div>
            <div>
                <input type="checkbox" id="windowOptions"/>Show location bar?
            </div>
            <div>
                <input id="windowUrl" placeholder="Enter a url" onkeyup="checkUrlLength()" style="width:80%" type="text" id="windowUrl" value="www.google.com"/>
            </div>
            <button id="launchButton" onclick="launchUrl()">Launch InAppBrowser</button>
        </div>
