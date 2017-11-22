function configureDropDownLists(ddl1,ddl2) {
    var group0 = ['Office of the Chairman Emeritus'];
    var group1 = ['Office of the Chairman and CEO'];
    var group2 = ['Office of the President and COO'];
    var group3 = ['Executive Office'];
    var group4 = ['Investor Relations','Strategic Planning','Business Development & Innovation'];
    var group5 = ['Corporate Communication','Public Policy'];
    var group6 = ['Corporate Finance and Asset Management','Treasury','Controllership','Risk Management and Sustainability'];
    var group7 = ['Internal Audit'];
    var group8 = ['Strategic Human Resources', 'Information & Communication Technology', 'Corporate Support Services','Knowledge Management'];
    switch (ddl1.value) {
        case 'Office of the Chairman Emeritus':
            ddl2.options.length = 0;
            for (i = 0; i < group0.length; i++) {
                createOption(ddl2, group0[i], group0[i]);
            }
            break;
        case  'Office of the Chairman and CEO':
            ddl2.options.length = 0;
            for (i = 0; i < group1.length; i++) {
                createOption(ddl2, group1[i], group1[i]);
            }
            break;
        case 'Office of the President and COO':
            ddl2.options.length = 0;
            for (i = 0; i < group2.length; i++) {
                createOption(ddl2, group2[i], group2[i]);
            }
            break;
        case 'Executive Office':
            ddl2.options.length = 0;
            for (i = 0; i < group3.length; i++) {
                createOption(ddl2, group3[i], group3[i]);
            }
            break;
        case  'Corporate Strategy and Development':
            ddl2.options.length = 0;
            for (i = 0; i < group4.length; i++) {
                createOption(ddl2, group4[i], group4[i]);
            }
            break;
        case 'Public Affairs':
            ddl2.options.length = 0;
            for (i = 0; i < group5.length; i++) {
                createOption(ddl2, group5[i], group5[i]);
            }
            break;
        case 'Finance':
            ddl2.options.length = 0;
            for (i = 0; i < group6.length; i++) {
                createOption(ddl2, group6[i], group6[i]);
            }
            break;
        case 'Corporate Governance':
            ddl2.options.length = 0;
            for (i = 0; i < group7.length; i++) {
                createOption(ddl2, group7[i], group7[i]);
            }
            break;
        case 'Corporate Resources Group':
            ddl2.options.length = 0;
            for (i = 0; i < group8.length; i++) {
                createOption(ddl2, group8[i], group8[i]);
            }
            break;
        default:
                ddl2.options.length = 0;
            break;
    }

}
function createOption(ddl, text, value) {
        var opt = document.createElement('option');
        opt.value = value;
        opt.text = text;
        ddl.options.add(opt);
    }