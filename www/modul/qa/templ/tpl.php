 <?=$GLOBALS['mess']?>
                    <div class="ask-question">
                        <p>Наши специалисты всегда с удовольствием ответят на Ваши вопросы!</p>
                        <form method="post" >
                            <input type="hidden" name="send" value="ok" />
                            <div class="ask-question-form">
                                <div class="aq-form-item">
                                    <p>Категория вопроса<span>*</span></p>
                                    <select name="kat"><?=$GLOBALS['ttemy']?></select>
                                </div>
                                <div class="aq-form-item">
                                    <p>Ваше имя<span>*</span></p>
                                    <input name="name" type="text" placeholder="Имя" />
                                </div>
                                <div class="aq-form-item">
                                    <p>Контакты<span>*</span></p>
                                    <input name="cont" type="text" placeholder="E-mail или телефон" />
                                </div>
                                <div class="aq-form-item">
                                    <em>например: example@example.com</em>
                                    <em>+38 0xx xxx xx xx</em>
                                </div>
                                <div class="aq-form-item">
                                    <p>Ваш вопрос<span>*</span></p>
                                    <textarea name="vopr" placeholder="Впишите Ваш вопрос"></textarea>
                                </div>
                                <div class="aq-form-item">
                                    <div class="aq-form-item-btn">
                                        <em><span>*</span> - поля обязательные для заполнения</em>
                                        <input class="button" type="submit" value="Отправить" />
                                    </div>
                                </div>
                            </div>
                        </form>
                   
                </div>

                
          
       