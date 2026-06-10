import { DataSet, Network } from 'vis-network/standalone'

// Modern genre color palette
const GENRE_COLORS = {
    'black-metal':       ['#0d0d0d', '#333333'],
    'death-metal':       ['#1a0a0a', '#8b0000'],
    'thrash-metal':      ['#1a0f00', '#cc5500'],
    'doom-metal':        ['#111108', '#4a4a2a'],
    'sludge-metal':      ['#1a1408', '#6b5a1a'],
    'heavy-metal':       ['#111122', '#3355aa'],
    'metalcore':         ['#0f0f1a', '#8844aa'],
    'deathcore':         ['#0d0d0d', '#661122'],
    'nu-metal':          ['#111122', '#ff4444'],
    'hard-rock':         ['#1a1a0a', '#cc8800'],
    'punk-rock':         ['#1a0a0a', '#dd2222'],
    'hardcore':          ['#0a0a0a', '#ff4444'],
    'grunge':            ['#0f1a0f', '#446622'],
    'alternative-rock':  ['#0a1a1a', '#228888'],
    'indie-rock':        ['#0f1a1a', '#44aaaa'],
    'post-rock':         ['#0a1a1a', '#669999'],
    'progressive-rock':  ['#0a0f1a', '#4466aa'],
    'psychedelic-rock':  ['#1a0a1a', '#aa44aa'],
    'post-punk':         ['#11111a', '#666699'],
    'new-wave':          ['#0a1a1a', '#44cccc'],
    'gothic-rock':       ['#0f0f1a', '#6633aa'],
    'shoegaze':          ['#1a0f1a', '#8866cc'],
    'dream-pop':         ['#1a1a1a', '#cc88cc'],
    'noise-rock':        ['#111111', '#aaaaaa'],
    'experimental':      ['#0f0f0f', '#88aa88'],
    'electronic':        ['#0a0f1a', '#3366cc'],
    'industrial':        ['#1a1a0a', '#888844'],
    'folk-rock':         ['#1a1a0f', '#886633'],
    'blues-rock':        ['#1a0f0a', '#aa6633'],
    'country':           ['#1a1a0a', '#886622'],
    'jazz':              ['#0f0f1a', '#334488'],
    'hip-hop':           ['#1a0f0a', '#cc6633'],
    'reggae':            ['#0f1a0f', '#448822'],
    'ska':               ['#1a1a1a', '#888888'],
    'pop-rock':          ['#1a0f1a', '#cc4488'],
    'screamo':           ['#0d0d0d', '#ff2266'],
    'emo':               ['#0f0f0f', '#ff4488'],
    'post-grunge':       ['#111a11', '#557733'],
    'stoner-rock':       ['#1a1a0f', '#aa8844'],
    'southern-rock':     ['#1a1a0a', '#aa6622'],
    'funk':              ['#1a0f0a', '#cc6633'],
    'soul':              ['#1a0f0a', '#cc5544'],
    'disco':             ['#1a0a1a', '#cc44aa'],
    'house':             ['#0a1a1a', '#44ccaa'],
    'techno':            ['#0a0f1a', '#3366aa'],
    'drum-and-bass':     ['#0a0a1a', '#334488'],
    'dubstep':           ['#0a0a0a', '#664488'],
    'synthwave':         ['#1a0a1a', '#cc44cc'],
    'trance':            ['#0a1a1a', '#44aacc'],
    'ambient':           ['#0f0f1a', '#334466'],
    'classical':         ['#1a1a0f', '#886644'],
    'rap-metal':         ['#1a0a0a', '#cc4422'],
    'electronicore':     ['#0a0f1a', '#4466cc'],
    'default':           ['#111122', '#4466aa'],
}

function genreColors(genre) {
    return GENRE_COLORS[genre] || GENRE_COLORS['default']
}

// Animated canvas background
function createAnimatedBackground(container) {
    const canvas = document.createElement('canvas')
    canvas.id = 'graph-bg-canvas'
    canvas.style.cssText = 'position:absolute;inset:0;z-index:0;pointer-events:none;opacity:0.4'
    container.style.position = 'relative'
    container.appendChild(canvas)

    const ctx = canvas.getContext('2d')
    const particles = []
    const PARTICLE_COUNT = 60

    function resize() {
        canvas.width = container.offsetWidth
        canvas.height = container.offsetHeight
    }
    resize()
    window.addEventListener('resize', resize)

    for (let i = 0; i < PARTICLE_COUNT; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            vx: (Math.random() - 0.5) * 0.3,
            vy: (Math.random() - 0.5) * 0.3,
            size: Math.random() * 1.5 + 0.5,
            opacity: Math.random() * 0.4 + 0.1,
        })
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        for (const p of particles) {
            p.x += p.vx
            p.y += p.vy
            if (p.x < 0) p.x = canvas.width
            if (p.x > canvas.width) p.x = 0
            if (p.y < 0) p.y = canvas.height
            if (p.y > canvas.height) p.y = 0

            ctx.beginPath()
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2)
            ctx.fillStyle = `rgba(255,255,255,${p.opacity})`
            ctx.fill()
        }
        requestAnimationFrame(animate)
    }
    animate()
}

