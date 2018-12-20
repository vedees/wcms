import mediumZoom from 'medium-zoom'

const zoomDefault = mediumZoom('#zoom-default')
const zoomBackgroundBlack = mediumZoom('#zoom-background--black', { margin: 48,scrollOffset: 0, background: '#212530' })
const zoomBackgroundWhite = mediumZoom('#zoom-background--white', { margin: 48,scrollOffset: 0, background: '#ffffff' })

// Trigger the zoom when the button is clicked
const zoomToTrigger = mediumZoom('#zoom-trigger')
const button = document.querySelector('#button-trigger')
button.addEventListener('click', () => zoomToTrigger.open())

// Detach the zoom after having been zoomed once
const zoomToDetach = mediumZoom('#zoom-detach')
zoomToDetach.on('closed', () => zoomToDetach.detach())

// Observe zooms to write the history
const observedZooms = [
  zoomDefault,
  zoomBackgroundBlack,
  zoomBackgroundWhite,
  zoomToTrigger,
  zoomToDetach
]

// Log all interactions in the history
const history = document.querySelector('#history')

observedZooms.forEach(zoom => {
  zoom.on('open', event => {
    const time = new Date().toLocaleTimeString()
    history.innerHTML += `<li>Image "<em>${
      event.target.alt
    }</em>" was zoomed at ${time}</li>`
  })

  zoom.on('detach', event => {
    const time = new Date().toLocaleTimeString()
    history.innerHTML += `<li>Image <em>"${
      event.target.alt
    }"</em> was detached at ${time}</li>`
  })
})
