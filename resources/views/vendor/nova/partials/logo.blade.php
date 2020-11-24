{{-- <svg
    class="fill-current"
    width="{{ $width ?? '126' }}"
    height="{{ $height ?? '24' }}"
    viewBox="{{ $viewBox ?? '0 0 126 24' }}"
    xmlns="http://www.w3.org/2000/svg"
>
    <path d="M40.76 18h-6.8V7.328h2.288V16h4.512v2zm8.064 0h-2.048v-.816c-.528.64-1.44 1.008-2.448 1.008-1.232 0-2.672-.832-2.672-2.56 0-1.824 1.44-2.496 2.672-2.496 1.04 0 1.936.336 2.448.944v-.976c0-.784-.672-1.296-1.696-1.296-.816 0-1.584.32-2.224.912l-.8-1.424c.944-.848 2.16-1.216 3.376-1.216 1.776 0 3.392.704 3.392 2.928V18zm-3.68-1.184c.656 0 1.296-.224 1.632-.672v-.96c-.336-.448-.976-.688-1.632-.688-.8 0-1.456.432-1.456 1.168s.656 1.152 1.456 1.152zM52.856 18h-2.032v-7.728h2.032v1.04c.56-.672 1.504-1.232 2.464-1.232v1.984a2.595 2.595 0 0 0-.56-.048c-.672 0-1.568.384-1.904.88V18zm10.416 0h-2.048v-.816c-.528.64-1.44 1.008-2.448 1.008-1.232 0-2.672-.832-2.672-2.56 0-1.824 1.44-2.496 2.672-2.496 1.04 0 1.936.336 2.448.944v-.976c0-.784-.672-1.296-1.696-1.296-.816 0-1.584.32-2.224.912l-.8-1.424c.944-.848 2.16-1.216 3.376-1.216 1.776 0 3.392.704 3.392 2.928V18zm-3.68-1.184c.656 0 1.296-.224 1.632-.672v-.96c-.336-.448-.976-.688-1.632-.688-.8 0-1.456.432-1.456 1.168s.656 1.152 1.456 1.152zM69.464 18h-2.192l-3.104-7.728h2.176l2.016 5.376 2.032-5.376h2.176L69.464 18zm7.648.192c-2.352 0-4.128-1.584-4.128-4.064 0-2.24 1.664-4.048 4-4.048 2.32 0 3.872 1.728 3.872 4.24v.48h-5.744c.144.944.912 1.728 2.224 1.728.656 0 1.552-.272 2.048-.752l.912 1.344c-.768.704-1.984 1.072-3.184 1.072zm1.792-4.8c-.064-.736-.576-1.648-1.92-1.648-1.264 0-1.808.88-1.888 1.648h3.808zM84.36 18h-2.032V7.328h2.032V18zm15.232 0h-1.28l-6.224-8.512V18H90.76V7.328h1.36l6.144 8.336V7.328h1.328V18zm5.824.192c-2.352 0-3.824-1.824-3.824-4.064s1.472-4.048 3.824-4.048 3.824 1.808 3.824 4.048-1.472 4.064-3.824 4.064zm0-1.072c1.648 0 2.56-1.408 2.56-2.992 0-1.568-.912-2.976-2.56-2.976-1.648 0-2.56 1.408-2.56 2.976 0 1.584.912 2.992 2.56 2.992zm9.152.88h-1.312l-3.216-7.728h1.312l2.56 6.336 2.576-6.336h1.296L114.568 18zm10.496 0h-1.2v-.88c-.624.704-1.52 1.072-2.56 1.072-1.296 0-2.688-.88-2.688-2.56 0-1.744 1.376-2.544 2.688-2.544 1.056 0 1.936.336 2.56 1.04v-1.392c0-1.024-.832-1.616-1.952-1.616-.928 0-1.68.32-2.368 1.072l-.56-.832c.832-.864 1.824-1.28 3.088-1.28 1.648 0 2.992.736 2.992 2.608V18zm-3.312-.672c.832 0 1.648-.32 2.112-.96v-1.472c-.464-.624-1.28-.944-2.112-.944-1.136 0-1.92.704-1.92 1.68 0 .992.784 1.696 1.92 1.696zM20.119 20.455A12.184 12.184 0 0 1 11.5 24a12.18 12.18 0 0 1-9.333-4.319c4.772 3.933 11.88 3.687 16.36-.738a7.571 7.571 0 0 0 0-10.8c-3.018-2.982-7.912-2.982-10.931 0a3.245 3.245 0 0 0 0 4.628 3.342 3.342 0 0 0 4.685 0 1.114 1.114 0 0 1 1.561 0 1.082 1.082 0 0 1 0 1.543 5.57 5.57 0 0 1-7.808 0 5.408 5.408 0 0 1 0-7.714c3.881-3.834 10.174-3.834 14.055 0a9.734 9.734 0 0 1 .03 13.855zm.714-16.136C16.06.386 8.953.632 4.473 5.057a7.571 7.571 0 0 0 0 10.8c3.018 2.982 7.912 2.982 10.931 0a3.245 3.245 0 0 0 0-4.628 3.342 3.342 0 0 0-4.685 0 1.114 1.114 0 0 1-1.561 0 1.082 1.082 0 0 1 0-1.543 5.57 5.57 0 0 1 7.808 0 5.408 5.408 0 0 1 0 7.714c-3.881 3.834-10.174 3.834-14.055 0a9.734 9.734 0 0 1-.015-13.87C5.096 1.35 8.138 0 11.5 0c3.75 0 7.105 1.68 9.333 4.319z" fill-rule="evenodd"/>
</svg> --}}
<div class="text-center w-full">
      <svg class="fill-current"
    width="{{ $width ?? '148' }}"
    height="{{ $height ?? '28' }}"
    viewBox="{{ $viewBox ?? '0 0 148 28' }}"
    xmlns="http://www.w3.org/2000/svg">
        <g id="Group_7" data-name="Group 7" transform="translate(-473 -375)">
          <g id="Group_5" data-name="Group 5" transform="translate(473 375)">
            <g id="Group_1" data-name="Group 1" transform="translate(7.764 13.813)">
              <path id="Path_1" data-name="Path 1" d="M269.046,286.572h-7.038V278.05h2.709v5.583h1.533V276.35H255.812v-2.926c.2-.013.413-.037.622-.037q4.6,0,9.2,0a3.305,3.305,0,0,1,3.415,3.632C269.051,280.177,269.046,283.334,269.046,286.572Z" transform="translate(-255.812 -273.385)" />
            </g>
            <g id="Group_2" data-name="Group 2" transform="translate(0 0.009)">
              <path id="Path_2" data-name="Path 2" d="M132.811,57.229V51.659h-1.527v7.3h10.448v2.911c-.229.013-.44.037-.65.037q-4.565,0-9.129,0c-2.125,0-3.453-1.4-3.46-3.656-.009-3.155,0-6.311,0-9.517h7.025v8.491Z" transform="translate(-128.487 -48.738)" />
            </g>
            <g id="Group_3" data-name="Group 3" transform="translate(13.965 0)">
              <path id="Path_3" data-name="Path 3" d="M360.293,63.128a13.986,13.986,0,0,0-1.325-.9,11.414,11.414,0,0,0-1.381-.521V51.552h-1.57v10.19H353.3V48.6h6.992Z" transform="translate(-353.301 -48.602)" />
            </g>
            <g id="Group_4" data-name="Group 4" transform="translate(0.041 12.584)">
              <path id="Path_4" data-name="Path 4" d="M129.126,254.056l2.708,1.435v10.052h1.57V255.329h2.717v13.14h-6.995Z" transform="translate(-129.126 -254.056)" />
            </g>
          </g>
          <g id="Group_6" data-name="Group 6" transform="translate(486.478 379)">
            <path id="Path_6" data-name="Path 6" d="M176.9,314.485h-8.944v4.69h9.866l-.48,3.273H164.034V303.984h13.261v3.273h-9.336v3.956H176.9Z" transform="translate(-152.512 -303.713)" />
            <path id="Path_7" data-name="Path 7" d="M190.784,315.058v7.39h-3.952V303.984h8.217c4.077,0,6.274,2.218,6.274,5.069a4.42,4.42,0,0,1-2.718,4.369c.926.337,2.323,1.289,2.323,4.594v.912a14.526,14.526,0,0,0,.269,3.52h-3.833a12.822,12.822,0,0,1-.391-4.146v-.269c0-2.019-.516-2.975-3.53-2.975Zm0-3.178h3.39c2.214,0,3.068-.831,3.068-2.376,0-1.5-.994-2.342-2.972-2.342h-3.486Z" transform="translate(-158.597 -303.713)" />
            <path id="Path_8" data-name="Path 8" d="M227.017,316.659c-.752,3.445-3.383,5.955-8.066,5.955-5.93,0-8.733-4.145-8.733-9.4,0-5.063,2.892-9.6,8.928-9.6,4.979,0,7.393,2.887,7.85,5.975h-4.043a3.659,3.659,0,0,0-3.936-2.843c-3.335,0-4.623,2.963-4.623,6.324,0,3.122,1.117,6.411,4.731,6.411a3.709,3.709,0,0,0,3.824-2.823Z" transform="translate(-164.961 -303.614)" />
            <path id="Path_9" data-name="Path 9" d="M241.386,303.984v11c0,3.544,1.845,4.594,3.863,4.594,2.314,0,3.767-1.242,3.767-4.594v-11h4.047V314.79c0,6.314-3.743,7.923-7.867,7.923-4.221,0-7.859-1.679-7.859-7.848V303.984Z" transform="translate(-172.268 -303.713)" />
            <path id="Path_10" data-name="Path 10" d="M264.621,303.984h4.044v15.191h9.316l-.462,3.273h-12.9Z" transform="translate(-179.617 -303.713)" />
            <path id="Path_11" data-name="Path 11" d="M298.992,314.485h-8.944v4.69h9.866l-.48,3.273H286.123V303.984h13.261v3.273h-9.336v3.956h8.944Z" transform="translate(-185.472 -303.713)" />
            <path id="Path_12" data-name="Path 12" d="M311.542,316.938c.427,1.855,1.774,2.668,3.938,2.668s3.083-.842,3.083-2.194c0-1.5-.9-2.156-4.1-2.89-5.09-1.18-6.348-3.009-6.348-5.5,0-3.219,2.438-5.406,6.865-5.406,4.965,0,6.943,2.636,7.212,5.338h-4.075c-.2-1.137-.832-2.371-3.243-2.371-1.641,0-2.632.67-2.632,1.981,0,1.284.794,1.8,3.816,2.5,5.44,1.266,6.632,3.264,6.632,5.869,0,3.373-2.583,5.686-7.527,5.686-4.747,0-7.247-2.308-7.7-5.676Z" transform="translate(-191.169 -303.614)" />
          </g>
        </g>
      </svg>
      
      
</div>