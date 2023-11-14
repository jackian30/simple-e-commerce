import "vuetify/styles";
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const myCustomLightTheme = {
    dark: false,
    colors: {
        background: '#FFFFFF',
        surface: '#FFFFFF',
        primary: '#246caa',
        secondary: '#03DAC6',
        error: '#fc4855',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#249055',
    }
}

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: "myCustomLightTheme",
        themes: {
            myCustomLightTheme,
        },
    },
});

export default vuetify;