export function initGenealogy() {
    const status = document.getElementById('graph-status')
    const container = document.getElementById('full-genealogy-graph')
    if (!container) return
    container.innerHTML = ''

    // Animated background particles
    createAnimatedBackground(container)

    status.textContent = 'Fetching...'

    fetch('/api/genealogy')
        .then(r => r.json())
        .then(data => {
            status.textContent = 'Rendering ' + data.nodes.length + ' nodes...'

            // Enhanced nodes
            data.nodes.forEach(n => {
                const isBand = n.group === 'band'
                const [bg, border] = genreColors(n.genre || 'default')
                const memberCount = n.artists_count || 0

                n.color = {
                    background: bg,
                    border: border,
                    highlight: { background: border, border: '#ffffff' },
                    hover: { background: bg, border: '#ffffff' },
                }

                if (isBand) {
                    // Size based on member count (12px to 28px radius)
                    const baseSize = 12
                    const sizeBoost = Math.min(memberCount * 3, 16)
                    n.borderWidth = 2
                    n.borderWidthSelected = 3
                    n.size = baseSize + sizeBoost
                    n.shapeProperties = { borderRadius: 4 }
                    n.widthConstraint = { minimum: 100, maximum: 200 }
                    n.font = {
                        color: '#e8e8f0',
                        size: Math.min(12 + memberCount, 18),
                        face: "'JetBrains Mono', 'Inter', system-ui, sans-serif",
                        bold: true,
                        multi: 'html',
                        strokeWidth: 0,
                    }
                    n.label = '<b>' + n.label + '</b>'
                    n.margin = { top: 10, bottom: 8, left: 12, right: 12 }
                    n.mass = 1 + memberCount * 0.5
                    n.shadow = {
                        enabled: true,
                        color: border + '40',
                        size: 8,
                        x: 0,
                        y: 0,
                    }
                } else {
                    n.shape = 'dot'
                    n.size = 16
                    n.borderWidth = 2
                    n.borderWidthSelected = 3
                    n.font = {
                        color: '#b0b0c0',
                        size: 11,
                        face: "'Inter', system-ui, sans-serif",
                        bold: true,
                        strokeWidth: 0,
                    }
                    n.mass = 0.5
                    n.shadow = {
                        enabled: true,
                        color: border + '30',
                        size: 4,
                        x: 0,
                        y: 0,
                    }
                }
                n.cursor = 'pointer'
            })

            // Enhanced edges
            data.edges.forEach(e => {
                const isMembership = !!e.dashes
                if (isMembership) {
                    e.dashes = [4, 5]
                    e.width = 1
                    e.color = {
                        color: '#444466',
                        highlight: '#8888aa',
                        hover: '#8888aa',
                        opacity: 0.35,
                    }
                    e.smooth = { type: 'curvedCW', roundness: 0.2 }
                } else {
                    e.width = 2.5
                    e.color = {
                        color: '#f59e0b',
                        highlight: '#fbbf24',
                        hover: '#fbbf24',
                        opacity: 0.7,
                    }
                    e.smooth = { type: 'curvedCW', roundness: 0.1 }
                }
                e.hoverWidth = 0
            })

            const nodes = new DataSet(data.nodes)
            const edges = new DataSet(data.edges)

            const network = new Network(container, { nodes, edges }, {
                nodes: {
                    borderWidth: 2,
                    borderWidthSelected: 3,
                    shapeProperties: { borderRadius: 6 },
                },
                edges: {
                    smooth: { type: 'curvedCW', roundness: 0.15 },
                    font: { size: 0, strokeWidth: 0 },
                },
                physics: {
                    solver: 'forceAtlas2Based',
                    forceAtlas2Based: {
                        gravitationalConstant: -120,
                        centralGravity: 0.008,
                        springLength: 140,
                        springConstant: 0.04,
                        damping: 0.35,
                        avoidOverlap: 0.6,
                    },
                    minVelocity: 0.2,
                    maxVelocity: 8,
                    stabilization: { iterations: 180, updateInterval: 10 },
                },
                layout: { improvedLayout: true },
                interaction: {
                    hover: true,
                    tooltipDelay: 100,
                    zoomView: true,
                    dragView: true,
                    hoverConnectedEdges: true,
                    navigationButtons: false,
                    keyboard: true,
                    multiselect: true,
                },
            })

            status.textContent = data.nodes.length + ' nodes · ' + data.edges.length + ' edges'

            // Click to focus
            network.on('click', params => {
                if (params.nodes.length) {
                    network.focus(params.nodes[0], {
                        scale: 2.5,
                        animation: { duration: 500, easingFunction: 'easeInOutCubic' },
                    })
                } else if (params.edges.length) {
                    network.fit({ animation: { duration: 400, easingFunction: 'easeInOutCubic' } })
                } else {
                    network.fit({ animation: { duration: 600, easingFunction: 'easeInOutCubic' } })
                }
            })

            // Double click to navigate
            network.on('doubleClick', params => {
                if (params.nodes.length) {
                    const n = nodes.get(params.nodes[0])
                    if (n.url) window.location.href = n.url
                }
            })

            // Hover glow effect
            network.on('hoverNode', params => {
                const id = params.node
                if (id) {
                    const n = nodes.get(id)
                    if (n) {
                        nodes.update({ id, shadow: { enabled: true, color: '#ffffff', size: 20, x: 0, y: 0 } })
                    }
                }
            })
            network.on('blurNode', params => {
                const id = params.node
                if (id) {
                    const n = nodes.get(id)
                    if (n) {
                        const [bg, border] = genreColors(n.genre || 'default')
                        nodes.update({ id, shadow: { enabled: true, color: border + '40', size: 8, x: 0, y: 0 } })
                    }
                }
            })

            // Keep subtle physics running for motion
            network.once('stabilizationIterationsDone', () => {
                network.fit({ animation: { duration: 800, easingFunction: 'easeInOutCubic' } })
                // Light continuous physics for subtle motion
                network.setOptions({
                    physics: {
                        solver: 'forceAtlas2Based',
                        forceAtlas2Based: {
                            gravitationalConstant: -20,
                            centralGravity: 0.003,
                            springLength: 180,
                            springConstant: 0.02,
                            damping: 0.6,
                            avoidOverlap: 0.8,
                        },
                        minVelocity: 0.05,
                        maxVelocity: 2,
                        stabilization: { iterations: 50 },
                    },
                })
            })

            // Zoom controls
            const zoomIn = document.getElementById('graph-zoom-in')
            const zoomOut = document.getElementById('graph-zoom-out')
            if (zoomIn) {
                zoomIn.addEventListener('click', () => {
                    network.moveTo({
                        scale: network.getScale() * 1.4,
                        animation: { duration: 300, easingFunction: 'easeInOutCubic' },
                    })
                })
            }
            if (zoomOut) {
                zoomOut.addEventListener('click', () => {
                    network.moveTo({
                        scale: network.getScale() / 1.4,
                        animation: { duration: 300, easingFunction: 'easeInOutCubic' },
                    })
                })
            }

            // Keyboard: F for fit, R for reset physics
            document.addEventListener('keydown', e => {
                if (e.key === 'f' && !e.ctrlKey && !e.metaKey && !e.target.closest('input')) {
                    network.fit({ animation: { duration: 500, easingFunction: 'easeInOutCubic' } })
                }
                if (e.key === 'r' && !e.ctrlKey && !e.metaKey && !e.target.closest('input')) {
                    network.setOptions({
                        physics: {
                            solver: 'forceAtlas2Based',
                            forceAtlas2Based: {
                                gravitationalConstant: -120,
                                centralGravity: 0.008,
                                springLength: 140,
                                springConstant: 0.04,
                                damping: 0.35,
                                avoidOverlap: 0.6,
                            },
                            minVelocity: 0.2,
                            maxVelocity: 8,
                            stabilization: { iterations: 150 },
                        },
                    })
                    network.once('stabilizationIterationsDone', () => {
                        network.setOptions({
                            physics: {
                                solver: 'forceAtlas2Based',
                                forceAtlas2Based: {
                                    gravitationalConstant: -20,
                                    centralGravity: 0.003,
                                    springLength: 180,
                                    springConstant: 0.02,
                                    damping: 0.6,
                                    avoidOverlap: 0.8,
                                },
                                minVelocity: 0.05,
                                maxVelocity: 2,
                            },
                        })
                    })
                }
            })
        })
        .catch(err => {
            status.textContent = 'Error: ' + err.message
            console.error(err)
        })
}

if (document.getElementById('full-genealogy-graph')) {
    initGenealogy()
}
