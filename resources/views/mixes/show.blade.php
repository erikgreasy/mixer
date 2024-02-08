<x-layouts.app>
    <div
        x-data="player"
        class="max-w-3xl w-full mx-auto"
    >
        <div>
            <div id="audio" class="cursor-pointer"></div>

            <div class="flex justify-between text-xs">
                <div id="current" x-text="currentTime"></div>
                <div id="duration" x-text="duration"></div>
            </div>
        </div>

        <div class="flex items-center gap-x-5 mt-5">
            <button
                @click="handlePlayPause"
                id="play"
                class="bg-gray-800 text-white rounded-full w-16 h-16 mt-2 inline-flex justify-center items-center transition hover:bg-primary"
            >
                <span x-show="isPlaying">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                    </svg>
                </span>

                <span x-show="!isPlaying">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                    </svg>
                </span>
            </button>

            <div>
                <h1 class="text-2xl font-medium">
                    {{ $mix->title }}
                </h1>
                <p class="text-gray-600">
                    {{ $mix->author->name }}
                </p>
            </div>
        </div>

        <script>
            function formatTime(duration) {
                const minutes = Math.floor((duration / 60));
                const seconds = Math.floor((duration - (minutes * 60))).toString().padStart(2, '0');

                return `${minutes}:${seconds}`;
            }

            document.addEventListener('alpine:init', () => {
                Alpine.data('player', () => ({
                    isPlaying: false,
                    wavesurfer: null,
                    currentTime: '0:00',
                    duration: '--:--',

                    init() {
                        this.wavesurfer = WaveSurfer.create({
                            container: '#audio',
                            waveColor: '#bbbbbb',
                            progressColor: '#197593',
                            url: @js($mix->upload()->getUrl()),

                            // Set a bar width
                            barWidth: 2,
                            // Optionally, specify the spacing between bars
                            barGap: 2,
                            // And the bar radius
                            barRadius: 2,

                            height: 90,

                            cursorWidth: 0,
                        });

                        this.wavesurfer.on('ready', () => {
                            const duration = this.wavesurfer.getDuration();

                            this.duration = formatTime(duration);
                        })

                        this.wavesurfer.on('timeupdate', () => {
                            const currentTime = this.wavesurfer.getCurrentTime();
                            this.currentTime = formatTime(currentTime);
                        });

                        this.wavesurfer.on('finish', () => {
                            this.isPlaying = false;
                        })

                        window.addEventListener('keydown', (e) => {
                            if (e.code === 'Space') {
                                return this.handlePlayPause();
                            }

                            if (e.code === 'ArrowLeft') {
                                return this.wavesurfer.setTime(
                                    this.wavesurfer.getCurrentTime() - 5
                                );
                            }

                            if (e.code === 'ArrowRight') {
                                return this.wavesurfer.setTime(
                                    this.wavesurfer.getCurrentTime() + 5
                                );
                            }
                        })
                    },

                    handlePlayPause() {
                        this.wavesurfer.playPause();
                        this.isPlaying = !this.isPlaying;
                    }
                }))
            })
        </script>
    </div>
</x-layouts.app>
