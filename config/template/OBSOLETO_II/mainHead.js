document.addEventListener("DOMContentLoaded", () => {
    fetch('../../config/templates/mainHead.json') //Carga el Json
        .then(response => response.json())  //Convierte la respuesta a objeto JS
        .then(data => {
            const head = document.head; //head es elobjeto HEAD de la página

            // Definir las meta etiquetas a generar con un array de objetos.
            const metaTags = [
                { name: 'twitter:site', content: data.twitter_site },
                { name: 'twitter:creator', content: data.twitter_creator },
                { name: 'twitter:card', content: data.twitter_card },
                { name: 'twitter:title', content: data.twitter_title },
                { name: 'twitter:description', content: data.twitter_description },
                { name: 'twitter:image', content: data.twitter_image },
                { property: 'og:url', content: data.og_url },
                { property: 'og:title', content: data.og_title },
                { property: 'og:description', content: data.og_description },
                { property: 'og:image', content: data.og_image },
                { property: 'og:image:secure_url', content: data.og_image_secure_url },
                { property: 'og:image:type', content: data.og_image_type },
                { property: 'og:image:width', content: data.og_image_width },
                { property: 'og:image:height', content: data.og_image_height },
                { name: 'description', content: data.meta_description },
                { name: 'author', content: data.meta_author }
            ];

            // Función para crear etiquetas meta y agregarlas al <head>
            metaTags.forEach(meta => {
                if (meta.content) { // Verificar que haya contenido antes de crear la etiqueta
                    let tag = document.createElement('meta');

                    if (meta.name) {
                        tag.setAttribute('name', meta.name);
                    } else if (meta.property) {
                        tag.setAttribute('property', meta.property);
                    }

                    tag.setAttribute('content', meta.content);
                    head.appendChild(tag);
                }
            });
        })
        .catch(error => console.error('Error cargando metadata.json:', error));
});
