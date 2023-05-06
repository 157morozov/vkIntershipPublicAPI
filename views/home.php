data save
<form action="save" method="post">
    <input name="query_name" type="text" placeholder="query_name" required>
    <label for="user_auth_status">Is user auth? </label>
    <input name="user_auth_status" type="checkbox">
    <button type="submit">Save</button>
</form>

data get response
<form action="response" method="post">
    <select id="o-reponse-select" name="filter" required>
        <option selected disabled>Filter</option>
        <option value="by_query_name">By query name</option>
        <option value="by_date">By query date</option>
        <option value="by_user_ip">By user ip</option>
        <option value="by_user_auth_status">By user auth status</option>
    </select>
    <input id="o-response-value" name="value" type="text" placeholder="Value" style="display: none;" required>
    <button type="submit">Get response</button>
</form>

<script>
    responseSelect = document.getElementById("o-reponse-select")
    responseValue = document.getElementById("o-response-value")
    responseSelect.addEventListener("input", function() {
        responseValue.style.display = "inline"
        if (responseSelect.value == "by_user_auth_status") {
            responseValue.setAttribute("type", "checkbox")
            responseValue.removeAttribute("required")
        }
        else if (responseSelect.value == "by_date") {
            responseValue.setAttribute("type", "date")
            responseValue.setAttribute("required", "true")
        }
        else {
            responseValue.setAttribute("type", "text")
            responseValue.setAttribute("required", "true")
        }
    })
</script>