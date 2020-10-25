<template>
	<app-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Clients
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> -->
				<!-- <div class="p-6 sm:px-20 bg-white border-b border-gray-200"> -->
				<jet-form-section @submitted="filter">
					<template #title> Extract Data </template>
					<template #description>
						Ensure your IDs is correct and have coma (,) after each
						ID (client).
					</template>
					<div class="mt-2 text-2xl">Get In Action</div>

					<div class="mt-2 text-xs text-gray-500">
						You can find Facebook accounts by add (IDs) in this
						Input
					</div>

					<template #form>
						<div class="col-span-6 sm:col-span-4">
							<!-- <jet-label for="find" value="Extract Data" />
							<textarea
								id="find"
								class="form-input rounded-md shadow-sm w-full mt-1 text-sm"
								rows="6"
								v-model="form.ids"
							></textarea> -->
                            <div v-if="$page.user.point > 0">

                                <jet-label class="mt-4" for="find" value="Extract By File" />
                                <input
                                    id="photo"
                                    type="file"
                                    class="mt-1 block w-full"
                                    ref="photo"
                                    @change="extractChange"
                                />
                                <jet-input-error
                                    :message="form.error('photo')"
                                    class="mt-2"
                                />
                                <div v-if="countFile" class="mt-4 flex flex-col">
                                    <div><span class="text-gray-500">File count:</span> {{countFile}}</div>
                                    <div><span class="text-gray-500">Current points:</span> {{$page.user.point}}</div>
                                    <div :class="{ 'text-red-500' :($page.user.point - countFile < 0)}" ><span class="text-gray-500">You will have:</span> {{$page.user.point - countFile}}</div>
                                </div>

                            </div>
                            <div class="text-lg" v-else>
                                Please purchase points <span class="text-red-500">your point {{$page.user.point}}</span>
                            </div>
						</div>
					</template>

					<template #actions>
						<jet-action-message
							:on="form.recentlySuccessful"
							class="mr-3"
						>
							Saved.
						</jet-action-message>

						<jet-button
							:class="{ 'opacity-25': form.processing }"
							:disabled="form.processing"
						>
							Save
						</jet-button>
					</template>
				</jet-form-section>
				<!-- </div> -->
				<!-- </div> -->
				<div
					class="w-full my-8 overflow-hidden rounded-lg shadow-md"
					v-if="clients"
				>
					<div class="w-full overflow-x-auto">
						<table class="w-full whitespace-no-wrap">
							<thead>
								<tr
									class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
								>
									<th class="px-4 py-3">#</th>
									<th class="px-4 py-3">Name</th>
									<th class="px-4 py-3">Count</th>
									<th class="px-4 py-3">File</th>
									<th class="px-4 py-3">Download</th>
								</tr>
							</thead>
							<tbody
								class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
							>
								<tr
									class="text-gray-700 dark:text-gray-400"
									v-for="(client, key) in clients.data"
									:key="key"
								>
									<td class="px-4 py-3">
										{{ client.id }}
									</td>
									<td class="px-4 py-3">
										{{ client.name }}
									</td>
									<td class="px-4 py-3 text-sm">
										{{ client.count }}
									</td>
									<td class="px-4 py-3 text-xs">
										<span
											class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
										>
											{{client.file}}
										</span>
									</td>
									<td class="px-4 py-3 text-sm capitalize">
										<a class="hover:underline text-indigo-500" :href="route('clients.download', client.id)">Download</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div
						class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
					>
						<span class="flex items-center col-span-3">
							Showing {{ clients.from }}-{{ clients.to }} of
							{{ clients.total }}
						</span>
						<span class="col-span-2"></span>
						<!-- Pagination -->
						<span
							class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end"
						>
							<nav aria-label="Table navigation">
								<ul class="inline-flex items-center">
									<li
										v-for="(link, key) in clients.links"
										:key="key"
									>
										<button
											v-if="link.active || link.url"
											class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
											:class="{
												'text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600':
													link.active,
											}"
											:disabled="link.active"
											@click="filter(link.url)"
										>
											{{ link.label }}
										</button>
										<button
											v-else
											class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
											:class="{
												'text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600':
													link.active,
											}"
											:disabled="link.active"
										>
											{{ link.label }}
										</button>
									</li>
								</ul>
							</nav>
						</span>
					</div>
				</div>
			</div>
		</div>
	</app-layout>
</template>

<script>
	import AppLayout from "./../../../Layouts/AppLayout";
	import JetActionMessage from "./../../../Jetstream/ActionMessage";
	import JetButton from "./../../../Jetstream/Button";
	import JetFormSection from "./../../../Jetstream/FormSection";
	import JetInput from "./../../../Jetstream/Input";
	import JetInputError from "./../../../Jetstream/InputError";
	import JetLabel from "./../../../Jetstream/Label";
	export default {
		props: ["clients"],

		components: {
			AppLayout,
			JetActionMessage,
			JetButton,
			JetFormSection,
			JetInput,
			JetInputError,
			JetLabel,
		},
		data() {
			return {
				form: this.$inertia.form(
					{
                        '_method': 'PUT',
                        ids: "",
                        photo: null,
					},
					{
                        bag: "filter",
                        resetOnSuccess: false,
					}
                ),
                countFile: 0
			};
		},
		methods: {
			filter(url = null) {
                if ((this.$page.user.point - this.countFile) >= 0) {
                    if (url == null) {
                        this.form.post(route('clients.export'), {
                        preserveScroll: true
                    });
                    } else {
                        this.form.post(url, {
                            preserveScroll: true,
                        });
                    }
                } else {
                    alert('You not have enough points')
                }
            },
            readFile(file) {
  return new Promise((resolve, reject) => {
    let fr = new FileReader();
    fr.onload = x=> resolve(fr.result);
    fr.readAsText(file);
})},
async read() {
  let readFile = await this.readFile(this.$refs.photo.files[0]);
  let trimFile = readFile.trim()
  let splitFile =  readFile.split(/\r\n|\n|\r/)
  this.countFile = _.uniq(splitFile).length
},
            extractChange() {
                this.read();
                this.form.photo = this.$refs.photo.files[0]
            },
            download(id) {
                this.$inertia.post(route('clients.download', id), {
                    preserveScroll: true,
                });
            },
		},
	};
</script>
