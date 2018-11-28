<?php include ('element/navbar.php'); ?>
<div class="main-container post-view">
    <div id="home-banner">
        <?php include ('modules/banner.php') ?>
    </div>

    <section v-cloak id="post-view">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11 border-post-view ">
                    <div class="row">
                        <div class="col-md-9 border-box full-post">
                            <div class="row">
                                <div class="col-md-12 img-post-view content-post" >
                                    <template v-for="el in state.post.body">
                                        <div v-if="el.type.indexOf('text/html') > -1" v-html="el.value">

                                        </div>
                                        <div v-else-if="el.type.indexOf('image/') > -1" class="upload-img">
                                            <p>
                                                <img v-bind:src="el.url" v-bind:type="el.type" alt="">
                                            </p>
                                        </div>
                                        <div v-else-if="el.type.indexOf('video/') > -1" class="upload-img">
                                            <p>
                                                <video controls>
                                                    <source v-bind:src="el.url" v-bind:type="el.type">
                                                </video>
                                            </p>
                                        </div>
                                        <div v-else-if="el.type.indexOf('audio/') > -1" class="upload-img">
                                            <p>
                                                <audio controls>
                                                    <source v-bind:src="el.url" v-bind:type="el.type">
                                                </audio>
                                            </p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="row row-promote justify-content-center">
                                <div class=" col-md-4 text-center">
                                    <div class="modal-instance">

                                        <a href="#" class="btn btn--transparent modal-trigger">
                                            <span class="btn__text color--dark">
                                                {{ lang.BUTTON.PROMOTE }}
                                            </span>
                                        </a>

                                        <div class="modal-container">
                                            <div class="modal-content section-modal">
                                                <section class="unpad ">
                                                    <div class="container">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6 col-md-8 col-sm-12">
                                                                <div class="feature feature-1">
                                                                    <div class="feature__body boxed boxed--lg boxed--border">
                                                                        <div class="modal-close modal-close-cross"></div>
                                                                        <div class="text-block">
                                                                            <h3>{{ config.title }}</h3>
                                                                            <p>{{ config.text }}</p>
                                                                        </div>
                                                                        <form>
                                                                            <div class="row">
                                                                                <div class="col-md-1">
                                                                                    <p class="text-p-form">{{ lang.MODAL.WALLET_FROM }}</p>
                                                                                </div>
                                                                                <div class="col-md-11">
                                                                                    <div class="input-icon input-icon--left">
                                                                                        <i class="fas fa-at"></i>
                                                                                        <input disabled type="text" v-model="from" v-bind:placeholder="lang.MODAL.WALLET_INPUT_SEND_PLACEHOLDER">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-1">
                                                                                    <p class="text-p-form">{{ lang.MODAL.WALLET_TO}}</p>
                                                                                </div>
                                                                                <div class="col-md-11">
                                                                                    <div class="input-icon input-icon--left">
                                                                                        <i class="fas fa-at"></i>
                                                                                        <input v-bind:disabled="config.confirmed" v-on:input="validateDestiny" v-bind:class="{ 'field-error': toError }" v-model="to" type="text" name="input" v-bind:placeholder="lang.MODAL.WALLET_INPUT_SEND_PLACEHOLDER">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <p class="text-p-form">{{ lang.MODAL.WALLET_AMOUNT }}</p>
                                                                                </div>
                                                                                <div class="col-md-10">
                                                                                    <div class="input-icon input-icon--right">
                                                                                        <i class="">CREA</i>
                                                                                        <input v-bind:disabled="config.confirmed" v-model="amount" type="number" step="0.001" name="input" v-bind:placeholder="lang.MODAL.WALLET_INPUT_AMOUNT">
                                                                                        <p class="amount-save" v-on:click="useTotalAmount">{{ lang.WALLET.BALANCE }}: {{ config.total_amount.toFriendlyString() }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div v-if="config.op != 'transfer_to_vests'" class="row">
                                                                                <div class="col-md-2"></div>
                                                                                <div class="col-md-10">
                                                                                    <p>{{ lang.MODAL.WALLET_MEMO_TEXT }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div v-if="config.op != 'transfer_to_vests'" class="row">
                                                                                <div class="col-2">
                                                                                    <p class="text-p-form">{{ lang.MODAL.WALLET_MEMO }}</p>
                                                                                </div>
                                                                                <div class="col-md-10">
                                                                                    <div class="input-icon input-icon--right">
                                                                                        <input v-bind:disabled="config.confirmed" v-model="memo" type="text" placeholder="Enter your name">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col text-right">
                                                                                    <a v-if="config.confirmed" href="#0"
                                                                                       class="btn btn--sm btn--primary type--uppercase"
                                                                                       v-on:click="cancelSend">
                                                                                        <span class="btn__text">{{ lang.BUTTON.CANCEL}}</span>
                                                                                    </a>
                                                                                    <a href="#0" class="btn btn--sm btn--primary type--uppercase" v-on:click="sendCrea">
                                                                                        <span class="btn__text">{{ config.confirmed ? config.button : lang.BUTTON.CONFIRM }}</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <!--end of row-->
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!--end feature-->
                                                            </div>
                                                        </div>
                                                        <!--end of row-->
                                                    </div>
                                                    <!--end of container-->
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><p class="subtitle-content-publish">{{ lang.PUBLICATION.MORE_PROJECTS }}</p></div>
                            </div>
                            <div class="row">
                                <template v-for="o in otherProjects">
                                    <div class="col-md-4">
                                        <div class="img-more-projects"
                                             v-on:click="showPost(o)"
                                             v-bind:style="{ 'background-image': 'url(' + o.metadata.featuredImage + ')' }"></div>
                                    </div>
                                </template>
                            </div>
                            <!--<div class="row">
                                <div class="col-md-12"><p class="subtitle-content-publish">{{ lang.PUBLICATION.YOUR_COMMENTS }}</p></div>
                            </div>-->
                            <div class="row mt--1">
                                <div class="col-md-12">
                                    <p class="subtitle-content-publish">Your comments</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="boxed boxed--border box-comment">
                                        <div v-if="session" class="row">
                                            <div class="col-md-12 row-comment">

                                                <div class="user-avatar">
                                                    <a href="/profile.php">
                                                        <div class="img-user-avatar" v-bind:style="{ 'background-image': 'url(' + (user.metadata.avatar.url || getDefaultAvatar(user.name)) + ')' }"></div>
                                                    </a>
                                                </div>
                                                <div class="textarea">
                                                    <textarea name="text" placeholder="Message" rows="4" v-model="comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt--1 text-right">
                                                <a class="btn btn--primary" href="#/" v-on:click="makeComment">
                                                    <span class="btn__text">
                                                        {{ lang.BUTTON.POST_COMMENT }}
                                                    </span>
                                                </a>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>{{ lang.PUBLICATION.COMMENTS + ' (' + state.post.children + ')' }}</h3>
                                            </div>
                                        </div>

                                        <template v-for="c in state.comments">
                                            <div v-if="c != state.postKey" class="row">
                                                <div class="col-md-12">
                                                    <div class="row-post-comments">
                                                        <div class="user-avatar">
                                                            <a v-bind:href="'/@' + state.content[c].author">
                                                                <avatar v-bind:account="state.accounts[state.content[c].author]"></avatar>
                                                            </a>
                                                        </div>
                                                        <div class="user-comments">
                                                            <p>
                                                                <username v-bind:inline="1" v-bind:user="state.content[c].author" v-bind:name="state.accounts[state.content[c].author].metadata.publicName"></username>
                                                                <img src="/img/icons/trainer.svg" alt="">
                                                                <span>{{ dateFromNow(state.content[c].created) }}</span>
                                                            </p>
                                                            <span class="comment-user">{{ state.content[c].body }}</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <ul class="list-inline list-unstyled ul-row-share-comment">
                                                                        <li><a href="#/" v-on:click="makeVote(state.content[c])"><img src="/img/icons/like.svg" alt="">{{ state.content[c].active_votes.length }}</a></li>
                                                                        <li><p>{{ state.content[c].pending_payout_value }}</p></li>
                                                                        <li v-if="session"><p>Comentar</p></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>


                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a href="" class="more-comments">{{ lang.PUBLICATION.MORE_COMMENTS }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="boxed boxed--border box-blockchain-certificate">
                                        <img class="certificat-flag" src="/img/crea-web/publish/flag.png" alt="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="feature feature-2">
                                                    <div class="feature__body">
                                                        <ul class="list-unstyled list-inline w-100 mb-0">
                                                            <li><h2 class="title-certificate">{{ lang.PUBLICATION.CERTIFICATE }}</h2></li>
                                                            <ul class="float-right">
                                                                <li class="li-blockchain-certificate">
                                                                    <template v-for="i in getLicense().getIcons('white')">
                                                                        <img v-bind:src="i" alt="">
                                                                    </template>
                                                                </li>
                                                            </ul>
                                                        </ul>
                                                        <hr>
                                                        <p>License: Creative Commons BY-SA</p>
                                                        <p>Timestamp: {{ new Date(state.post.created).toLocaleString() }}</p>
                                                        <p>{{ state.post.metadata.hash || '-' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="boxed boxed--border box-report">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="list-inline list-unstyled">
                                                    <li><p><img src="/img/icons/report_content.svg" alt="">(0) Report Content</p></li>
                                                    <li><p><img src="/img/icons/NO_see.svg" alt="">(0) Block all posts by this user</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- MENU RIGHT -->

                        <div class="col-md-3 menu-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row-user-name">
                                        <div class="user-avatar">
                                            <a v-bind:href="'/@' + state.author.name">
                                                <avatar v-bind:account="state.author"></avatar>
                                            </a>
                                        </div>
                                        <div class="user-data">
                                            <username class="name color--link" v-bind:inline="1" v-bind:user="state.author.name" v-bind:name="state.author.metadata.publicName"></username>
                                            <p class="website">{{ state.author.metadata.web || '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-master">
                                <div class="col-md-6">
                                    <img src="/img/icons/master.svg" alt="">
                                    <p>Master</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="/img/icons/buzz.svg" alt="">
                                    <p>385 Buzz</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <btn-follow v-if="session"
                                                v-on:follow="onFollow" v-bind:session="session"
                                                v-bind:account="user"
                                                v-bind:user="state.post.author" >

                                    </btn-follow>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row row-publish-description">
                                <div class="col-md-12">
                                    <p class="title">{{ state.post.title }}</p>
                                    <span class="description">{{ state.post.metadata.description }}</span>
                                    <p class="date-publish description mt-4">{{ formatDate(state.post.created) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row row-publish-tags">
                                <div class="col-md-12">
                                    <p class="title">TAGS</p>
                                    <span class="description">{{ state.post.metadata.tags.join(', ') || '' }}</span>
                                </div>
                            </div>

                            <div class="row row-social">
                                <div class="col-md-12">
                                    <ul class="ul-social">
                                        <hr>
                                        <li>
                                            <div class="row-likes">
                                                <!--<div class="col-likes">
                                                    <img src="/img/icons/like_BLUE.svg" alt="">
                                                    <p>{{ state.post.active_votes.length }} {{ lang.PUBLICATION.LIKES }}</p>
                                                </div>-->
                                                <post-like v-on:vote="onVote" v-bind:session="session" v-bind:post="state.post"></post-like>
                                                <div class="col-amount">
                                                    <span>{{ getPayout() }}</span>
                                                </div>
                                            </div>


                                        </li>
                                        <hr>
                                        <li>
                                            <img src="/img/icons/downloads.svg" alt="">
                                            <p>0 {{ lang.PUBLICATION.DOWNLOADS }}</p>
                                        </li>
                                        <hr>
                                        <li>
                                            <img src="/img/icons/ic_share_black_24px.svg" alt="">
                                            <p>{{ lang.PUBLICATION.SHARE }}</p>
                                        </li>
                                        <hr>
                                    </ul>

                                </div>
                            </div>
                            <div class="row row-download">
                                <div class="col-md-12 text-center">
                                    <a class="btn btn--primary" href="#">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.DOWNLOAD }}
                                        </span>
                                    </a>
                                </div>
                                <div class="col-md-12 row-format">
                                    <p class="title">{{ lang.PUBLICATION.FORMAT }}</p>
                                    <span class="description">{{ state.post.metadata.download.type || '-' }}</span>
                                </div>
                                <div class="col-md-12 row-format">
                                    <p class="title">{{ lang.PUBLICATION.SIZE }}</p>
                                    <span class="description">{{ state.post.metadata.download.size || '-' }}</span>
                                </div>
                                <div class="col-md-12 row-format">
                                    <p class="title">{{ lang.PUBLICATION.PRICE }}</p>
                                    <span v-if="state.post.metadata.price === 0" class="description">{{ lang.PUBLICATION.FREE_DOWNLOAD }}</span>
                                    <span v-else class="description">{{ state.post.metadata.price }}</span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <script src="/js/common/post.js"></script>

<?php include ('element/footer.php'); ?>