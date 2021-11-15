const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera( 45, 2, 0.1, 1000 );

const renderer = new THREE.WebGLRenderer({ alpha : true });
renderer.setSize( window.innerWidth / 2, window.innerWidth / 2 * 0.5 );
renderer.setClearColor( 0xffffff, 0);
// document.body.appendChild( renderer.domElement );
document.getElementById("preview").appendChild( renderer.domElement );

// const material = new THREE.MeshBasicMaterial( { color: 0xc79d7d } );
const material = new THREE.MeshPhongMaterial({color: 0xc79d7d });
const cube = new THREE.Mesh( new THREE.BoxGeometry(.01, .01, .01), material );
cube.rotation.x = 10;
scene.add( cube );

const light = new THREE.AmbientLight( 0x404040 ); // soft white light
scene.add( light );

const directionalLight = new THREE.DirectionalLight( 0xffffff, 1 );
directionalLight.position.set(1., 1., 1.);
directionalLight.target = cube;
scene.add( directionalLight );

camera.position.z = 8;

const animate = function () {
    requestAnimationFrame( animate );

    cube.rotation.y += 0.01;

    renderer.render( scene, camera );
};
animate();