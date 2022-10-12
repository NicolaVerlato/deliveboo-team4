<template>
    <div>
        <svg
            data-name="Layer 1"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1200 120"
            preserveAspectRatio="none"
            style="
                opacity: 1;
                width: 100%;
                height: 60px;
                fill: #fea543;
                transform: rotateY(180deg);"
            >
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
        
        

        


            <!-- Social media area -->

            <div class="total-footer">

                <!-- Top part of the footer - sites links and faq -->
                <div class="top-footer">
                    <div class="container">

                        <h5 class="navbar-brand col-sm-3 col-md-2 mr-0" style="font-size: 20px; margin-top: 30px;">
                            <a 
                            class="header-links" 
                            style="color: white;" 
                            href="http://127.0.0.1:8000/login"> 
                                Sezione ristoranti 
                            </a>        
                        </h5>

                        <div class="faq-cols">

                            <!-- Chi siamo -->
                            <ul>
                                <li>
                                    <h3>Chi siamo</h3>
                                </li>
                                <li>
                                    <a href="#">Le origini</a>
                                </li>
                                <li>
                                    <a href="#">Dove siamo</a>
                                </li>
                                <li>
                                    <a href="#">Contattaci</a>
                                </li>
                                <li>
                                    <a href="#">Lavora con noi</a>
                                </li>
                            </ul>

                            <!-- Faq -->
                            <ul>
                                <li>
                                    <h3>Faq</h3>
                                </li>
                                <li>
                                    <a href="#">Termini di utilizzo</a>
                                </li>
                                <li>
                                    <a href="#">Privacy policy</a>
                                </li>
                                <li>
                                    <a href="#">Pubblicità</a>
                                </li>
                                <li>
                                    <a href="#">Domande frequenti</a>
                                </li>
                            </ul>

                            <!-- Marchio -->
                            <ul>
                                <li>
                                    <h3>Marchio</h3>
                                </li>
                                <li>
                                    <a href="#">Deliveboo</a>
                                </li>
                                <li>
                                    <a href="#">Copyright</a>
                                </li>
                                <li>
                                    <a href="#">Deliveboo App</a>
                                </li>
                                <li>
                                    <a href="#">Diritti</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>    

        
    </div>
</template>

<script>

    export default {
        name: 'Footer'
    }
    
</script>

<style lang="scss" scoped>
    .total-footer {
        // Top part of the footer styles
        .faq-cols {
            display: flex;
            align-self: center;
            ul {
                margin: 0 30px;
                .sub-list {
                    margin: 0;
                }
                li {
                    margin: 6px;
                }
                a {
                    color: white;
                }
            }
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .container {
            display: flex;
            justify-content: space-between;
            background-size: cover;
            padding-bottom: 30px;
            h3 {
                margin: 10px 0;
            }
        }
        // Bottom part of the footer styles
        .bottom-footer {
            position: relative;
            background-color: white;
            .container {
                height: 100%;
                display: flex;
                align-items: center;
                h3 {
                    color: black;
                }
            }
         
        }
    }
</style>