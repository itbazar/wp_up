$(document).ready(function () {
     convert_number = (function () {
        var numerals = {
            persian: ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"],
            arabic: ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"]
        };

        return {
            toNormal: function (str) {
                var num, i, len = str.length, result = "";

                for (i = 0; i < len; i++) {
                    num = numerals["persian"].indexOf(str[i]);
                    num = num != -1 ? num : numerals["arabic"].indexOf(str[i]);
                    if (num == -1) num = str[i];
                    result += num;
                }
                return result;
            }
        }
    })();
});
